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


        Category::create([
            'category_name' => 'TANDING',
            'category_type' => 'Tanding',
            'category_amount' => 'Single',
        ]);

        Category::create([
            'category_name' => 'TUNGGAL TANGAN KOSONG',
            'category_type' => 'Seni',
            'category_amount' => 'Single',
        ]);

        Category::create([
            'category_name' => 'TUNGGAL SEJANTA',
            'category_type' => 'Seni',
            'category_amount' => 'Single',
        ]);

        Category::create([
            'category_name' => 'GANDA TANGAN KOSONG',
            'category_type' => 'Seni',
            'category_amount' => 'Double',
        ]);

        Category::create([
            'category_name' => 'GANDA SEJANTA',
            'category_type' => 'Seni',
            'category_amount' => 'Double',
        ]);

        Category::create([
            'category_name' => 'BEREGU',
            'category_type' => 'Seni',
            'category_amount' => 'Group',
        ]);

        Category::create([
            'category_name' => 'SOLO KREATIF',
            'category_type' => 'Seni',
            'category_amount' => 'Single',
        ]);

        Age::create([
            'age_name' => 'PRA USIA DINI (<5 TAHUN)'
        ]);

        Age::create([
            'age_name' => 'USIA DINI 1 (5-8 TAHUN)'
        ]);

        Age::create([
            'age_name' => 'USIA DINI 2 (8-11 TAHUN)'
        ]);

        Age::create([
            'age_name' => 'PRA REMAJA (11-14 TAHUN)'
        ]);

        Age::create([
            'age_name' => 'REMAJA (14-18 TAHUN)'
        ]);

        Age::create([
            'age_name' => 'DEWASA (SENIOR/MHS/PERGURUAN SILAT)'
        ]);

        //Usia Dini 1 Putra
        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putra',
            'class_min' => '26',
            'class_max' => '28',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putra',
            'class_min' => '28',
            'class_max' => '30',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putra',
            'class_min' => '30',
            'class_max' => '32',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putra',
            'class_min' => '32',
            'class_max' => '34',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putra',
            'class_min' => '34',
            'class_max' => '36',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putra',
            'class_min' => '36',
            'class_max' => '38',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putra',
            'class_min' => '38',
            'class_max' => '40',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putra',
            'class_min' => '40',
            'class_max' => '42',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putra',
            'class_min' => '42',
            'class_max' => '44',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putra',
            'class_min' => '44',
            'class_max' => '46',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putra',
            'class_min' => '46',
            'class_max' => '48',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putra',
            'class_min' => '48',
            'class_max' => '50',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS M',
            'class_gender' => 'Putra',
            'class_min' => '50',
            'class_max' => '52',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS N',
            'class_gender' => 'Putra',
            'class_min' => '52',
            'class_max' => '54',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS O',
            'class_gender' => 'Putra',
            'class_min' => '54',
            'class_max' => '56',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS P',
            'class_gender' => 'Putra',
            'class_min' => '56',
            'class_max' => '58',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS Q',
            'class_gender' => 'Putra',
            'class_min' => '58',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS R',
            'class_gender' => 'Putra',
            'class_min' => '60',
            'class_max' => '62',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS S',
            'class_gender' => 'Putra',
            'class_min' => '62',
            'class_max' => '64',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putra',
            'class_min' => '64',
            'class_max' => '68',
        ]);


        //Usia Dini 1 Putri
        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putri',
            'class_min' => '26',
            'class_max' => '28',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putri',
            'class_min' => '28',
            'class_max' => '30',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putri',
            'class_min' => '30',
            'class_max' => '32',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putri',
            'class_min' => '32',
            'class_max' => '34',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putri',
            'class_min' => '34',
            'class_max' => '36',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putri',
            'class_min' => '36',
            'class_max' => '38',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putri',
            'class_min' => '38',
            'class_max' => '40',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putri',
            'class_min' => '40',
            'class_max' => '42',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putri',
            'class_min' => '42',
            'class_max' => '44',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putri',
            'class_min' => '44',
            'class_max' => '46',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putri',
            'class_min' => '46',
            'class_max' => '48',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putri',
            'class_min' => '48',
            'class_max' => '50',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS M',
            'class_gender' => 'Putri',
            'class_min' => '50',
            'class_max' => '52',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS N',
            'class_gender' => 'Putri',
            'class_min' => '52',
            'class_max' => '54',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS O',
            'class_gender' => 'Putri',
            'class_min' => '54',
            'class_max' => '56',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS P',
            'class_gender' => 'Putri',
            'class_min' => '56',
            'class_max' => '58',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS Q',
            'class_gender' => 'Putri',
            'class_min' => '58',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS R',
            'class_gender' => 'Putri',
            'class_min' => '60',
            'class_max' => '62',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS S',
            'class_gender' => 'Putri',
            'class_min' => '62',
            'class_max' => '64',
        ]);

        Matchclass::create([
            'age_id' => 2,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putri',
            'class_min' => '64',
            'class_max' => '68',
        ]);

         //Usia Dini 2 Putra
         Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putra',
            'class_min' => '26',
            'class_max' => '28',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putra',
            'class_min' => '28',
            'class_max' => '30',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putra',
            'class_min' => '30',
            'class_max' => '32',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putra',
            'class_min' => '32',
            'class_max' => '34',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putra',
            'class_min' => '34',
            'class_max' => '36',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putra',
            'class_min' => '36',
            'class_max' => '38',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putra',
            'class_min' => '38',
            'class_max' => '40',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putra',
            'class_min' => '40',
            'class_max' => '42',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putra',
            'class_min' => '42',
            'class_max' => '44',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putra',
            'class_min' => '44',
            'class_max' => '46',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putra',
            'class_min' => '46',
            'class_max' => '48',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putra',
            'class_min' => '48',
            'class_max' => '50',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS M',
            'class_gender' => 'Putra',
            'class_min' => '50',
            'class_max' => '52',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS N',
            'class_gender' => 'Putra',
            'class_min' => '52',
            'class_max' => '54',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS O',
            'class_gender' => 'Putra',
            'class_min' => '54',
            'class_max' => '56',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS P',
            'class_gender' => 'Putra',
            'class_min' => '56',
            'class_max' => '58',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS Q',
            'class_gender' => 'Putra',
            'class_min' => '58',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS R',
            'class_gender' => 'Putra',
            'class_min' => '60',
            'class_max' => '62',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS S',
            'class_gender' => 'Putra',
            'class_min' => '62',
            'class_max' => '64',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putra',
            'class_min' => '64',
            'class_max' => '68',
        ]);


        //Usia Dini 2 Putri
        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putri',
            'class_min' => '26',
            'class_max' => '28',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putri',
            'class_min' => '28',
            'class_max' => '30',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putri',
            'class_min' => '30',
            'class_max' => '32',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putri',
            'class_min' => '32',
            'class_max' => '34',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putri',
            'class_min' => '34',
            'class_max' => '36',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putri',
            'class_min' => '36',
            'class_max' => '38',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putri',
            'class_min' => '38',
            'class_max' => '40',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putri',
            'class_min' => '40',
            'class_max' => '42',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putri',
            'class_min' => '42',
            'class_max' => '44',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putri',
            'class_min' => '44',
            'class_max' => '46',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putri',
            'class_min' => '46',
            'class_max' => '48',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putri',
            'class_min' => '48',
            'class_max' => '50',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS M',
            'class_gender' => 'Putri',
            'class_min' => '50',
            'class_max' => '52',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS N',
            'class_gender' => 'Putri',
            'class_min' => '52',
            'class_max' => '54',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS O',
            'class_gender' => 'Putri',
            'class_min' => '54',
            'class_max' => '56',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS P',
            'class_gender' => 'Putri',
            'class_min' => '56',
            'class_max' => '58',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS Q',
            'class_gender' => 'Putri',
            'class_min' => '58',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS R',
            'class_gender' => 'Putri',
            'class_min' => '60',
            'class_max' => '62',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS S',
            'class_gender' => 'Putri',
            'class_min' => '62',
            'class_max' => '64',
        ]);

        Matchclass::create([
            'age_id' => 3,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putri',
            'class_min' => '64',
            'class_max' => '68',
        ]);

        //Pra Remaja Putra
        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putra',
            'class_min' => '30',
            'class_max' => '33',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putra',
            'class_min' => '33',
            'class_max' => '36',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putra',
            'class_min' => '36',
            'class_max' => '39',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putra',
            'class_min' => '39',
            'class_max' => '42',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putra',
            'class_min' => '42',
            'class_max' => '45',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putra',
            'class_min' => '45',
            'class_max' => '48',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putra',
            'class_min' => '48',
            'class_max' => '51',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putra',
            'class_min' => '51',
            'class_max' => '54',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putra',
            'class_min' => '54',
            'class_max' => '57',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putra',
            'class_min' => '57',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putra',
            'class_min' => '60',
            'class_max' => '63',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putra',
            'class_min' => '63',
            'class_max' => '66',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS M',
            'class_gender' => 'Putra',
            'class_min' => '66',
            'class_max' => '69',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS N',
            'class_gender' => 'Putra',
            'class_min' => '69',
            'class_max' => '72',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS O',
            'class_gender' => 'Putra',
            'class_min' => '72',
            'class_max' => '75',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS P',
            'class_gender' => 'Putra',
            'class_min' => '75',
            'class_max' => '78',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putra',
            'class_min' => '78',
            'class_max' => '84',
        ]);


        //Pra Remaja Putri
        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putri',
            'class_min' => '30',
            'class_max' => '33',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putri',
            'class_min' => '33',
            'class_max' => '36',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putri',
            'class_min' => '36',
            'class_max' => '39',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putri',
            'class_min' => '39',
            'class_max' => '42',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putri',
            'class_min' => '42',
            'class_max' => '45',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putri',
            'class_min' => '45',
            'class_max' => '48',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putri',
            'class_min' => '48',
            'class_max' => '51',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putri',
            'class_min' => '51',
            'class_max' => '54',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putri',
            'class_min' => '54',
            'class_max' => '57',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putri',
            'class_min' => '57',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putri',
            'class_min' => '60',
            'class_max' => '63',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putri',
            'class_min' => '63',
            'class_max' => '66',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS M',
            'class_gender' => 'Putri',
            'class_min' => '66',
            'class_max' => '69',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS N',
            'class_gender' => 'Putri',
            'class_min' => '69',
            'class_max' => '72',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS O',
            'class_gender' => 'Putri',
            'class_min' => '72',
            'class_max' => '75',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS P',
            'class_gender' => 'Putri',
            'class_min' => '75',
            'class_max' => '78',
        ]);

        Matchclass::create([
            'age_id' => 4,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putri',
            'class_min' => '78',
            'class_max' => '84',
        ]);

        //Remaja Putra
        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putra',
            'class_min' => '39',
            'class_max' => '43',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putra',
            'class_min' => '43',
            'class_max' => '47',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putra',
            'class_min' => '47',
            'class_max' => '51',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putra',
            'class_min' => '51',
            'class_max' => '55',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putra',
            'class_min' => '55',
            'class_max' => '59',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putra',
            'class_min' => '59',
            'class_max' => '63',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putra',
            'class_min' => '63',
            'class_max' => '67',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putra',
            'class_min' => '67',
            'class_max' => '71',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putra',
            'class_min' => '71',
            'class_max' => '75',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putra',
            'class_min' => '75',
            'class_max' => '79',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS K',
            'class_gender' => 'Putra',
            'class_min' => '79',
            'class_max' => '83',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS L',
            'class_gender' => 'Putra',
            'class_min' => '83',
            'class_max' => '87',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putra',
            'class_min' => '87',
            'class_max' => '100',
        ]);

        //Remaja PutrI
        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putri',
            'class_min' => '39',
            'class_max' => '43',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putri',
            'class_min' => '43',
            'class_max' => '47',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putri',
            'class_min' => '47',
            'class_max' => '51',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putri',
            'class_min' => '51',
            'class_max' => '55',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putri',
            'class_min' => '55',
            'class_max' => '59',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putri',
            'class_min' => '59',
            'class_max' => '63',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putri',
            'class_min' => '63',
            'class_max' => '67',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putri',
            'class_min' => '67',
            'class_max' => '71',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putri',
            'class_min' => '71',
            'class_max' => '75',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putri',
            'class_min' => '75',
            'class_max' => '79',
        ]);

        Matchclass::create([
            'age_id' => 5,
            'class_name' => 'KELAS OPEN',
            'class_gender' => 'Putra',
            'class_min' => '79',
            'class_max' => '92',
        ]);

        //Dewasa Putra
        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putra',
            'class_min' => '45',
            'class_max' => '50',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putra',
            'class_min' => '50',
            'class_max' => '55',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putra',
            'class_min' => '55',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putra',
            'class_min' => '60',
            'class_max' => '65',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putra',
            'class_min' => '65',
            'class_max' => '70',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putra',
            'class_min' => '70',
            'class_max' => '75',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putra',
            'class_min' => '75',
            'class_max' => '80',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putra',
            'class_min' => '80',
            'class_max' => '85',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putra',
            'class_min' => '85',
            'class_max' => '90',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS J',
            'class_gender' => 'Putra',
            'class_min' => '90',
            'class_max' => '95',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS OPEN 1',
            'class_gender' => 'Putra',
            'class_min' => '95',
            'class_max' => '110',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS OPEN 2',
            'class_gender' => 'Putra',
            'class_min' => '110',
            'class_max' => '115',
        ]);

        //Dewasa Putri
        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS A',
            'class_gender' => 'Putri',
            'class_min' => '45',
            'class_max' => '50',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS B',
            'class_gender' => 'Putri',
            'class_min' => '50',
            'class_max' => '55',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS C',
            'class_gender' => 'Putri',
            'class_min' => '55',
            'class_max' => '60',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS D',
            'class_gender' => 'Putri',
            'class_min' => '60',
            'class_max' => '65',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS E',
            'class_gender' => 'Putri',
            'class_min' => '65',
            'class_max' => '70',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS F',
            'class_gender' => 'Putri',
            'class_min' => '70',
            'class_max' => '75',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS G',
            'class_gender' => 'Putri',
            'class_min' => '75',
            'class_max' => '80',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS H',
            'class_gender' => 'Putri',
            'class_min' => '80',
            'class_max' => '85',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS I',
            'class_gender' => 'Putri',
            'class_min' => '85',
            'class_max' => '90',
        ]);

        Matchclass::create([
            'age_id' => 6,
            'class_name' => 'KELAS OPEN 1',
            'class_gender' => 'Putri',
            'class_min' => '90',
            'class_max' => '100',
        ]);
        
    }
}
