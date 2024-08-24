<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $experiences = Experience::where('user_id', auth()->id())->get();

        return view('experience.index', compact('experiences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request): RedirectResponse
    {
        $request->user()->experiences()->create($request->validated());

        return to_route('experience.index')->with('message', 'Experience a été crée avec succès');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('experience.add', [
            'experience' => new Experience,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience): View
    {
        return view('experience.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience): View
    {
        return view('experience.edit', compact('experience'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return back()->with('message', 'Experience supprimer avec succès');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());

        return to_route('experience.index')->with('message', 'Experience a été modifié avec succès');
    }
}
