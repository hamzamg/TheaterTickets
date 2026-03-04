<div>
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Shows Management</h1>
            <button wire:click="create" class="btn-primary">
                Add New Show
            </button>
        </div>
        
        <div class="mt-4">
            <input type="text" wire:model.live.debounce.300ms="search" 
                   placeholder="Search shows..." 
                   class="input-field w-full max-w-md">
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Show Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shows as $show)
                    <tr>
                        <td class="font-medium">{{ $show->name }}</td>
                        <td>{{ $show->type }}</td>
                        <td>{{ $show->showType?->type ?? '-' }}</td>
                        <td class="max-w-xs truncate">{{ $show->description }}</td>
                        <td>
                            @if($show->active)
                                <span class="badge-success">Active</span>
                            @else
                                <span class="badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $show->id }})" 
                                        class="btn-sm btn-info">Edit</button>
                                <button wire:click="confirmDelete({{ $show->id }})" 
                                        class="btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            No shows found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $shows->links() }}
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="modal-backdrop" wire:click="$set('showModal', false)">
            <div class="modal-content" wire:click.stop>
                <div class="modal-header">
                    <h2 class="text-xl font-bold">{{ $editMode ? 'Edit Show' : 'Create Show' }}</h2>
                    <button wire:click="$set('showModal', false)" class="modal-close">×</button>
                </div>
                
                <form wire:submit="save" class="p-6 space-y-4">
                    <div>
                        <label class="label">Name *</label>
                        <input type="text" wire:model="name" class="input-field">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="label">Type *</label>
                        <input type="text" wire:model="type" class="input-field">
                        @error('type') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="label">Show Type</label>
                        <select wire:model="show_type_id" class="input-field">
                            <option value="">Select type...</option>
                            @foreach($showTypes as $st)
                                <option value="{{ $st->id }}">{{ $st->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="label">Description *</label>
                        <textarea wire:model="description" class="input-field" rows="3"></textarea>
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="label">Photo</label>
                        <input type="file" wire:model="photo" class="input-field">
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                        @if($photo_path)
                            <p class="mt-2 text-sm text-gray-600">Current: {{ $photo_path }}</p>
                        @endif
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="active" id="active" class="checkbox">
                        <label for="active" class="ml-2">Active</label>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" wire:click="$set('showModal', false)" 
                                class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">
                            {{ $editMode ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="modal-backdrop" wire:click="$set('showDeleteModal', false)">
            <div class="modal-content max-w-md" wire:click.stop>
                <div class="p-6 text-center">
                    <h3 class="text-lg font-bold mb-4">Delete Show?</h3>
                    <p class="text-gray-600 mb-6">This action cannot be undone.</p>
                    <div class="flex justify-center space-x-3">
                        <button wire:click="$set('showDeleteModal', false)" 
                                class="btn-secondary">Cancel</button>
                        <button wire:click="delete" class="btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
