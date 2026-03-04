<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TicketsType as Model;

class TicketsType extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $type;
    public $slug;
    public $description;
    public $price_modifier = 0;
    public $active = true;

    public $mode = 'create';
    public $showForm = false;
    public $primaryId = null;
    public $search;
    public $showConfirmDeletePopup = false;

    protected $rules = [
        'type' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:tickets_types,slug',
        'description' => 'nullable|string',
        'price_modifier' => 'required|numeric|min:0',
        'active' => 'boolean',
    ];

    protected function rules()
    {
        $rules = $this->rules;
        if ($this->mode === 'update') {
            $rules['slug'] = 'required|string|max:255|unique:tickets_types,slug,' . $this->primaryId;
        }
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedType()
    {
        if ($this->mode === 'create' && empty($this->slug)) {
            $this->slug = \Illuminate\Support\Str::slug($this->type);
        }
    }

    public function render()
    {
        $model = Model::withCount('tickets')
            ->where('type', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.tickets-type', [
            'rows' => $model
        ]);
    }

    public function create()
    {
        $this->mode = 'create';
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($primaryId)
    {
        $this->mode = 'update';
        $this->primaryId = $primaryId;
        $model = Model::find($primaryId);

        $this->type = $model->type;
        $this->slug = $model->slug;
        $this->description = $model->description;
        $this->price_modifier = $model->price_modifier;
        $this->active = $model->active;

        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function store()
    {
        $this->validate($this->rules());

        $model = new Model();
        $model->type = $this->type;
        $model->slug = $this->slug;
        $model->description = $this->description;
        $model->price_modifier = $this->price_modifier;
        $model->active = $this->active;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Ticket Type created successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->type = "";
        $this->slug = "";
        $this->description = "";
        $this->price_modifier = 0;
        $this->active = true;
    }

    public function update()
    {
        $this->validate($this->rules());

        $model = Model::find($this->primaryId);
        $model->type = $this->type;
        $model->slug = $this->slug;
        $model->description = $this->description;
        $model->price_modifier = $this->price_modifier;
        $model->active = $this->active;
        $model->save();

        $this->resetForm();
        $this->showForm = false;
        session()->flash('message', 'Ticket Type updated successfully');
    }

    public function confirmDelete($primaryId)
    {
        $this->primaryId = $primaryId;
        $this->showConfirmDeletePopup = true;
    }

    public function destroy()
    {
        $model = Model::find($this->primaryId);
        
        // Check if there are related tickets
        if ($model->tickets()->count() > 0) {
            session()->flash('error', 'Cannot delete: This ticket type has associated tickets');
            $this->showConfirmDeletePopup = false;
            return;
        }
        
        $model->delete();
        $this->showConfirmDeletePopup = false;
        session()->flash('message', 'Ticket Type deleted successfully');
    }

    public function clearFlash()
    {
        session()->forget('message');
        session()->forget('error');
    }
}
