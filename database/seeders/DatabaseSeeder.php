<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Age;
use App\Models\Matchclass;
use App\Models\Category;
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


        // Category::create([
        //     'category_name' => 'TANDING',
        //     'category_type' => 'Tanding',
        //     'category_amount' => 'Single',
        // ]);

        // Category::create([
        //     'category_name' => 'TUNGGAL TANGAN KOSONG',
        //     'category_type' => 'Seni',
        //     'category_amount' => 'Single',
        // ]);

        // Category::create([
        //     'category_name' => 'TUNGGAL SEJANTA',
        //     'category_type' => 'Seni',
        //     'category_amount' => 'Single',
        // ]);

        // Category::create([
        //     'category_name' => 'GANDA TANGAN KOSONG',
        //     'category_type' => 'Seni',
        //     'category_amount' => 'Double',
        // ]);

        // Category::create([
        //     'category_name' => 'GANDA SEJANTA',
        //     'category_type' => 'Seni',
        //     'category_amount' => 'Double',
        // ]);

        // Category::create([
        //     'category_name' => 'BEREGU',
        //     'category_type' => 'Seni',
        //     'category_amount' => 'Group',
        // ]);

        // Category::create([
        //     'category_name' => 'SOLO KREATIF',
        //     'category_type' => 'Seni',
        //     'category_amount' => 'Single',
        // ]);

    }
}
