<div class="pt-4 mx-12">
    <div>
        @if (session()->has('message'))
            <div class="flex w-1/4 mx-auto sm:w-full md:w-full">
                <div class="relative px-6 py-4 mx-auto mb-4 text-white bg-green-500 border-0 rounded">
                    <span class="inline-block mr-8 align-middle">
                        <b class="capitalize">Success!</b> {{ session('message') }}
                    </span>
                    <button wire:click="clearFlash()"
                        class="absolute top-0 right-0 mt-4 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="flex w-1/4 mx-auto sm:w-full md:w-full">
                <div class="relative px-6 py-4 mx-auto mb-4 text-white bg-red-500 border-0 rounded">
                    <span class="inline-block mr-8 align-middle">
                        <b class="capitalize">Error!</b> {{ session('error') }}
                    </span>
                    <button wire:click="clearFlash()"
                        class="absolute top-0 right-0 mt-4 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="flex flex-col w-full">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="flex flex-row justify-between p-2 overflow-hidden sm:rounded-lg">
                        <div class="w-1/4">
                            <input wire:model.live="search"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                type="text" placeholder="Search bookings by client, show, or ticket code...">
                        </div>
                        <div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25"
                                wire:click="create">
                                {{ __('New Booking') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-full">
            <div class="inline-block min-w-full py-2 align-middle sm:-mx-6 lg:-mx-8">
                <div class="relative overflow-hidden overflow-x-auto border-b shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3 text-center">#</th>
                                <th class="px-4 py-3">{{ __('Client') }}</th>
                                <th class="px-4 py-3">{{ __('Show') }}</th>
                                <th class="px-4 py-3">{{ __('Ticket Code') }}</th>
                                <th class="px-4 py-3 text-center">{{ __('Qty') }}</th>
                                <th class="px-4 py-3">{{ __('Date') }}</th>
                                <th class="px-4 py-3 text-center">{{ __('QR') }}</th>
                                <th class="px-4 py-3 text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($rows as $key => $row)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-center">{{ ++$key }}</td>
                                    <td class="px-4 py-4">{{ $row->client?->firstname }} {{ $row->client?->lastname }}</td>
                                    <td class="px-4 py-4">{{ $row->show?->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 font-mono text-sm">{{ $row->ticket?->code_ticket ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-center">{{ $row->quantity ?? 1 }}</td>
                                    <td class="px-4 py-4 text-sm">{{ $row->created_at?->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-4 text-center">
                                        @if($row->qrcode)
                                            <button wire:click="showQr({{ $row->id }})" class="text-blue-600 hover:text-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Show QR
                                            </button>
                                        @else
                                            <span class="text-gray-400">No QR</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <button wire:click="edit({{ $row->id }})" class="px-3 py-1 text-white bg-green-600 rounded hover:bg-green-700">{{ __('Edit') }}</button>
                                        <button wire:click="confirmDelete({{ $row->id }})" class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700">{{ __('Delete') }}</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">{{ __('No bookings found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-2">
                        {{ $rows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Form Modal --}}
    @if ($showForm)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-200 opacity-75"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block mx-auto overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="flex flex-row justify-start p-2 bg-gray-100">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full {{ $mode == 'create' ? 'bg-green-100' : 'bg-blue-100' }} sm:mx-0 sm:h-10 sm:w-10">
                            @if ($mode == 'create')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="p-2 ml-4 text-lg font-medium leading-6 text-gray-900">
                            {{ $mode == 'create' ? 'New Booking' : 'Edit Booking' }}
                        </h3>
                    </div>

                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <div>
                                <label class="block">
                                    <span class="text-gray-700 @error('client_id') text-red-500 @enderror">Client *</span>
                                    <select wire:model="client_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('client_id') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        <option value="">Select client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->lastname }}, {{ $client->firstname }}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')<span class="text-sm text-red-500">{{ $message }}</span>@enderror
                                </label>
                            </div>

                            <div>
                                <label class="block">
                                    <span class="text-gray-700 @error('show_id') text-red-500 @enderror">Show *</span>
                                    <select wire:model.live="show_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('show_id') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        <option value="">Select show</option>
                                        @foreach($shows as $show)
                                            <option value="{{ $show->id }}">{{ $show->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('show_id')<span class="text-sm text-red-500">{{ $message }}</span>@enderror
                                </label>
                            </div>

                            <div>
                                <label class="block">
                                    <span class="text-gray-700 @error('ticket_id') text-red-500 @enderror">Ticket *</span>
                                    <select wire:model="ticket_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('ticket_id') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                        <option value="">{{ $show_id ? 'Select ticket' : 'First select a show' }}</option>
                                        @foreach($tickets as $ticket)
                                            <option value="{{ $ticket->id }}">
                                                {{ $ticket->code_ticket }} - {{ $ticket->date_shows }} {{ $ticket->time_shows }} ({{ $ticket->rest_ticket }} available)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ticket_id')<span class="text-sm text-red-500">{{ $message }}</span>@enderror
                                </label>
                            </div>

                            <div>
                                <label class="block">
                                    <span class="text-gray-700 @error('quantity') text-red-500 @enderror">Quantity *</span>
                                    <input type="number" min="1" max="10" wire:model="quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('quantity') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('quantity')<span class="text-sm text-red-500">{{ $message }}</span>@enderror
                                </label>
                            </div>

                            <div>
                                <label class="block">
                                    <span class="text-gray-700 @error('notes') text-red-500 @enderror">Notes</span>
                                    <textarea wire:model="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('notes') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" placeholder="Optional notes..."></textarea>
                                    @error('notes')<span class="text-sm text-red-500">{{ $message }}</span>@enderror
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @if ($mode == 'create') wire:click="store()" @else wire:click="update()" @endif type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $mode == 'create' ? 'Create Booking' : 'Update Booking' }}
                        </button>
                        <button wire:click="$set('showForm', false)" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- QR Code Modal --}}
    @if ($showQrModal && $currentQrCode)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-200 opacity-75"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block mx-auto overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6">
                        <div class="text-center">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Booking QR Code</h3>
                            <div class="flex justify-center mb-4">
                                {!! $currentQrCode !!}
                            </div>
                            @if($currentBooking)
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p><strong>Client:</strong> {{ $currentBooking->client?->firstname }} {{ $currentBooking->client?->lastname }}</p>
                                    <p><strong>Show:</strong> {{ $currentBooking->show?->name }}</p>
                                    <p><strong>Ticket:</strong> {{ $currentBooking->ticket?->code_ticket }}</p>
                                    <p><strong>Qty:</strong> {{ $currentBooking->quantity ?? 1 }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="closeQrModal" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:w-auto sm:text-sm">
                            {{ __('Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Confirmation --}}
    @if ($showConfirmDeletePopup)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-200 opacity-75"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block mx-auto overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Delete Booking</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure? This will restore the tickets to inventory.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="destroy()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                        <button wire:click="$set('showConfirmDeletePopup', false)" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ __('Cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>