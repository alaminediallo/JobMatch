<?php

namespace App\Policies;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidaturePolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir la candidature.
     * Recruteurs : Seulement leurs candidatures.
     * Candidats : Seulement leurs propres candidatures.
     */
    public function view(User $user, Candidature $candidature): bool
    {
        if ($user->isAdmin()) {
            return true; // Admin peut tout voir
        }

        // Recruteurs peuvent voir uniquement les candidatures à leurs offres
        if ($user->isRecruteur()) {
            return $candidature->offre->user_id === $user->id;
        }

        // Candidats peuvent voir uniquement leurs propres candidatures
        if ($user->isCandidat()) {
            return $candidature->user_id === $user->id;
        }

        return false; // Par défaut, aucun accès
    }

    /*   public function create(User $user): bool
       {
       }*/

    /**
     * Détermine si l'utilisateur peut mettre à jour la candidature.
     * Recruteurs : Peuvent accepter/refuser les candidatures.
     */
    public function update(User $user, Candidature $candidature): bool
    {
        return $user->isRecruteur() && $candidature->offre->user_id === $user->id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer la candidature.
     * Administrateurs uniquement.
     */
    public function delete(User $user, Candidature $candidature): bool
    {
        return $user->isAdmin();
    }

}
