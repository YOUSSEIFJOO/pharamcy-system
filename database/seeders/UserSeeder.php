<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'          => 'Owner Test',
                'username'      => 'test@owner.com',
                'password'      => Hash::make('123456'),
                'role'          => UserRole::OWNER,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Manager Test',
                'username'      => 'test@manager.com',
                'password'      => Hash::make('123456'),
                'role'          => UserRole::MANAGER,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Cashier Test',
                'username'      => 'test@cashier.com',
                'password'      => Hash::make('123456'),
                'role'          => UserRole::CASHIER,
                'created_at'    => now(),
                'updated_at'    => now()
            ]
        ]);
    }
}
