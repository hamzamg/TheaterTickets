<?php

<<<<<<< HEAD:app/Livewire/Show.php
namespace App\Livewire;
=======
namespace App\Http\Livewire;
>>>>>>> 1741c742aaeac17f6443898e47bfa9262957cb9d:app/Http/Livewire/Show.php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Show as Model;


class Show extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $name;
   public $type;
   public $description;
   public $photo_path;
   public $active;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
'name' => 'required',
'type' => 'required',
'description' => 'required',
'photo_path' => 'required',
'active' => 'required',

];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $model = Model::where('name', 'like', '%'.$this->search.'%')->orWhere('type', 'like', '%'.$this->search.'%')->orWhere('description', 'like', '%'.$this->search.'%')->orWhere('photo_path', 'like', '%'.$this->search.'%')->orWhere('active', 'like', '%'.$this->search.'%')->latest()->paginate($this->paginate);
        return view('livewire.show', [
            'rows'=> $model
        ]);
    }


    public function create ()
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

        $this->name= $model->name;
$this->type= $model->type;
$this->description= $model->description;
$this->photo_path= $model->photo_path;
$this->active= $model->active;



        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function store()
    {
          $this->validate();

          $model = new Model();

             $model->name= $this->name;
$model->type= $this->type;
$model->description= $this->description;
$model->photo_path= $this->photo_path;
$model->active= $this->active;
 $model->save();

          $this->resetForm();
          session()->flash('message', 'Record Saved Successfully');
          $this->showForm = false;
    }

    public function resetForm()
    {
        $this->name= "";
$this->type= "";
$this->description= "";
$this->photo_path= "";
$this->active= "";

    }


    public function update()
    {
          $this->validate();

          $model = Model::find($this->primaryId);

             $model->name= $this->name;
$model->type= $this->type;
$model->description= $this->description;
$model->photo_path= $this->photo_path;
$model->active= $this->active;
 $model->save();

          $this->resetForm();

          $this->showForm = false;

         session()->flash('message', 'Record Updated Successfully');
    }

    public function confirmDelete($primaryId)
    {
        $this->primaryId = $primaryId;
        $this->showConfirmDeletePopup = true;
    }

    public function destroy()
    {
        Model::find($this->primaryId)->delete();
        $this->showConfirmDeletePopup = false;
        session()->flash('message', 'Record Deleted Successfully');
    }

    public function clearFlash()
    {
        session()->forget('message');
    }

}
