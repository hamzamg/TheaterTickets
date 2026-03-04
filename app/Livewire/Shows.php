<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Show;
use App\Models\ShowsType;

class Shows extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    // Form fields
    public $showId;
    public $name;
    public $type;
    public $description;
    public $photo;
    public $photo_path;
    public $active = true;
    public $show_type_id;
    
    public $showTypes;

    protected $rules = [
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:100',
        'description' => 'required|string',
        'photo' => 'nullable|image|max:1024',
        'active' => 'boolean',
        'show_type_id' => 'nullable|exists:shows_types,id',
    ];

    public function mount()
    {
        $this->showTypes = ShowsType::where('active', true)->get();
    }

    public function render()
    {
        $shows = Show::with('showType')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('type', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.shows', compact('shows'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $show = Show::findOrFail($id);
        $this->showId = $id;
        $this->name = $show->name;
        $this->type = $show->type;
        $this->description = $show->description;
        $this->photo_path = $show->photo_path;
        $this->active = $show->active;
        $this->show_type_id = $show->show_type_id;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'active' => $this->active,
            'show_type_id' => $this->show_type_id,
        ];

        if ($this->photo) {
            $data['photo_path'] = $this->photo->store('shows', 'public');
        }

        if ($this->editMode) {
            Show::where('id', $this->showId)->update($data);
            session()->flash('success', 'Show updated successfully.');
        } else {
            Show::create($data);
            session()->flash('success', 'Show created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->showId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Show::destroy($this->showId);
        session()->flash('success', 'Show deleted successfully.');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['showId', 'name', 'type', 'description', 'photo', 'photo_path', 'active', 'show_type_id']);
    }
}
