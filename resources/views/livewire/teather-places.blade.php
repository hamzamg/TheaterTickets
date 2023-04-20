<div>
    <div class="px-12 py-2">
        @if (session()->get('success'))
            <div class="p-4 text-teal-700 bg-teal-100 border-l-4 border-r-4 border-teal-500">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->get('warning'))
            <div class="p-4 text-orange-700 bg-orange-100 border-l-4 border-r-4 border-orange-500">
                {{ session()->get('warning') }}
            </div>
        @endif
        @if (session()->get('error'))
            <div class="p-4 text-red-700 bg-red-100 border-l-4 border-r-4 border-red-500">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>
    <div class="grid grid-cols-{{ $max_num_col > 8 ? 8 : $max_num_col }}  gap-4 p-6 items-center">
        @foreach ($places as $place)
            <div wire:key="{{ $place['id'] }}" wire:click="selectPlace({{ $place['id'] }})" id="{{ $place['id'] }}"
                class="p-4 h-28 rounded-md shadow-md outline-dotted outline-offset-1 outline-1 hover:ring hover:ring-offset-4

                 {{ $place['reservation']
                     ? 'bg-amber-200 outline-amber-500 text-amber-900 hover:ring-amber-700'
                     : ($place['selected']
                         ? 'bg-teal-400 outline-teal-600 text-teal-900 hover:ring-teal-800'
                         : 'bg-teal-300 outline-teal-500 text-teal-900 hover:ring-teal-700') }}
                cursor-pointer"
                {{ $place['reservation'] ? 'disabled' : '' }} x-data="{ tooltip: false }" x-on:mouseover="tooltip = true"
                x-on:mouseout="tooltip = false">
                <div class="relative text-center align-top">
                    <div x-show="tooltip"
                        class="absolute z-10 p-2 text-gray-800 uppercase bg-white rounded-lg shadow-lg -top-10">
                        {{ $place['reservation'] ? 'محجوز' : ($place['selected'] ? 'شخص ما اختار المقعد' : 'غير محجوز') }}

                    </div>
                    <div class="w-full h-full">
                        <div>كود : {{ $place['name'] }}</div>
                        <div>الصف : {{ $place['num_row'] }}</div>
                        <div>المقعد : {{ $place['num_col'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($hasMorePages)
            <button wire:click.prevent="loadTeatherPlaces">تجهيز المقاعد ...</button>
        @endif
    </div>
    @if ($hasMorePages)
        <div x-data="{
            init() {
                let observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            @this.call('loadTeatherPlaces')
                        }
                    })
                }, {
                    root: null
                });
                observer.POLL_INTERVAL = 100
                observer.observe(this.$el);
            }
        }">
        </div>
    @endif
</div>
