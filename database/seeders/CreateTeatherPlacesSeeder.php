<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TeatherPlaces;

class CreateTeatherPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = 20; // number of rows
        $cols = 12; // number of columns

        for ($row = 1; $row <= $rows; $row++) {
            for ($col = 1; $col <= $cols; $col++) {
                TeatherPlaces::create([
                    'num_row' => $row,
                    'num_col' => $col,
                    'name' => 'P_R.' . $row . '_C.' . $col . '_MH',
                    'reservation' => rand(0, 1),
                    'selected' => 0,
                ]);
            }
        }
    }
}
