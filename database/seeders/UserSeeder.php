<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Afropolis',
            'slug' => 'Afropolis',
            'email' => 'afropolistech@gmail.com',
            'password' =>  Hash::make('Technical2021'),
            'phone' => '2347088886806',
            'is_admin' => true,
            'active' => true,
        ]);

        User::create([
            'name' => 'Joseeph Adeleke',
            'slug' => 'joseeph-adeleke',
            'email' => 'josephadeleke1914@gmail.com',
            'password' =>  Hash::make('Qwerty1'),
            'is_admin' => true,
            'active' => true,
        ]);

        User::create([
            'name' => 'Olatunde Obajeun',
            'slug' => 'oba',
            'email' => 'Olatundeobajeun@gmail.com',
            'password' =>  Hash::make('Technical2021'),
            'is_admin' => true,
            'active' => true,
        ]);

        User::create([
            'name' => 'Joshua Akubo Gabriel',
            'slug' => 'josh',
            'email' => 'Joshuaakubogabriel@gmail.com',
            'password' =>  Hash::make('Technical2021'),
            'is_admin' => true,
            'active' => true,
        ]);

        User::create([
            'name' => 'Qudus',
            'slug' => 'qudus',
            'email' => 'qudus@qdancecenter.com',
            'password' =>  Hash::make('Technical2021'),
            'is_admin' => true,
            'active' => true,
        ]);

        User::create([
            'name' => 'Simon Moses',
            'slug' => 'syflex',
            'email' => 'syflex360@gmail.com',
            'password' =>  Hash::make('Simon@360'),
            'is_admin' => true,
            'active' => true,
        ]);
    }
}
