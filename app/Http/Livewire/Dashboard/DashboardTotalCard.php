<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Client;
use App\Models\Show;
use App\Models\Ticket;

class DashboardTotalCard extends Component
{

    public $max_num_row, $max_num_col, $count_tickets, $count_shows, $count_clients;

    public function mount()
    {
        $this->max_num_row = 2;
        $this->max_num_col = 2;
        $this->count_tickets = Client::all()->count();
        $this->count_shows = Show::all()->count();
        $this->count_clients = Ticket::all()->count();

    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-total-card');
    }
}
