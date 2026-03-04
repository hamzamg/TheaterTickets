<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ShowsType;

class ShowsTypes extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    public $showTypeId;
    public $type;
    public $slug;
    public $description;
    public $active = true;

    protected $rules = [
        'type' => 'required|string|max:100|unique:shows_types,type',
        'slug' => 'required|string|max:100|unique:shows_types,slug',
        'description' => 'nullable|string',
        'active' => 'boolean',
    ];

    public function render()
    {
        $showTypes = ShowsType::where('type', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.shows-types', compact('showTypes'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $showType = ShowsType::findOrFail($id);
        $this->showTypeId = $id;
        $this->type = $showType->type;
        $this->slug = $showType->slug;
        $this->description = $showType->description;
        $this->active = $showType->active;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->rules['type'] = 'required|string|max:100|unique:shows_types,type,'.$this->showTypeId;
            $this->rules['slug'] = 'required|string|max:100|unique:shows_types,slug,'.$this->showTypeId;
        }
        
        $this->validate();

        $data = [
            'type' => $this->type,
            'slug' => $this->slug,
            'description' => $this->description,
            'active' => $this->active,
        ];

        if ($this->editMode) {
            ShowsType::where('id', $this->showTypeId)->update($data);
            session()->flash('success', 'تم تحديث نوع العرض بنجاح');
        } else {
            ShowsType::create($data);
            session()->flash('success', 'تم إنشاء نوع العرض بنجاح');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->showTypeId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        ShowsType::destroy($this->showTypeId);
        session()->flash('success', 'تم حذف نوع العرض بنجاح');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['showTypeId', 'type', 'slug', 'description', 'active']);
    }
}
