<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormationRequest;
use App\Models\Formation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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

        // Gestion du fichier diplôme
        $data['diplome'] = $this->handleUploadedFile($request, 'diplome', 'diplomes', $formation->diplome);

        $formation->update($data);

        return to_route('formation.index')->with('message', 'Formation modifiée avec succès');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FormationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Gestion du fichier diplôme
        $data['diplome'] = $this->handleUploadedFile($request, 'diplome', 'diplomes');

        $request->user()->formations()->create($data);

        return to_route('formation.index')->with('message', 'Formation créée avec succès');
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
