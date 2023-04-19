<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client as Model;


class Clients extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $firstname;
   public $lastname;
   public $sex;
   public $age;
   public $card_id;
   public $phone;
   public $pay_method;


    public $mode = 'create';

    public $showForm = false;

    public $primaryId = null;

    public $search;

    public $showConfirmDeletePopup = false;

    protected $rules = [
'firstname' => 'required',
'lastname' => 'required',
'sex' => 'required',
'age' => 'required',
'card_id' => 'required',
'phone' => 'required',
'pay_method' => 'required',

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
        $model = Model::where('firstname', 'like', '%'.$this->search.'%')->orWhere('lastname', 'like', '%'.$this->search.'%')->orWhere('sex', 'like', '%'.$this->search.'%')->orWhere('age', 'like', '%'.$this->search.'%')->orWhere('card_id', 'like', '%'.$this->search.'%')->orWhere('phone', 'like', '%'.$this->search.'%')->orWhere('pay_method', 'like', '%'.$this->search.'%')->latest()->paginate($this->paginate);
        return view('livewire.client', [
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

        $this->firstname= $model->firstname;
$this->lastname= $model->lastname;
$this->sex= $model->sex;
$this->age= $model->age;
$this->card_id= $model->card_id;
$this->phone= $model->phone;
$this->pay_method= $model->pay_method;



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

             $model->firstname= $this->firstname;
$model->lastname= $this->lastname;
$model->sex= $this->sex;
$model->age= $this->age;
$model->card_id= $this->card_id;
$model->phone= $this->phone;
$model->pay_method= $this->pay_method;
 $model->save();

          $this->resetForm();
          session()->flash('message', 'Record Saved Successfully');
          $this->showForm = false;
    }

    public function resetForm()
    {
        $this->firstname= "";
$this->lastname= "";
$this->sex= "";
$this->age= "";
$this->card_id= "";
$this->phone= "";
$this->pay_method= "";

    }


    public function update()
    {
          $this->validate();

          $model = Model::find($this->primaryId);

             $model->firstname= $this->firstname;
$model->lastname= $this->lastname;
$model->sex= $this->sex;
$model->age= $this->age;
$model->card_id= $this->card_id;
$model->phone= $this->phone;
$model->pay_method= $this->pay_method;
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
