<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::all()->pluck('id', 'name');

        $roles = [
            'Administrateur' => $permissions,
            'Recruteur' => $permissions->filter(function ($id, $name) {
                return str_contains($name, 'recruteur') || str_contains($name, 'offre');
            }),
            'Candidat' => $permissions->filter(function ($id, $name) {
                return str_contains($name, 'candidat') || str_contains($name, 'candidature');
            }),
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
            ]);

            // Synchroniser les permissions avec le rôle
            $role->permissions()->sync($rolePermissions->values());
        }
    }
}
