<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Détermine si l'utilisateur peut voir tous les utilisateurs.
     */
    public function viewAny(User $user): bool
    {
        // Seul un utilisateur avec une permission spéciale ou un admin peut voir tous les utilisateurs.
        return $user->hasPermissionTo('voir utilisateur');
    }

    /**
     * Détermine si l'utilisateur peut voir le modèle utilisateur spécifié.
     */
    public function view(User $user, User $model): bool
    {
        // Un utilisateur peut voir son propre profil ou si l'utilisateur a une permission spéciale.
        return $user->id === $model->id || $user->hasPermissionTo('voir utilisateur');
    }

    /**
     * Détermine si l'utilisateur peut créer un utilisateur.
     */
    public function create(User $user): bool
    {
        // Seul un utilisateur avec une permission spéciale ou un admin peut créer des utilisateurs.
        return $user->hasPermissionTo('créer utilisateur');
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour le modèle utilisateur spécifié.
     */
    public function update(User $user, User $model): bool
    {
        // Un utilisateur peut mettre à jour son propre profil ou si l'utilisateur a une permission spéciale.
        return $user->id === $model->id || $user->hasPermissionTo('modifier utilisateur');
    }

    /**
     * Détermine si l'utilisateur peut supprimer le modèle utilisateur spécifié.
     */
    public function delete(User $user, User $model): bool
    {
        // Un utilisateur peut supprimer son propre profil ou si l'utilisateur a une permission spéciale.
        return $user->id === $model->id || $user->hasPermissionTo('supprimer utilisateur');
    }
}
