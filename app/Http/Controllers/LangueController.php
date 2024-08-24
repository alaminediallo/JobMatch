<?php

namespace App\Http\Controllers;

use App\Enums\Niveau;
use App\Http\Requests\LangueRequest;
use App\Models\Langue;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LangueController extends Controller
{
    /**
     * Affiche la liste des langues.
     */
    public function index(): View
    {
        // Récupère les langues associées à l'utilisateur connecté
        $langues = Langue::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->with([
            'users' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ])->get();

        return view('langue.index', [
            'langues' => $langues,
        ]);
    }

    /**
     * Enregistre une nouvelle langue dans la base de données.
     */
    public function store(LangueRequest $request): RedirectResponse
    {
        // Création de la langue
        $langue = Langue::create($request->validated());

        $request->user()->langues()->attach($langue->id, ['niveau' => $request->validated('niveau')]);

        return redirect()->route('langue.index')
            ->with('message', 'Langue créée avec succès.');
    }

    /**
     * Affiche le formulaire pour créer une nouvelle langue.
     */
    public function create(): View
    {
        return view('langue.add', [
            'langue' => new Langue,
            'niveaux' => Niveau::getLabels(), // On peut précharger les niveaux pour les afficher
            'niveau' => '',
        ]);
    }

    /**
     * Affiche les détails d'une langue spécifique.
     */
    public function show(Langue $langue): View
    {
        return view('langue.show', compact('langue'));
    }

    /**
     * Affiche le formulaire d'édition pour une langue spécifique.
     */
    public function edit(Langue $langue): View
    {
        $user = auth()->user();
        $niveau = $user->langues()->where('langue_id', $langue->id)->first()->pivot->niveau ?? null;

        return view('langue.edit', [
            'langue' => $langue,
            'niveaux' => Niveau::getLabels(), // On peut précharger les niveaux pour les afficher
            'niveau' => $niveau,
        ]);
    }

    /**
     * Met à jour une langue spécifique dans la base de données.
     */
    public function update(LangueRequest $request, Langue $langue): RedirectResponse
    {
        // Mise à jour de la langue
        $langue->update($request->validated());

        // Mise à jour dans la table pivot avec un utilisateur spécifique
        $request->user()->langues()->updateExistingPivot($langue->id, ['niveau' => $request->validated('niveau')]);

        return redirect()->route('langue.index')
            ->with('message', 'Langue mise à jour avec succès.');
    }

    /**
     * Supprime une langue spécifique de la base de données.
     */
    public function destroy(Langue $langue): RedirectResponse
    {
        $langue->delete();

        return redirect()->route('langue.index')
            ->with('message', 'Langue supprimée avec succès.');
    }
}
