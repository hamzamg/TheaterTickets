<?php

<<<<<<< HEAD:app/Livewire/TeatherPlaces.php
namespace App\Livewire;
=======
namespace App\Http\Livewire;
>>>>>>> 1741c742aaeac17f6443898e47bfa9262957cb9d:app/Http/Livewire/TeatherPlaces.php

use Livewire\Component;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;
use App\Models\TeatherPlaces as TeatherPlacesModel;

class TeatherPlaces extends Component
{
    public $places, $max_num_row, $max_num_col, $selected_item_id, $hasMorePages, $nextCursor;

    public function mount()
    {
        $this->fetchData();
        // $results = TeatherPlacesModel::select('num_row', 'num_col')->latest()->first();
        $results = TeatherPlacesModel::selectRaw('MAX(num_row) AS max_num_row, MAX(num_col) AS max_num_col')->first();
        $this->max_num_row = $results->max_num_row;
        $this->max_num_col = $results->max_num_col;
    }

    public function fetchData()
    {
        // $this->places = TeatherPlacesModel::all();
        $this->places = new Collection();
        $this->loadTeatherPlaces();
    }

    public function loadTeatherPlaces()
    {
        if ($this->hasMorePages !== null  && !$this->hasMorePages) {
            return;
        }

        $places = TeatherPlacesModel::cursorPaginate(
            24,
            ['*'],
            'cursor',
            Cursor::fromEncoded($this->nextCursor)
        );
        $this->places->push(...$places->items());
        $this->hasMorePages = $places->hasMorePages();
        if ($this->hasMorePages === true) {
            $this->nextCursor = $places->nextCursor()->encode();
        }
    }


    public function selectPlace($id)
    {

        $place = TeatherPlacesModel::findOrFail($id);

        if (!$place->reservation) {
            if (!$place->selected) {
                $place->selected = true;
                $place->reservation = true;
                $place->save();
                //$this->fetchData();
                return redirect()->back()->with('success', 'تم حجز المكان : ' . $place->name . ' بنجاح.');
            } else {
                //$this->fetchData();
                return redirect()->back()->with('warning', 'اختر مكان مختلف "شخص أخر حدد المكان للحجز".');
            }

        } else {
            //$this->fetchData();
            return redirect()->back()->with('error', 'تم حجز المكان : ' . $place->name . ' من طرف شخص أخر.');
        }
    }

    public function selected_place()
    {
        return view('livewire.teather-places');
    }

    public function render()
    {
        return view('livewire.teather-places');
    }
}
