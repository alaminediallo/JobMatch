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
            TypeEntrepriseSeeder::class,
            CategorySeeder::class,
        ]);

        $roles = Role::whereIn('name', ['Administrateur', 'Recruteur', 'Candidat'])
            ->pluck('id', 'name');

        $adminRoleId = $roles['Administrateur'];
        $recruteurRoleId = $roles['Recruteur'];
        $candidatRoleId = $roles['Candidat'];

        // Créer le premier administrateur avec des données spécifiques
        $this->createUser('Diallo', 'Lamine', 'admin@test.com', $adminRoleId);

        $this->createUser(null, null, 'recruteur@test.com', $recruteurRoleId);
        $this->createUser(null, null, 'candidat@test.com', $candidatRoleId);

        // Créer les autres utilisateurs avec des rôles spécifiques
        User::factory(2)->create(['role_id' => $adminRoleId]);
        User::factory(5)->create(['role_id' => $recruteurRoleId]);
        User::factory(10)->create(['role_id' => $candidatRoleId]);
    }

    private function createUser(?string $name, ?string $prenom, string $email, int $roleId): void
    {
        User::factory()->create([
            'name' => $name ?? fake()->lastName(),
            'prenom' => $prenom ?? fake()->firstName(),
            'email' => $email,
            'password' => Hash::make($email),
            'role_id' => $roleId,
        ]);
    }
}
