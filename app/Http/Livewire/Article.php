<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article as Model;


class Article extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $title;
   public $body;
   public $photo_path;
   public $lang;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
'title' => 'required',
'body' => 'required',
'photo_path' => 'required',
'lang' => 'required',

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
        $model = Model::where('title', 'like', '%'.$this->search.'%')->orWhere('body', 'like', '%'.$this->search.'%')->orWhere('photo_path', 'like', '%'.$this->search.'%')->orWhere('lang', 'like', '%'.$this->search.'%')->latest()->paginate($this->paginate);
        return view('livewire.article', [
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

        $this->title= $model->title;
$this->body= $model->body;
$this->photo_path= $model->photo_path;
$this->lang= $model->lang;



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

             $model->title= $this->title;
$model->body= $this->body;
$model->photo_path= $this->photo_path;
$model->lang= $this->lang;
 $model->save();

          $this->resetForm();
          session()->flash('message', 'Record Saved Successfully');
          $this->showForm = false;
    }

    public function resetForm()
    {
        $this->title= "";
$this->body= "";
$this->photo_path= "";
$this->lang= "";

    }


    public function update()
    {
          $this->validate();

          $model = Model::find($this->primaryId);

             $model->title= $this->title;
$model->body= $this->body;
$model->photo_path= $this->photo_path;
$model->lang= $this->lang;
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
