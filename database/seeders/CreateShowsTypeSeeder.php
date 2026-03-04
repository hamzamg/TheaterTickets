<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShowsType;
use Illuminate\Support\Str;

class CreateShowsTypeSeeder extends Seeder
{
    protected $showsTypeArray = [
        ['type' => 'مسرحية', 'description' => 'قصص تمثيلية'],
        ['type' => 'عرض', 'description' => 'عروض حية مميزة'],
        ['type' => 'حفلة', 'description' => 'مناسبات موسيقية'],
        ['type' => 'محاضرة', 'description' => 'جلسات تعليمية'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->showsTypeArray as $showsType) {
           ShowsType::updateOrCreate([
                'type' => $showsType['type']
            ], [
                'slug' => Str::slug($showsType['type']),
                'description' => $showsType['description'],
                'active' => true,
            ]);
          }
    }
}
