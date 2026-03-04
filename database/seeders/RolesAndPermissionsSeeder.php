<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'shows.view', 'shows.create', 'shows.edit', 'shows.delete',
            'tickets.view', 'tickets.create', 'tickets.edit', 'tickets.delete',
            'clients.view', 'clients.create', 'clients.edit', 'clients.delete',
            'bookings.view', 'bookings.create', 'bookings.edit', 'bookings.delete',
            'articles.view', 'articles.create', 'articles.edit', 'articles.delete',
            'settings.view', 'settings.edit',
            'users.view', 'users.create', 'users.edit', 'users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'shows.view', 'shows.create', 'shows.edit', 'shows.delete',
            'tickets.view', 'tickets.create', 'tickets.edit', 'tickets.delete',
            'clients.view', 'clients.create', 'clients.edit', 'clients.delete',
            'bookings.view', 'bookings.create', 'bookings.edit', 'bookings.delete',
            'articles.view', 'articles.create', 'articles.edit', 'articles.delete',
            'settings.view',
        ]);

        $role = Role::create(['name' => 'manager']);
        $role->givePermissionTo([
            'shows.view', 'shows.create', 'shows.edit',
            'tickets.view', 'tickets.create', 'tickets.edit',
            'clients.view', 'clients.create', 'clients.edit',
            'bookings.view', 'bookings.create', 'bookings.edit',
            'articles.view', 'articles.create', 'articles.edit',
        ]);

        $role = Role::create(['name' => 'staff']);
        $role->givePermissionTo([
            'shows.view',
            'tickets.view', 'tickets.create',
            'clients.view', 'clients.create',
            'bookings.view', 'bookings.create',
        ]);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
            'shows.view',
            'tickets.view',
            'bookings.view', 'bookings.create',
        ]);

        // Assign super-admin role to admin user
        $adminEmail = env('ADMIN_EMAIL', 'admin@theater.local');
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();
        if ($adminUser) {
            $adminUser->assignRole('super-admin');
        }

        $this->command->info('Roles and permissions seeded successfully!');
    }
}
