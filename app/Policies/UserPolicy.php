<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Détermine si l'utilisateur peut voir le modèle utilisateur spécifié.
     */
    public function view(User $user): bool
    {
        return $this->viewAny($user);
    }

    /**
     * Détermine si l'utilisateur peut voir tous les utilisateurs.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Détermine si l'utilisateur peut créer un utilisateur.
     */
    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour le modèle utilisateur spécifié.
     */
    public function update(User $user): bool
    {
        return $this->viewAny($user);
    }

}
