<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates one user for each role with password "password".
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            User::ROLE_SUPERADMIN => 'superadmin@example.com',
            User::ROLE_ADMIN => 'admin@example.com',
            User::ROLE_SALES => 'sales@example.com',
            User::ROLE_FINANCE => 'finance@example.com',
            User::ROLE_GUDANG => 'gudang@example.com',
        ];

        foreach ($roles as $role => $email) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($role) . ' User',
                    'password' => Hash::make('password'),
                    'role' => $role,
                ]
            );
        }
    }
}
