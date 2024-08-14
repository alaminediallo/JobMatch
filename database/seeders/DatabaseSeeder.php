<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->admin()->create([
            'name' => 'Diallo',
            'prenom' => 'Lamine',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin@test.com'),
        ]);
        User::factory(10)->create();
        User::factory(5)->entreprise()->create();
        User::factory(2)->admin()->create();
    }
}
