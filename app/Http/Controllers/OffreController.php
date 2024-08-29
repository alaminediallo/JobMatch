<?php

namespace App\Http\Controllers;

use App\Enums\TypeOffre;
use App\Http\Requests\OffreRequest;
use App\Models\Category;
use App\Models\Offre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OffreController extends Controller
{
    // TODO: Faire valider l'offre par l'admin avant de l'afficher pour le candidat
    /**
     * Affiche la liste des offres d'emploi.
     */
    public function index(): View
    {
        $offres = Offre::with('category')
            ->where('user_id', auth()->id())
            ->get();

        return view('offre.index', compact('offres'));
    }

    /**
     * Enregistre une nouvelle offre d'emploi dans la base de données.
     */
    public function store(OffreRequest $request): RedirectResponse
    {
        $request->user()->offres()->create($request->validated());

        return to_route('offre.index')->with('message', 'Offre d\'emploi créée avec succès.');
    }

    /**
     * Affiche le formulaire pour créer une nouvelle offre d'emploi.
     */
    public function create(): View
    {
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
        return view('offre.show', compact('offre'));
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
     * Met à jour une offre d'emploi spécifique dans la base de données.
     */
    public function update(OffreRequest $request, Offre $offre): RedirectResponse
    {
        $offre->update($request->validated());

        return to_route('offre.index')->with('message', 'Offre d\'emploi mise à jour avec succès.');
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
}
