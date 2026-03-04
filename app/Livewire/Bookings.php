<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bayticket;
use App\Models\Client;
use App\Models\Show;
use App\Models\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Bookings extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $showQrModal = false;
    public $editMode = false;
    
    public $bookingId;
    public $client_id;
    public $show_id;
    public $ticket_id;
    public $quantity = 1;
    public $notes;
    public $qrCode;
    
    public $clients;
    public $shows;
    public $tickets;

    protected $rules = [
        'client_id' => 'required|exists:clients,id',
        'show_id' => 'required|exists:shows,id',
        'ticket_id' => 'required|exists:tickets,id',
        'quantity' => 'required|integer|min:1',
        'notes' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->clients = Client::all();
        $this->shows = Show::where('active', true)->get();
    }

    public function updatedShowId($value)
    {
        if ($value) {
            $this->tickets = Ticket::where('show_id', $value)
                ->where('rest_ticket', '>', 0)
                ->get();
        }
    }

    public function render()
    {
        $bookings = Bayticket::with(['client', 'show', 'ticket'])
            ->whereHas('client', function($q) {
                $q->where('firstname', 'like', '%'.$this->search.'%')
                  ->orWhere('lastname', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.bookings', compact('bookings'));
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $booking = Bayticket::findOrFail($id);
        $this->bookingId = $id;
        $this->client_id = $booking->client_id;
        $this->show_id = $booking->show_id;
        $this->ticket_id = $booking->ticket_id;
        $this->quantity = $booking->quantity;
        $this->notes = $booking->notes;
        $this->updatedShowId($this->show_id);
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Generate QR code
        $qrData = 'TKT-' . strtoupper(uniqid());
        $qrCode = QrCode::format('png')->size(300)->generate($qrData);
        $qrPath = 'qrcodes/' . $qrData . '.png';
        \Storage::disk('public')->put($qrPath, $qrCode);

        $data = [
            'client_id' => $this->client_id,
            'show_id' => $this->show_id,
            'ticket_id' => $this->ticket_id,
            'quantity' => $this->quantity,
            'notes' => $this->notes,
            'qrcode' => $qrPath,
        ];

        if ($this->editMode) {
            Bayticket::where('id', $this->bookingId)->update($data);
            session()->flash('success', 'Booking updated successfully.');
        } else {
            Bayticket::create($data);
            // Decrease available tickets
            Ticket::where('id', $this->ticket_id)->decrement('rest_ticket', $this->quantity);
            session()->flash('success', 'Booking created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function showQr($id)
    {
        $booking = Bayticket::findOrFail($id);
        $this->qrCode = $booking->qrcode;
        $this->showQrModal = true;
    }

    public function confirmDelete($id)
    {
        $this->bookingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $booking = Bayticket::find($this->bookingId);
        // Restore available tickets
        Ticket::where('id', $booking->ticket_id)->increment('rest_ticket', $booking->quantity);
        $booking->delete();
        
        session()->flash('success', 'Booking deleted successfully.');
        $this->showDeleteModal = false;
    }

    private function resetForm()
    {
        $this->reset(['bookingId', 'client_id', 'show_id', 'ticket_id', 'quantity', 'notes', 'tickets']);
    }
}
