<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Master;
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
        User::factory(1)->create();


        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@gmail.com',
        ]);

        Admin::factory(1)->create();

        Admin::factory()->create([
            'name'      => config('app.name'),
            'email'     => 'admin@gmail.com',
            'registration_token' => 'RB-31'
        ]);

        Master::factory()->create([
            'name'      => config('app.name'),
            'email'     => 'master@gmail.com',
        ]);
    }
}
