<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Show;
use App\Models\Ticket;
use App\Models\Client;
use App\Models\Bayticket;

class Dashboard extends Component
{
    public $totalShows;
    public $totalTickets;
    public $totalClients;
    public $totalBookings;
    public $recentBookings;
    public $lowStockTickets;

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->totalShows = Show::where('active', true)->count();
        $this->totalTickets = Ticket::sum('nomber_ticket');
        $this->totalClients = Client::count();
        $this->totalBookings = Bayticket::count();
        
        $this->recentBookings = Bayticket::with(['client', 'show', 'ticket'])
            ->latest()
            ->take(5)
            ->get();
            
        $this->lowStockTickets = Ticket::with('show')
            ->whereColumn('rest_ticket', '<=', 'nomber_ticket')
            ->where('rest_ticket', '<', 10)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
