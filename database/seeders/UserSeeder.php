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
            'password' =>  Hash::make('secret'),
            'phone' => '2347088886806',
            'is_admin' => true,
            'active' => true,
        ]);
    }
}
