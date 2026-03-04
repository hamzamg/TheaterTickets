<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminName = env('ADMIN_NAME', 'hamzaAd');
        $adminEmail = env('ADMIN_EMAIL', 'admin@theater.local');
        $adminPassword = env('ADMIN_PASSWORD', 'ad123456');

        DB::table('users')->updateOrInsert(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info("Admin user created: $adminName <$adminEmail>");
    }
}
