<?php

use App\Models\Ticket;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    
    public function with(): array
    {
        return [
            'tickets' => Ticket::with('show')->latest()->paginate(10),
        ];
    }
}; ?>

<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Tickets Management</h1>
        <flux:button variant="primary">Add Ticket</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Code</flux:table.column>
            <flux:table.column>Show</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column>Price</flux:table.column>
            <flux:table.column>Available</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($tickets as $ticket)
                <flux:table.row>
                    <flux:table.cell>{{ $ticket->code_ticket }}</flux:table.cell>
                    <flux:table.cell>{{ $ticket->show?->name ?? 'N/A' }}</flux:table.cell>
                    <flux:table.cell>{{ $ticket->date_shows }}</flux:table.cell>
                    <flux:table.cell>${{ $ticket->price }}</flux:table.cell>
                    <flux:table.cell>{{ $ticket->rest_ticket }} / {{ $ticket->nomber_ticket }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <div class="mt-4">{{ $tickets->links() }}</div>
</div>
