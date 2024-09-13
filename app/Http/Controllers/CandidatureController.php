<?php

namespace App\Http\Controllers;

use App\Enums\StatutCandidature;
use App\Http\Requests\CandidatureRequest;
use App\Models\Candidature;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CandidatureController extends Controller
{
    public function index(?Offre $offre = null): View
    {
        $user = auth()->user();

        if ($user->isRecruteur()) {
            // Récupérer les candidatures liées aux offres du recruteur
            $candidatures = Candidature::whereHas('offre', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } elseif ($user->isCandidat()) {
            // Récupérer les candidatures du candidat connecté
            $candidatures = $user->candidatures()->get();
        } else {
            abort(403); // Accès non autorisé
        }

        return view('candidature.index', compact('candidatures', 'offre'));
    }

    public function accepter(Candidature $candidature): RedirectResponse
    {
        $this->authorize('update', $candidature);

        $candidature->update(['statut' => StatutCandidature::ACCEPTER]);

        // todo : Envoyer un email au candidat pour l'informer de l'acceptation
        // Mail::to($candidature->user->email)->send(new CandidatureAcceptee($candidature));

        return to_route('offre.candidature.index', $candidature->offre)
            ->with('message', 'Candidature acceptée avec succès.');
    }

    public function rejeter(Candidature $candidature): RedirectResponse
    {
        $this->authorize('update', $candidature);

        $candidature->update(['statut' => StatutCandidature::REJETER]);

        // todo : Envoyer un email au candidat pour l'informer du rejet
        // Mail::to($candidature->user->email)->send(new CandidatureRejetee($candidature));

        return to_route('offre.candidature.index', $candidature->offre)
            ->with('message', 'Candidature rejetée avec succès.');
    }

    public function store(CandidatureRequest $request, Offre $offre): RedirectResponse
    {
        $this->authorize('create', Candidature::class);

        $data = $request->validated();

        // Gestion des fichiers (lettre de motivation et CV)
        $data['lettre_motivation'] = $this->handleUploadedFile($request, 'lettre_motivation', 'candidatures');
        $data['cv'] = $this->handleUploadedFile($request, 'cv', 'candidatures');
        $data['offre_id'] = $offre->id;

        $request->user()->candidatures()->create($data);

        return to_route('candidature.index')->with('message', 'Candidature créée avec succès');
    }

    public function create(Offre $offre): View
    {
        $this->authorize('create', Candidature::class);

        return view('candidature.add', compact('offre'));
    }

    /**
     * Afficher les détails d'une candidature et les informations du candidat.
     */
    public function show(Offre $offre, Candidature $candidature): View
    {
        // Autoriser l'accès à la candidature en fonction des policies
        $this->authorize('view', $candidature);

        // Récupérer toutes les informations du candidat lié à cette candidature
        $candidat = User::with(['langues', 'competences', 'experiences', 'formations'])
            ->find($candidature->user_id, ['id', 'name', 'prenom', 'email', 'tel', 'adresse']);

        // Afficher la vue avec les détails de la candidature et du candidat
        return view('candidature.show', compact('candidat', 'candidature', 'offre'));
    }
}
