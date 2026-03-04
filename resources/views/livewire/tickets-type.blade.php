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
        <div>
            <div class="flex flex-col w-full">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="flex flex-row justify-between p-2 overflow-hidden sm:rounded-lg">
                            <div class="w-1/4">
                                <input wire:model.live="search"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                    id="search" type="text" name="search" placeholder="{{ __('Search') }}..." 
                                    autofocus="autofocus">
                            </div>
                            <div>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25"
                                    wire:click="create">
                                    {{ __('Add New') }} {{ __('Ticket Type') }}
                                </button>
                            </div>
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
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">N:</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                    {{ __('TYPE') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                    {{ __('SLUG') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                    {{ __('PRICE MODIFIER') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                    {{ __('ACTIVE') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                    {{ __('TICKETS COUNT') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">{{ __('Actions') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-start">
                            @forelse($rows as $key => $row)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ ++$key }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-start">
                                        {{ $row->type }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-start">
                                        <code class="px-2 py-1 bg-gray-100 rounded text-sm">{{ $row->slug }}</code>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white text-start">
                                        @if($row->price_modifier > 0)
                                            <span class="text-green-600 font-semibold">+{{ $row->price_modifier }}%</span>
                                        @elseif($row->price_modifier < 0)
                                            <span class="text-red-600 font-semibold">{{ $row->price_modifier }}%</span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($row->active)
                                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                {{ __('Active') }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                                {{ __('Inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                            {{ $row->tickets_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <a href="#"
                                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                                            wire:click="edit({{ $row->id }})">{{ __('Edit') }}</a>
                                        <a href="#"
                                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                            wire:click="confirmDelete({{ $row->id }})">{{ __('Delete') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="font-medium text-center">
                                    <td colspan="7" class="px-6 py-4">{{ __('No Records Found') }}</td>
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

    {{-- create / edit form --}}
    @if ($showForm)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-200 opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block mx-auto overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="flex flex-row justify-start p-2 bg-gray-100">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full {{ $mode == 'create' ? 'bg-green-100' : 'bg-blue-100' }} sm:mx-0 sm:h-10 sm:w-10">
                            @if ($mode == 'create')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="p-2 ml-4 text-lg font-medium leading-6 text-gray-900" id="modal-title">
                            {{ $mode == 'create' ? __('Add New Ticket Type') : __('Update Ticket Type') }}
                        </h3>
                    </div>

                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="content-start w-full mt-3 text-start sm:mt-0 sm:ml-4">
                                <div class="mt-2 space-y-4">
                                    <div>
                                        <label class='block'>
                                            <span class='text-gray-700 @error('type') text-red-500 @enderror'>{{ __('Type Name') }}</span>
                                            <input type='text'
                                                class='mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('type') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50'
                                                wire:model='type'>
                                            @error('type')
                                                <span class='text-sm text-red-500'>{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div>
                                        <label class='block'>
                                            <span class='text-gray-700 @error('slug') text-red-500 @enderror'>{{ __('Slug') }}</span>
                                            <input type='text'
                                                class='mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('slug') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50'
                                                wire:model='slug'>
                                            @error('slug')
                                                <span class='text-sm text-red-500'>{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div>
                                        <label class='block'>
                                            <span class='text-gray-700 @error('description') text-red-500 @enderror'>{{ __('Description') }}</span>
                                            <textarea
                                                class='mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('description') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50'
                                                wire:model='description' rows="3"></textarea>
                                            @error('description')
                                                <span class='text-sm text-red-500'>{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div>
                                        <label class='block'>
                                            <span class='text-gray-700 @error('price_modifier') text-red-500 @enderror'>{{ __('Price Modifier (%)') }}</span>
                                            <input type='number' step="0.01"
                                                class='mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('price_modifier') border-red-500 @enderror focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50'
                                                wire:model='price_modifier'>
                                            <span class="text-sm text-gray-500">{{ __('Positive for markup, negative for discount') }}</span>
                                            @error('price_modifier')
                                                <span class='text-sm text-red-500'>{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model="active"
                                                class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-gray-700">{{ __('Active') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button
                                @if ($mode == 'create') wire:click="store()" @else wire:click="update()" @endif
                                type="button"
                                class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ $mode == 'create' ? __('Save') : __('Update') }}
                            </button>
                            <button wire:click="$set('showForm', false)" type="button"
                                class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- /create /edit form --}}

    {{-- delete popup --}}
    @if ($showConfirmDeletePopup)
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-200 opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block mx-auto overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                    {{ __('Delete Ticket Type') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ __('Are you sure you want to delete this ticket type? This action cannot be undone.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="destroy()" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Delete') }}
                        </button>
                        <button wire:click="$set('showConfirmDeletePopup', false)" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- /delete popup --}}

</div>
