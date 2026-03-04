<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ticket;
use App\Models\Show;
use App\Models\TicketsType;

class Tickets extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    
    public $ticketId;
    public $date_shows;
    public $time_shows;
    public $nomber_ticket;
    public $rest_ticket;
    public $price;
    public $code_ticket;
    public $type;
    public $show_id;
    public $ticket_type_id;
    
    public $shows;
    public $ticketTypes;

    protected $rules = [
        'date_shows' => 'required|date',
        'time_shows' => 'required',
        'nomber_ticket' => 'required|integer|min:1',
        'rest_ticket' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'code_ticket' => 'required|string|max:15|unique:tickets,code_ticket',
        'type' => 'required|string|max:100',
        'show_id' => 'required|exists:shows,id',
        'ticket_type_id' => 'nullable|exists:tickets_types,id',
    ];

    public function mount()
    {
        $this->shows = Show::where('active', true)->get();
        $this->ticketTypes = TicketsType::where('active', true)->get();
    }

    public function render()
    {
        $tickets = Ticket::with(['show', 'ticketType'])
            ->where('code_ticket', 'like', '%'.$this->search.'%')
            ->orWhere('type', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.tickets', compact('tickets'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->ticketId = $id;
        $this->date_shows = $ticket->date_shows->format('Y-m-d');
        $this->time_shows = $ticket->time_shows;
        $this->nomber_ticket = $ticket->nomber_ticket;
        $this->rest_ticket = $ticket->rest_ticket;
        $this->price = $ticket->price;
        $this->code_ticket = $ticket->code_ticket;
        $this->type = $ticket->type;
        $this->show_id = $ticket->show_id;
        $this->ticket_type_id = $ticket->ticket_type_id;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->rules['code_ticket'] = 'required|string|max:15|unique:tickets,code_ticket,'.$this->ticketId;
        }
        
        $this->validate();

        $data = [
            'date_shows' => $this->date_shows,
            'time_shows' => $this->time_shows,
            'nomber_ticket' => $this->nomber_ticket,
            'rest_ticket' => $this->rest_ticket,
            'price' => $this->price,
            'code_ticket' => $this->code_ticket,
            'type' => $this->type,
            'show_id' => $this->show_id,
            'ticket_type_id' => $this->ticket_type_id,
        ];

        if ($this->editMode) {
            Ticket::where('id', $this->ticketId)->update($data);
            session()->flash('success', 'Ticket updated successfully.');
        } else {
            Ticket::create($data);
            session()->flash('success', 'Ticket created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->ticketId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Ticket::destroy($this->ticketId);
        session()->flash('success', 'Ticket deleted successfully.');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['ticketId', 'date_shows', 'time_shows', 'nomber_ticket', 'rest_ticket', 
                      'price', 'code_ticket', 'type', 'show_id', 'ticket_type_id']);
    }
}
