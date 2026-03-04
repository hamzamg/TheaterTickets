<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Standard', 'slug' => 'standard', 'description' => 'Regular seat', 'price_modifier' => 0, 'active' => true],
            ['name' => 'VIP', 'slug' => 'vip', 'description' => 'Premium seating with extras', 'price_modifier' => 50, 'active' => true],
            ['name' => 'Balcony', 'slug' => 'balcony', 'description' => 'Upper-level view', 'price_modifier' => 20, 'active' => true],
        ];

        foreach ($types as $type) {
            TicketType::updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}
