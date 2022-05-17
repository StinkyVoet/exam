<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(1)->create([
            'name' => 'admin',
            'password' => Hash::make('#1Geheim'),
            'is_admin' => 1,
        ]);
        \App\Models\User::factory(3)->create();
        \App\Models\Trip::factory(10)->create();
    }
}
