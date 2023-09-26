<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

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
            'email' => 'paytech_admin23@gmail.com',
            'name' => 'super',
            'password' => Hash::make('uOqmyIvCki'),
            'hint'  =>  "uOqmyIvCki"
        ]);
    }
}
