<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShowsType;

class CreateShowsTypeSeeder extends Seeder
{
    protected $showsTypeArray = array("مسرحية", "عرض", "حفلة", "محاضرة");
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->showsTypeArray as $showsType) {
           ShowsType::create([
                'type' => $showsType
            ]);
          }
    }
}
