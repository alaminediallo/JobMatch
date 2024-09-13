<?php

namespace App\Http\Controllers;

use App\Enums\StatutOffre;
use App\Enums\TypeOffre;
use App\Events\OffreCreatedEvent;
use App\Events\OffreEditedEvent;
use App\Events\OffreRejectedEvent;
use App\Events\OffreValidatedEvent;
use App\Http\Requests\OffreRequest;
use App\Models\Category;
use App\Models\Offre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OffreController extends Controller
{
    private bool $isAdmin;

    public function __construct()
    {
        $this->isAdmin = auth()->user()?->isAdmin() ?? false;
    }

    /**
     * Affiche la liste des offres d'emploi.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Offre::class);

        if ($this->isAdmin) {
            return view('offre.index', [
                'offres' => Offre::with('user')->whereStatut(StatutOffre::EN_ATTENTE)->get(),
                'isAdmin' => $this->isAdmin,
            ]);
        }

        $offres = Offre::withCount(['candidatures', 'user'])->where('user_id', auth()->id())->get();

        return view('offre.index', [
            'offres' => $offres,
            'isAdmin' => $this->isAdmin,
        ]);
    }

    /**
     * Enregistre une nouvelle offre d'emploi dans la base de données.
     */
    public function store(OffreRequest $request): RedirectResponse
    {
        $this->authorize('create', Offre::class);

        $offre = $request->user()->offres()->create($request->validated());

        // envoyer un mail à l'admin lors de la création d'une offre
        event(new OffreCreatedEvent($offre));

        return to_route('offre.index')->with('message', 'Offre d\'emploi créée avec succès.');
    }

    /**
     * Affiche le formulaire pour créer une nouvelle offre d'emploi.
     */
    public function create(): View|RedirectResponse
    {
        $this->authorize('create', Offre::class);

        if (is_null(auth()->user()->type_entreprise_id)) {
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
            'isAdmin' => $this->isAdmin,
        ]);
    }

    /**
     * Affiche le formulaire d'édition pour une offre d'emploi spécifique.
     */
    public function edit(Offre $offre): View|RedirectResponse
    {
        $this->authorize('update', $offre);

        if ($offre->candidatures()->exists()) {
            return back()->with('error', 'Cette offre a déjà une candidature.');
        }

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
        $this->authorize('delete', $offre);

        if ($offre->candidatures()->exists()) {
            return back()->with('error', 'Cette offre a déjà une candidature.');
        }

        $offre->delete();

        return to_route('offre.index')->with('message', 'Offre d\'emploi supprimée avec succès.');
    }

    /**
     * Valider une offre d'emploi.
     */
    public function validateOffre(Offre $offre): RedirectResponse
    {
        if (! $this->isAdmin) {
            abort(403, "Vous n'êtes pas autorisé à valider cette offre.");
        }

        // Mettre à jour le champ is_validated
        $offre->update(['statut' => StatutOffre::VALIDER]);

        // envoyer un mail au recruteur lors de la validation d'une offre
        event(new OffreValidatedEvent($offre));

        return to_route('offre.index')->with('message', 'Offre validée avec succès.');
    }

    /**
     * Met à jour une offre d'emploi spécifique dans la base de données.
     */
    public function update(OffreRequest $request, Offre $offre): RedirectResponse
    {
        $this->authorize('update', $offre);

        $offre->update($request->validated() + ['statut' => StatutOffre::EN_ATTENTE]);

        // envoyer un mail à l'admin lors de la modification d'une offre
        event(new OffreEditedEvent($offre));

        return to_route('offre.index')->with('message', 'Offre d\'emploi mise à jour avec succès.');
    }

    /**
     * Rejeter une offre d'emploi.
     */
    public function rejeterOffre(Offre $offre): RedirectResponse
    {
        if (! $this->isAdmin) {
            abort(403, "Vous n'êtes pas autorisé à rejeter cette offre.");
        }

        // Rejeter l'offre
        $offre->update(['statut' => StatutOffre::REJETER]);

        // Dispatcher l'événement pour notifier le recruteur
        event(new OffreRejectedEvent($offre));

        return back()->with('message', 'Offre rejetée avec succès.');
    }
}
