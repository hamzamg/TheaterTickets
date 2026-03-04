<?php

use App\Models\Show;
use App\Models\ShowsType;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $editing = null;
    
    public $name = '';
    public $type = '';
    public $description = '';
    public $photo_path = '';
    public $active = true;
    public $show_type_id = '';

    public function with(): array
    {
        return [
            'shows' => Show::with('showType')
                ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->latest()
                ->paginate($this->perPage),
            'showTypes' => ShowsType::where('active', true)->get(),
        ];
    }

    public function create()
    {
        $this->editing = null;
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(Show $show)
    {
        $this->editing = $show->id;
        $this->name = $show->name;
        $this->type = $show->type;
        $this->description = $show->description;
        $this->photo_path = $show->photo_path;
        $this->active = $show->active;
        $this->show_type_id = $show->show_type_id;
        $this->showModal = true;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'required|string',
            'photo_path' => 'required|string|max:255',
            'active' => 'boolean',
            'show_type_id' => 'nullable|exists:shows_types,id',
        ]);

        if ($this->editing) {
            Show::find($this->editing)->update($validated);
            $this->dispatch('notify', message: 'Show updated successfully');
        } else {
            Show::create($validated);
            $this->dispatch('notify', message: 'Show created successfully');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete(Show $show)
    {
        $show->delete();
        $this->dispatch('notify', message: 'Show deleted successfully');
    }

    public function resetForm()
    {
        $this->reset(['name', 'type', 'description', 'photo_path', 'show_type_id']);
        $this->active = true;
    }
}; ?>

<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Shows Management</h1>
        <flux:button wire:click="create" variant="primary">Add Show</flux:button>
    </div>

    <div class="mb-4">
        <flux:input wire:model.live="search" placeholder="Search shows..." icon="magnifying-glass" />
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Type</flux:table.column>
            <flux:table.column>Category</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($shows as $show)
                <flux:table.row>
                    <flux:table.cell>{{ $show->name }}</flux:table.cell>
                    <flux:table.cell>{{ $show->type }}</flux:table.cell>
                    <flux:table.cell>{{ $show->showType?->type ?? 'N/A' }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge variant="{{ $show->active ? 'success' : 'danger' }}">
                            {{ $show->active ? 'Active' : 'Inactive' }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        <flux:button wire:click="edit({{ $show->id }})" size="sm" variant="ghost">Edit</flux:button>
                        <flux:button wire:click="delete({{ $show->id }})" size="sm" variant="ghost" wire:confirm="Are you sure?">Delete</flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $shows->links() }}
    </div>

    <flux:modal wire:model="showModal" :title="$editing ? 'Edit Show' : 'Add Show'">
        <div class="space-y-4">
            <flux:input wire:model="name" label="Name" required />
            <flux:input wire:model="type" label="Type" required />
            <flux:textarea wire:model="description" label="Description" required />
            <flux:input wire:model="photo_path" label="Photo URL" required />
            <flux:select wire:model="show_type_id" label="Category">
                <option value="">Select Category</option>
                @foreach($showTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </flux:select>
            <flux:checkbox wire:model="active" label="Active" />
        </div>

        <x-slot name="footer">
            <flux:button wire:click="save" variant="primary">Save</flux:button>
            <flux:button wire:click="$set('showModal', false)" variant="ghost">Cancel</flux:button>
        </x-slot>
    </flux:modal>
</div>
