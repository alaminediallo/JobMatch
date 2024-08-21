<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Définir les actions communes et les entités concernées
        $actions = collect(['voir', 'créer', 'modifier', 'supprimer']);
        $entities = collect(['utilisateur', 'candidat', 'candidature', 'offre', 'recruteur', 'role']);

        // Générer et créer les permissions si elles n'existent pas déjà
        $actions->crossJoin($entities)->each(function ($pair) {
            [$action, $entity] = $pair;
            Permission::firstOrCreate(['name' => "{$action} {$entity}"]);
        });
    }
}
