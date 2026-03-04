<?php

use App\Models\Bayticket;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    
    public function with(): array
    {
        return [
            'bookings' => Bayticket::with(['client', 'show', 'ticket'])->latest()->paginate(10),
        ];
    }
}; ?>

<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Bookings Management</h1>
        <flux:button variant="primary">New Booking</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Client</flux:table.column>
            <flux:table.column>Show</flux:table.column>
            <flux:table.column>Ticket</flux:table.column>
            <flux:table.column>Quantity</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($bookings as $booking)
                <flux:table.row>
                    <flux:table.cell>{{ $booking->client?->firstname }} {{ $booking->client?->lastname }}</flux:table.cell>
                    <flux:table.cell>{{ $booking->show?->name ?? 'N/A' }}</flux:table.cell>
                    <flux:table.cell>{{ $booking->ticket?->code_ticket ?? 'N/A' }}</flux:table.cell>
                    <flux:table.cell>{{ $booking->quantity }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <div class="mt-4">{{ $bookings->links() }}</div>
</div>
