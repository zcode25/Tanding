<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'              => 'Superadmin', 
            'email'             => 'superadmin@gmail.com',
            'phone'              => '081316671373',
            'address'           => 'Bekasi',
            'role'              => 'Superadmin',
            'password'          => Hash::make('password'),
        ]);

        User::create([
            'name'              => 'Admin', 
            'email'             => 'admin@gmail.com',
            'phone'              => '081316671374',
            'address'           => 'Tambun',
            'role'              => 'Admin',
            'password'          => Hash::make('password'),
        ]);

        User::create([
            'name'              => 'User', 
            'email'             => 'user@gmail.com',
            'phone'              => '081316671375',
            'address'           => 'Cibitung',
            'role'              => 'User',
            'password'          => Hash::make('password'),
        ]);
    }
}
