<?php

namespace App\Http\Controllers;

use App\Enums\StatutOffre;
use App\Enums\TypeOffre;
use App\Events\OffreCreated;
use App\Http\Requests\OffreRequest;
use App\Models\Category;
use App\Models\Offre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OffreController extends Controller
{
    /**
     * Affiche la liste des offres d'emploi.
     */
    public function index(): View
    {
        $isAdmin = auth()->user()->isAdministrator();

        if ($isAdmin) {
            return view('offre.index', [
                'offres' => Offre::with('user')->whereStatut(StatutOffre::EN_ATTENTE)->get(),
                'isAdmin' => $isAdmin,
            ]);
        }

        return view('offre.index', [
            'offres' => auth()->user()->offres,
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * Enregistre une nouvelle offre d'emploi dans la base de données.
     */
    public function store(OffreRequest $request): RedirectResponse
    {
        $offre = $request->user()->offres()->create($request->validated());

        // envoyer un mail à l'admin lors de la création d'une offre
        event(new OffreCreated($offre));

        return to_route('offre.index')->with('message', 'Offre d\'emploi créée avec succès.');
    }

    /**
     * Affiche le formulaire pour créer une nouvelle offre d'emploi.
     */
    public function create(): View|RedirectResponse
    {
        if (! auth()->user()->type_entreprise_id) {
            return to_route('profile.edit');
        }

        return view('offre.add', [
            'offre' => new Offre(),
            'categories' => Category::all(),
            'typeOffres' => TypeOffre::getLabels(), // Afficher les types d'offres
        ]);
    }

    /**
     * Affiche les détails d'une offre d'emploi spécifique.
     */
    public function show(Offre $offre): View
    {
        return view('offre.show', [
            'offre' => $offre,
            'isAdmin' => auth()->user()?->isAdministrator() ?? false,
        ]);
    }

    /**
     * Affiche le formulaire d'édition pour une offre d'emploi spécifique.
     */
    public function edit(Offre $offre): View
    {
        return view('offre.edit', [
            'offre' => $offre,
            'categories' => Category::all(),
            'typeOffres' => TypeOffre::getLabels(),
        ]);
    }

    /**
     * Supprime une offre d'emploi spécifique de la base de données.
     */
    public function destroy(Offre $offre): RedirectResponse
    {
        // TODO: Verifier que l'offre n'a pas de candidature
        $offre->delete();

        return to_route('offre.index')->with('message', 'Offre d\'emploi supprimée avec succès.');
    }


    /**
     * Valider une offre d'emploi.
     */
    public function validateOffre(Offre $offre): RedirectResponse
    {
        if (! auth()->user()->isAdministrator()) {
            abort(403, "Vous n'êtes pas autorisé à valider cette offre.");
        }

        // Mettre à jour le champ is_validated
        $offre->update(['statut' => StatutOffre::VALIDER]);

        return to_route('offre.index')->with('message', 'Offre validée avec succès.');
    }

    /**
     * Met à jour une offre d'emploi spécifique dans la base de données.
     */
    public function update(OffreRequest $request, Offre $offre): RedirectResponse
    {
        $offre->update($request->validated());

        return to_route('offre.index')->with('message', 'Offre d\'emploi mise à jour avec succès.');
    }

    /**
     * Rejeter une offre d'emploi.
     */
    public function rejeterOffre(Offre $offre): RedirectResponse
    {
        if (! auth()->user()->isAdministrator()) {
            abort(403, "Vous n'êtes pas autorisé à rejeter cette offre.");
        }

        // Rejeter l'offre
        $offre->update(['statut' => StatutOffre::REJETER]);

        return redirect()->back()->with('message', 'Offre rejetée avec succès.');
    }
}
