<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ticket as Model;
use App\Models\Show;
use App\Models\TicketsType;
use Illuminate\Support\Str;

class Tickets extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $date_shows;
    public $time_shows;
    public $nomber_ticket;
    public $rest_ticket;
    public $price;
    public $code_ticket;
    public $type;
    public $show_id;
    public $ticket_type_id;
    public $active = true;

    public $mode = 'create';
    public $showForm = false;
    public $primaryId = null;
    public $search;
    public $showConfirmDeletePopup = false;

    public $shows = [];
    public $ticketTypes = [];

    protected $rules = [
        'date_shows' => 'required|date',
        'time_shows' => 'required',
        'nomber_ticket' => 'required|integer|min:1',
        'rest_ticket' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'code_ticket' => 'required|string|max:15',
        'type' => 'required|string|max:100',
        'show_id' => 'required|exists:shows,id',
        'ticket_type_id' => 'nullable|exists:tickets_types,id',
        'active' => 'boolean',
    ];

    public function mount()
    {
        $this->loadDropdowns();
    }

    protected function loadDropdowns()
    {
        $this->shows = Show::where('active', true)->orderBy('name')->get();
        $this->ticketTypes = TicketsType::where('active', true)->orderBy('type')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedTicketTypeId($value)
    {
        if ($value) {
            $ticketType = TicketsType::find($value);
            if ($ticketType && $ticketType->price_modifier) {
                // Apply price modifier if base price exists
                $basePrice = $this->price ?? 0;
                $this->price = $basePrice * (1 + $ticketType->price_modifier / 100);
            }
        }
    }

    public function render()
    {
        $model = Model::with(['show', 'ticketType'])
            ->where(function($query) {
                $query->where('code_ticket', 'like', '%'.$this->search.'%')
                    ->orWhere('type', 'like', '%'.$this->search.'%')
                    ->orWhereHas('show', function($q) {
                        $q->where('name', 'like', '%'.$this->search.'%');
                    });
            })
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.tickets', [
            'rows' => $model
        ]);
    }

    public function create()
    {
        $this->mode = 'create';
        $this->resetForm();
        $this->loadDropdowns();
        $this->generateCode();
        $this->showForm = true;
    }

    protected function generateCode()
    {
        $this->code_ticket = 'TKT-' . strtoupper(Str::random(8));
    }

    public function edit($primaryId)
    {
        $this->mode = 'update';
        $this->primaryId = $primaryId;
        $this->loadDropdowns();
        
        $model = Model::find($primaryId);
        $this->date_shows = $model->date_shows;
        $this->time_shows = $model->time_shows;
        $this->nomber_ticket = $model->nomber_ticket;
        $this->rest_ticket = $model->rest_ticket;
        $this->price = $model->price;
        $this->code_ticket = $model->code_ticket;
        $this->type = $model->type;
        $this->show_id = $model->show_id;
        $this->ticket_type_id = $model->ticket_type_id;
        $this->active = $model->active;

        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function store()
    {
        $this->validate();

        // Ensure rest_ticket doesn't exceed total
        if ($this->rest_ticket > $this->nomber_ticket) {
            $this->rest_ticket = $this->nomber_ticket;
        }

        $model = new Model();
        $model->date_shows = $this->date_shows;
        $model->time_shows = $this->time_shows;
        $model->nomber_ticket = $this->nomber_ticket;
        $model->rest_ticket = $this->rest_ticket;
        $model->price = $this->price;
        $model->code_ticket = $this->code_ticket;
        $model->type = $this->type;
        $model->show_id = $this->show_id;
        $model->ticket_type_id = $this->ticket_type_id;
        $model->active = $this->active;
        $model->save();

        $this->resetForm();
        session()->flash('message', 'Ticket created successfully');
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->date_shows = '';
        $this->time_shows = '';
        $this->nomber_ticket = '';
        $this->rest_ticket = '';
        $this->price = '';
        $this->code_ticket = '';
        $this->type = '';
        $this->show_id = '';
        $this->ticket_type_id = '';
        $this->active = true;
    }

    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);
        $model->date_shows = $this->date_shows;
        $model->time_shows = $this->time_shows;
        $model->nomber_ticket = $this->nomber_ticket;
        $model->rest_ticket = $this->rest_ticket;
        $model->price = $this->price;
        $model->code_ticket = $this->code_ticket;
        $model->type = $this->type;
        $model->show_id = $this->show_id;
        $model->ticket_type_id = $this->ticket_type_id;
        $model->active = $this->active;
        $model->save();

        $this->resetForm();
        $this->showForm = false;
        session()->flash('message', 'Ticket updated successfully');
    }

    public function confirmDelete($primaryId)
    {
        $this->primaryId = $primaryId;
        $this->showConfirmDeletePopup = true;
    }

    public function destroy()
    {
        $model = Model::find($this->primaryId);
        
        // Check if ticket has bookings
        if ($model->baytickets()->count() > 0) {
            session()->flash('error', 'Cannot delete ticket with existing bookings');
            $this->showConfirmDeletePopup = false;
            return;
        }
        
        $model->delete();
        $this->showConfirmDeletePopup = false;
        session()->flash('message', 'Ticket deleted successfully');
    }

    public function clearFlash()
    {
        session()->forget('message');
        session()->forget('error');
    }

    // Low inventory alert check
    public function checkLowInventory()
    {
        $lowInventoryTickets = Model::whereColumn('rest_ticket', '<=', 'nomber_ticket')
            ->where('active', true)
            ->whereRaw('rest_ticket <= (nomber_ticket * 0.1)') // Less than 10% remaining
            ->get();

        return $lowInventoryTickets;
    }
}