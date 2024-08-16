<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Définir les actions communes
        $actions = ['voir', 'créer', 'modifier', 'supprimer'];

        // Définir les entités concernées
        $entities = ['utilisateur', 'candidat', 'candidature', 'offre', 'entreprise', 'role'];

        // Générer les permissions
        $permissions = [];
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                $permissions[] = "{$action} {$entity}";
            }
        }

        // Créer les permissions si elles n'existent pas déjà
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
