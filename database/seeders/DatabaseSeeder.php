<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Admin::create([
            'email' => 'admin@gmail.com',
            'name' => 'super',
            'password' => Hash::make('123'),
        ]);
    }
}
