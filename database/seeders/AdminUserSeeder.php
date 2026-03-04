<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminUserSeeder extends Seeder {
    public function run(): void {
        $user = User::where('name', env('ADMIN_NAME', 'hamzaAd'))->first();
        if (!$user) {
            User::create([
                'name' => env('ADMIN_NAME', 'hamzaAd'),
                'email' => env('ADMIN_EMAIL', 'admin@theater.local'),
                'password' => env('ADMIN_PASSWORD_HASH', '$2y$12$p2LauO/LQvVlgcJvN0MZWubC1Dmlm95xzD1PvmCXHdOi6omEHbs96'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
