<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TeatherPlace;

class TeatherPlaces extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    public $teatherPlaceId;
    public $num_row = 1;
    public $num_col = 1;
    public $name;
    public $reservation = false;
    public $selected = false;

    protected $rules = [
        'num_row' => 'required|integer|min:1|max:50',
        'num_col' => 'required|integer|min:1|max:50',
        'name' => 'nullable|string|max:18',
        'reservation' => 'boolean',
        'selected' => 'boolean',
    ];

    public function render()
    {
        $teatherPlaces = TeatherPlace::where('name', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.teather-places', compact('teatherPlaces'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $teatherPlace = TeatherPlace::findOrFail($id);
        $this->teatherPlaceId = $id;
        $this->num_row = $teatherPlace->num_row;
        $this->num_col = $teatherPlace->num_col;
        $this->name = $teatherPlace->name;
        $this->reservation = $teatherPlace->reservation;
        $this->selected = $teatherPlace->selected;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'num_row' => $this->num_row,
            'num_col' => $this->num_col,
            'name' => $this->name,
            'reservation' => $this->reservation,
            'selected' => $this->selected,
        ];

        if ($this->editMode) {
            TeatherPlace::where('id', $this->teatherPlaceId)->update($data);
            session()->flash('success', 'تم تحديث المكان بنجاح');
        } else {
            TeatherPlace::create($data);
            session()->flash('success', 'تم إنشاء المكان بنجاح');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->teatherPlaceId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        TeatherPlace::destroy($this->teatherPlaceId);
        session()->flash('success', 'تم حذف المكان بنجاح');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['teatherPlaceId', 'num_row', 'num_col', 'name', 'reservation', 'selected']);
    }
}
