<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TicketsType;

class CreateTicketsTypeSeeder extends Seeder
{
    protected $ticketsTypeArray = array("إقتصادية", "أعمال", "مميز");
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->ticketsTypeArray as $ticketsType) {
            TicketsType::create([
                'type' => $ticketsType
            ]);
          }
    }
}
