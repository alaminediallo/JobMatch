<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormationRequest;
use App\Models\Formation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $formations = Formation::where('user_id', auth()->id())->get();

        return view('formation.index', compact('formations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation): View
    {
        return view('formation.show', compact('formation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation): View
    {
        return view('formation.edit', compact('formation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation): RedirectResponse
    {
        if ($formation->diplome) {
            Storage::disk('public')->delete($formation->diplome);
        }
        $formation->delete();

        return back()->with('message', 'Formation supprimer avec succès');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormationRequest $request, Formation $formation): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('diplome')) {
            // Supprimer l'ancien fichier si un nouveau est téléchargé
            if ($formation->diplome) {
                Storage::disk('public')->delete($formation->diplome);
            }

            // Générer un nom de fichier unique
            $fileName = $this->generatePdfFileName($data);

            // Stocker le fichier avec le nom personnalisé
            $data['diplome'] = $request->file('diplome')->storeAs('diplomes', $fileName, 'public');
        }

        // Mettre à jour la formation avec les données
        $formation->update($data);

        return to_route('formation.index')->with('message', 'Formation a été modifié avec succès');
    }

    /**
     * Générer un nom unique pour le fichier PDF.
     */
    protected function generatePdfFileName(array $data): string
    {
        $timestamp = now()->timestamp;
        $userId = auth()->id();
        $extension = $data['diplome']->getClientOriginalExtension();
        $formationName = Str::slug($data['name']);
        $institutionName = Str::slug($data['institution']);

        return "{$formationName}_{$institutionName}_{$userId}_{$timestamp}.{$extension}";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('diplome')) {
            // Générer un nom de fichier unique
            $fileName = $this->generatePdfFileName($data);

            // Stocker le fichier avec le nom personnalisé
            $data['diplome'] = $request->file('diplome')->storeAs('diplomes', $fileName, 'public');
        }

        // Créer la formation avec le chemin du diplôme si nécessaire
        $request->user()->formations()->create($data);

        return to_route('formation.index')->with('message', 'Formation a été crée avec succès');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formation.add', [
            'formation' => new Formation,
        ]);
    }
}
