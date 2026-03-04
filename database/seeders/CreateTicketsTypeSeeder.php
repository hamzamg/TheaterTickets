<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TicketsType;
use Illuminate\Support\Str;

class CreateTicketsTypeSeeder extends Seeder
{
    protected $ticketsTypeArray = [
        ['type' => 'إقتصادية', 'description' => 'مقاعد أمامية مع قدرة مشاهدة جيدة', 'price_modifier' => 0],
        ['type' => 'أعمال', 'description' => 'مقاعد مميزة بخدمات إضافية', 'price_modifier' => 40],
        ['type' => 'مميز', 'description' => 'شرفات أو جلسات خاصة', 'price_modifier' => 80],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->ticketsTypeArray as $ticketsType) {
            TicketsType::updateOrCreate([
                'type' => $ticketsType['type'],
            ], [
                'slug' => Str::slug($ticketsType['type']),
                'description' => $ticketsType['description'],
                'price_modifier' => $ticketsType['price_modifier'],
                'active' => true,
            ]);
          }
    }
}
