<div>
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tickets Management</h1>
            <button wire:click="create" class="btn-primary">Add New Ticket</button>
        </div>
        
        <div class="mt-4">
            <input type="text" wire:model.live.debounce.300ms="search" 
                   placeholder="Search tickets..." 
                   class="input-field w-full max-w-md">
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Show</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td class="font-mono font-bold">{{ $ticket->code_ticket }}</td>
                        <td>{{ $ticket->show?->name ?? '-' }}</td>
                        <td>{{ $ticket->ticketType?->type ?? $ticket->type }}</td>
                        <td>{{ $ticket->date_shows->format('Y-m-d') }}</td>
                        <td>{{ $ticket->time_shows }}</td>
                        <td>${{ number_format($ticket->price, 2) }}</td>
                        <td>
                            <span class="badge-{{ $ticket->rest_ticket > 0 ? 'success' : 'danger' }}">
                                {{ $ticket->rest_ticket }} / {{ $ticket->nomber_ticket }}
                            </span>
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $ticket->id }})" class="btn-sm btn-info">Edit</button>
                                <button wire:click="confirmDelete({{ $ticket->id }})" class="btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-500">No tickets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $tickets->links() }}</div>

    <!-- Modal -->
    @if($showModal)
        <div class="modal-backdrop" wire:click="$set('showModal', false)">
            <div class="modal-content" wire:click.stop>
                <div class="modal-header">
                    <h2 class="text-xl font-bold">{{ $editMode ? 'Edit Ticket' : 'Create Ticket' }}</h2>
                    <button wire:click="$set('showModal', false)" class="modal-close">×</button>
                </div>
                
                <form wire:submit="save" class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label">Show *</label>
                            <select wire:model="show_id" class="input-field">
                                <option value="">Select show...</option>
                                @foreach($shows as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                            @error('show_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="label">Ticket Type</label>
                            <select wire:model="ticket_type_id" class="input-field">
                                <option value="">Select type...</option>
                                @foreach($ticketTypes as $tt)
                                    <option value="{{ $tt->id }}">{{ $tt->type }} (+${{ $tt->price_modifier }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label">Date *</label>
                            <input type="date" wire:model="date_shows" class="input-field">
                            @error('date_shows') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="label">Time *</label>
                            <input type="time" wire:model="time_shows" class="input-field">
                            @error('time_shows') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label">Total Tickets *</label>
                            <input type="number" wire:model="nomber_ticket" class="input-field" min="1">
                            @error('nomber_ticket') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="label">Available Tickets *</label>
                            <input type="number" wire:model="rest_ticket" class="input-field" min="0">
                            @error('rest_ticket') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label">Price ($) *</label>
                            <input type="number" wire:model="price" class="input-field" step="0.01" min="0">
                            @error('price') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="label">Code *</label>
                            <input type="text" wire:model="code_ticket" class="input-field" maxlength="15">
                            @error('code_ticket') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label class="label">Type *</label>
                        <input type="text" wire:model="type" class="input-field">
                        @error('type') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" wire:click="$set('showModal', false)" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">{{ $editMode ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($showDeleteModal)
        <div class="modal-backdrop" wire:click="$set('showDeleteModal', false)">
            <div class="modal-content max-w-md" wire:click.stop>
                <div class="p-6 text-center">
                    <h3 class="text-lg font-bold mb-4">Delete Ticket?</h3>
                    <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                    <div class="flex justify-center space-x-3">
                        <button wire:click="$set('showDeleteModal', false)" class="btn-secondary">Cancel</button>
                        <button wire:click="delete" class="btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
