<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TicketsType;

class TicketsTypes extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    public $ticketTypeId;
    public $type;
    public $slug;
    public $description;
    public $price_modifier = 0;
    public $active = true;

    protected $rules = [
        'type' => 'required|string|max:100|unique:tickets_types,type',
        'slug' => 'required|string|max:100|unique:tickets_types,slug',
        'description' => 'nullable|string',
        'price_modifier' => 'required|numeric',
        'active' => 'boolean',
    ];

    public function render()
    {
        $ticketTypes = TicketsType::where('type', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.tickets-types', compact('ticketTypes'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $ticketType = TicketsType::findOrFail($id);
        $this->ticketTypeId = $id;
        $this->type = $ticketType->type;
        $this->slug = $ticketType->slug;
        $this->description = $ticketType->description;
        $this->price_modifier = $ticketType->price_modifier;
        $this->active = $ticketType->active;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->rules['type'] = 'required|string|max:100|unique:tickets_types,type,'.$this->ticketTypeId;
            $this->rules['slug'] = 'required|string|max:100|unique:tickets_types,slug,'.$this->ticketTypeId;
        }
        
        $this->validate();

        $data = [
            'type' => $this->type,
            'slug' => $this->slug,
            'description' => $this->description,
            'price_modifier' => $this->price_modifier,
            'active' => $this->active,
        ];

        if ($this->editMode) {
            TicketsType::where('id', $this->ticketTypeId)->update($data);
            session()->flash('success', 'تم تحديث نوع التذكرة بنجاح');
        } else {
            TicketsType::create($data);
            session()->flash('success', 'تم إنشاء نوع التذكرة بنجاح');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->ticketTypeId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        TicketsType::destroy($this->ticketTypeId);
        session()->flash('success', 'تم حذف نوع التذكرة بنجاح');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['ticketTypeId', 'type', 'slug', 'description', 'price_modifier', 'active']);
    }
}
