<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompetenceController extends Controller
{
    /**
     * Affiche la liste des compétences.
     */
    public function index(): View
    {
        $competences = Competence::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->with([
            'users' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ])->get();

        return view('competence.index', compact('competences'));
    }

    /**
     * Enregistre une nouvelle compétence dans la base de données.
     */
    public function store(CompetenceRequest $request): RedirectResponse
    {
        // Création de la compétence
        $competence = Competence::create($request->validated());

        // Associer la compétence créée à l'utilisateur connecté
        $request->user()->competences()->attach($competence->id);

        return redirect()->route('competence.index')
            ->with('message', 'Compétence créée avec succès.');
    }

    /**
     * Affiche le formulaire pour créer une nouvelle compétence.
     */
    public function create(): View
    {
        return view('competence.add', [
            'competence' => new Competence,
        ]);
    }

    /**
     * Affiche le formulaire d'édition pour une compétence spécifique.
     */
    public function edit(Competence $competence): View
    {
        return view('competence.edit', compact('competence'));
    }

    /**
     * Met à jour une compétence spécifique dans la base de données.
     */
    public function update(CompetenceRequest $request, Competence $competence): RedirectResponse
    {
        // Mise à jour de la compétence
        $competence->update($request->validated());

        // Re-synchroniser la compétence avec l'utilisateur connecté
        $request->user()->competences()->syncWithoutDetaching([$competence->id]);

        return redirect()->route('competence.index')
            ->with('message', 'Compétence mise à jour avec succès.');
    }

    /**
     * Supprime une compétence spécifique de la base de données.
     */
    public function destroy(Competence $competence): RedirectResponse
    {
        $competence->delete();

        return redirect()->route('competence.index')
            ->with('message', 'Compétence supprimée avec succès.');
    }
}
