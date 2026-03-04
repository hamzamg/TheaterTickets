<?php

use App\Models\Client;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    
    public function with(): array
    {
        return [
            'clients' => Client::latest()->paginate(10),
        ];
    }
}; ?>

<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Clients Management</h1>
        <flux:button variant="primary">Add Client</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Phone</flux:table.column>
            <flux:table.column>Age</flux:table.column>
            <flux:table.column>Payment Method</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($clients as $client)
                <flux:table.row>
                    <flux:table.cell>{{ $client->firstname }} {{ $client->lastname }}</flux:table.cell>
                    <flux:table.cell>{{ $client->phone }}</flux:table.cell>
                    <flux:table.cell>{{ $client->age }}</flux:table.cell>
                    <flux:table.cell>{{ $client->pay_method }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <div class="mt-4">{{ $clients->links() }}</div>
</div>
