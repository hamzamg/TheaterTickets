<?php

namespace Database\Seeders;

use App\Models\ShowType;
use Illuminate\Database\Seeder;

class ShowTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Drama', 'slug' => 'drama', 'description' => 'Story-driven performances', 'active' => true],
            ['name' => 'Musical', 'slug' => 'musical', 'description' => 'Songs and dance', 'active' => true],
            ['name' => 'Stand-up', 'slug' => 'stand-up', 'description' => 'Comedy shows', 'active' => true],
        ];

        foreach ($types as $type) {
            ShowType::updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}
