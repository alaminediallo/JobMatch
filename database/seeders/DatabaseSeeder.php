<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        // Créer le premier administrateur avec des données spécifiques
        $admin = User::factory()->admin()->create([
            'name' => 'Diallo',
            'prenom' => 'Lamine',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin@test.com'),
        ]);

        $entreprise = User::factory()->entreprise()->create([
            'email' => 'entreprise@test.com',
            'password' => Hash::make('entreprise@test.com'),
        ]);

        $candidat = User::factory()->create([
            'email' => 'candidat@test.com',
            'password' => Hash::make('candidat@test.com'),
        ]);

        // Créer les autres utilisateurs avec des rôles spécifiques
        $adminUsers = User::factory(2)->admin()->create();
        $entrepriseUsers = User::factory(5)->entreprise()->create();
        $candidatUsers = User::factory(10)->create();

        // Récupérer les IDs des rôles
        $adminRoleIds = Role::all()->pluck('id');
        $entrepriseRoleId = Role::where('name', 'entreprise')->value('id');
        $candidatRoleId = Role::where('name', 'candidat')->value('id');

        // Assigner les rôles aux utilisateurs
        $admin->roles()->sync($adminRoleIds);
        $adminUsers->each(fn ($admin) => $admin->roles()->sync($adminRoleIds));

        $entreprise->roles()->sync([$entrepriseRoleId]);
        $entrepriseUsers->each(fn ($user) => $user->roles()->sync([$entrepriseRoleId]));

        $candidat->roles()->sync([$candidatRoleId]);
        $candidatUsers->each(fn ($user) => $user->roles()->sync([$candidatRoleId]));

    }
}
