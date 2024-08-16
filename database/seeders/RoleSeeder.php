<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles s'ils n'existent pas déjà
        $roles = [
            'Administrateur' => Permission::all()->pluck('id'),
            'Candidat' => Permission::where('name', 'like', '%candidat')
                ->orWhere('name', 'like', '%candidature')
                ->pluck('id'),
            'Entreprise' => Permission::where('name', 'like', '%entreprise')
                ->orWhere('name', 'like', '%offre')
                ->pluck('id'),
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'deletable' => false,
            ]);

            // Synchroniser les permissions avec le rôle
            $role->permissions()->sync($permissions);
        }
    }
}
