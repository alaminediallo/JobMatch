<?php

namespace App\Policies;

use App\Enums\StatutOffre;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OffrePolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir une offre.
     */
    public function viewAny(User $user): bool
    {
        // Tout le monde peut voir une offre validée
        return $user->isRecruteur() || $user->isAdmin();
    }

    /**
     * Détermine si l'utilisateur peut créer une offre.
     */
    public function create(User $user): bool
    {
        // Seuls les recruteurs (non-admin) peuvent créer des offres
        return $user->isRecruteur();
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour une offre.
     */
    public function update(User $user, Offre $offre): bool
    {
        // Seul le propriétaire de l'offre ou un admin peut la mettre à jour
        return ($user->id === $offre->user_id && $offre->statut === StatutOffre::EN_ATTENTE) || $user->isAdmin();
    }

    /**
     * Détermine si l'utilisateur peut supprimer une offre.
     */
    public function delete(User $user, Offre $offre): bool
    {
        // Seul le propriétaire de l'offre peut la supprimer, si elle n'a pas encore de candidatures
        return $user->id === $offre->user_id && ! $offre->candidatures()->exists();
    }
}
