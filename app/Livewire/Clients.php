<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class Clients extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    public $clientId;
    public $firstname;
    public $lastname;
    public $sex = 'M';
    public $age;
    public $card_id;
    public $phone;
    public $pay_method = 'cash';

    protected $rules = [
        'firstname' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'sex' => 'required|in:M,F',
        'age' => 'required|integer|min:1|max:120',
        'card_id' => 'nullable|string|max:50',
        'phone' => 'required|string|max:20',
        'pay_method' => 'required|in:cash,card,transfer',
    ];

    public function render()
    {
        $clients = Client::where('firstname', 'like', '%'.$this->search.'%')
            ->orWhere('lastname', 'like', '%'.$this->search.'%')
            ->orWhere('phone', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.clients', compact('clients'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $this->clientId = $id;
        $this->firstname = $client->firstname;
        $this->lastname = $client->lastname;
        $this->sex = $client->sex;
        $this->age = $client->age;
        $this->card_id = $client->card_id;
        $this->phone = $client->phone;
        $this->pay_method = $client->pay_method;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'sex' => $this->sex,
            'age' => $this->age,
            'card_id' => $this->card_id,
            'phone' => $this->phone,
            'pay_method' => $this->pay_method,
        ];

        if ($this->editMode) {
            Client::where('id', $this->clientId)->update($data);
            session()->flash('success', 'Client updated successfully.');
        } else {
            Client::create($data);
            session()->flash('success', 'Client created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->clientId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Client::destroy($this->clientId);
        session()->flash('success', 'Client deleted successfully.');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['clientId', 'firstname', 'lastname', 'sex', 'age', 'card_id', 'phone', 'pay_method']);
    }
}
