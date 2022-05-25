<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'first_name' => 'Wildan',
            'last_name' => 'Fauzi Rakhman',
            'email' => 'wil@gmail.com',
            'password' => Hash::make('123456')
        ]);
        $this->call(ObatalkesMTableSeeder::class);
        $this->call(SignaMTableSeeder::class);
    }
}
