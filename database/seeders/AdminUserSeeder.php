<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Reads admin credentials from .env file
     */
    public function run(): void
    {
        // Get admin credentials from environment variables
        $adminName = env('ADMIN_NAME', 'hamzaAd');
        $adminEmail = env('ADMIN_EMAIL', 'admin@theater.local');
        $adminPasswordHash = env('ADMIN_PASSWORD_HASH');
        
        // Use raw SQL to bypass the password mutator in User model
        // This prevents double-hashing of the password
        \DB::table('users')->updateOrInsert(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => $adminPasswordHash,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        $this->command->info('Admin user created/updated successfully!');
        $this->command->info('Username: ' . $adminName);
        $this->command->info('Email: ' . $adminEmail);
    }
}
