<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bayticket as Model;
use App\Models\Client;
use App\Models\Show;
use App\Models\Ticket;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Storage;

class Baytickets extends Component
{
    use WithPagination;

    public $paginate = 10;

    // Form fields
    public $client_id;
    public $show_id;
    public $ticket_id;
    public $quantity = 1;
    public $notes;

    // QR Code display
    public $showQrModal = false;
    public $currentQrCode = null;
    public $currentBooking = null;

    public $mode = 'create';
    public $showForm = false;
    public $primaryId = null;
    public $search;
    public $showConfirmDeletePopup = false;

    // Dropdown data
    public $clients = [];
    public $shows = [];
    public $tickets = [];

    protected $rules = [
        'client_id' => 'required|exists:clients,id',
        'show_id' => 'required|exists:shows,id',
        'ticket_id' => 'required|exists:tickets,id',
        'quantity' => 'required|integer|min:1|max:10',
        'notes' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->loadDropdowns();
    }

    protected function loadDropdowns()
    {
        $this->clients = Client::orderBy('lastname')->orderBy('firstname')->get();
        $this->shows = Show::where('active', true)->orderBy('name')->get();
        
        // Load available tickets based on selected show
        if ($this->show_id) {
            $this->loadTicketsForShow();
        } else {
            $this->tickets = collect();
        }
    }

    public function updatedShowId($value)
    {
        $this->ticket_id = null; // Reset ticket when show changes
        $this->loadTicketsForShow();
    }

    protected function loadTicketsForShow()
    {
        if ($this->show_id) {
            $this->tickets = Ticket::where('show_id', $this->show_id)
                ->where('active', true)
                ->where('rest_ticket', '>', 0)
                ->with('show')
                ->orderBy('date_shows')
                ->get();
        }
    }

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
        $model = Model::with(['client', 'show', 'ticket'])
            ->where(function($query) {
                $query->whereHas('client', function($q) {
                    $q->where('firstname', 'like', '%'.$this->search.'%')
                      ->orWhere('lastname', 'like', '%'.$this->search.'%');
                })
                ->orWhereHas('show', function($q) {
                    $q->where('name', 'like', '%'.$this->search.'%');
                })
                ->orWhereHas('ticket', function($q) {
                    $q->where('code_ticket', 'like', '%'.$this->search.'%');
                });
            })
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.baytickets', [
            'rows' => $model
        ]);
    }

    public function create()
    {
        $this->mode = 'create';
        $this->resetForm();
        $this->loadDropdowns();
        $this->showForm = true;
    }

    public function edit($primaryId)
    {
        $this->mode = 'update';
        $this->primaryId = $primaryId;
        $this->loadDropdowns();
        
        $model = Model::find($primaryId);
        $this->client_id = $model->client_id;
        $this->show_id = $model->show_id;
        $this->loadTicketsForShow(); // Load tickets for this show
        $this->ticket_id = $model->ticket_id;
        $this->quantity = $model->quantity ?? 1;
        $this->notes = $model->notes;

        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function store()
    {
        $this->validate();

        // Check ticket availability
        $ticket = Ticket::find($this->ticket_id);
        if (!$ticket || $ticket->rest_ticket < $this->quantity) {
            session()->flash('error', 'Not enough tickets available. Only ' . ($ticket->rest_ticket ?? 0) . ' left.');
            return;
        }

        // Create booking
        $model = new Model();
        $model->client_id = $this->client_id;
        $model->show_id = $this->show_id;
        $model->ticket_id = $this->ticket_id;
        $model->quantity = $this->quantity;
        $model->notes = $this->notes;
        
        // Generate QR code
        $client = Client::find($this->client_id);
        $qrData = QrCodeService::generateBookingQr(
            0, // Will be updated after save
            $client->firstname . ' ' . $client->lastname,
            $ticket->show->name,
            $ticket->code_ticket
        );
        $model->qrcode = $qrData;
        
        $model->save();
        
        // Update booking ID in QR code and regenerate
        $model->qrcode = QrCodeService::generateBookingQr(
            $model->id,
            $client->firstname . ' ' . $client->lastname,
            $ticket->show->name,
            $ticket->code_ticket
        );
        $model->save();

        // Decrease available tickets
        $ticket->rest_ticket -= $this->quantity;
        $ticket->save();

        $this->resetForm();
        session()->flash('message', 'Booking created successfully. QR code generated.');
        $this->showForm = false;
    }

    public function resetForm()
    {
        $this->client_id = '';
        $this->show_id = '';
        $this->ticket_id = '';
        $this->quantity = 1;
        $this->notes = '';
        $this->tickets = collect();
    }

    public function update()
    {
        $this->validate();

        $model = Model::find($this->primaryId);
        
        // Handle quantity changes
        $oldQuantity = $model->quantity;
        $quantityDiff = $this->quantity - $oldQuantity;
        
        if ($quantityDiff != 0) {
            $ticket = Ticket::find($this->ticket_id);
            
            if ($quantityDiff > 0 && $ticket->rest_ticket < $quantityDiff) {
                session()->flash('error', 'Not enough additional tickets available.');
                return;
            }
            
            // Update ticket availability
            $ticket->rest_ticket -= $quantityDiff;
            $ticket->save();
        }

        $model->client_id = $this->client_id;
        $model->show_id = $this->show_id;
        $model->ticket_id = $this->ticket_id;
        $model->quantity = $this->quantity;
        $model->notes = $this->notes;
        $model->save();

        $this->resetForm();
        $this->showForm = false;
        session()->flash('message', 'Booking updated successfully');
    }

    public function confirmDelete($primaryId)
    {
        $this->primaryId = $primaryId;
        $this->showConfirmDeletePopup = true;
    }

    public function destroy()
    {
        $model = Model::find($this->primaryId);
        
        // Restore ticket availability
        $ticket = Ticket::find($model->ticket_id);
        if ($ticket) {
            $ticket->rest_ticket += $model->quantity;
            $ticket->save();
        }
        
        $model->delete();
        $this->showConfirmDeletePopup = false;
        session()->flash('message', 'Booking deleted successfully. Tickets restored.');
    }

    public function showQr($id)
    {
        $booking = Model::with(['client', 'show', 'ticket'])->find($id);
        if ($booking) {
            $this->currentBooking = $booking;
            $this->currentQrCode = $booking->qrcode;
            $this->showQrModal = true;
        }
    }

    public function closeQrModal()
    {
        $this->showQrModal = false;
        $this->currentQrCode = null;
        $this->currentBooking = null;
    }

    public function clearFlash()
    {
        session()->forget('message');
        session()->forget('error');
    }
}