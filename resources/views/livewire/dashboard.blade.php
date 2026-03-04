<div>
    @if(session()->has('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">لوحة التحكم</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">إجمالي العروض</p>
                    <p class="text-2xl font-bold">{{ $totalShows }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">إجمالي التذاكر</p>
                    <p class="text-2xl font-bold">{{ $totalTickets }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">إجمالي العملاء</p>
                    <p class="text-2xl font-bold">{{ $totalClients }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">إجمالي الحجوزات</p>
                    <p class="text-2xl font-bold">{{ $totalBookings }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold">آخر الحجوزات</h2>
        </div>
        <div class="p-6">
            @if($recentBookings->count() > 0)
            <div class="space-y-4">
                @foreach($recentBookings as $booking)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
                    <div>
                        <p class="font-semibold">{{ $booking->client->firstname }} {{ $booking->client->lastname }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->show->name }}</p>
                    </div>
                    <div class="text-left">
                        <p class="text-sm text-gray-500">{{ $booking->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center">لا توجد حجوزات حديثة</p>
            @endif
        </div>
    </div>

    <!-- Low Stock Alerts -->
    @if($lowStockTickets->count() > 0)
    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
        <h2 class="text-xl font-bold text-red-800 mb-4">⚠️ تنبيه: تذاكر منخفضة المخزون</h2>
        <div class="space-y-2">
            @foreach($lowStockTickets as $ticket)
            <div class="flex items-center justify-between p-3 bg-white rounded">
                <div>
                    <p class="font-semibold">{{ $ticket->show->name }}</p>
                    <p class="text-sm text-gray-500">{{ $ticket->type }}</p>
                </div>
                <div class="text-left">
                    <span class="px-2 py-1 bg-red-100 text-red-800 text-sm rounded">
                        متبقي: {{ $ticket->rest_ticket }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
