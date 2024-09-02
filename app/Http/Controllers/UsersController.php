<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\TypeEntreprise;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(User::class, 'user');
    }

    public function index(): View
    {
        $users = User::with('role')
            ->where('id', '!=', auth()->id())
            ->get();

        return view('user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        return to_route('user.index')
            ->with('message', "L'utilisateur {$user->name} a été créé avec succès");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.add', [
            'user' => new User,
            'roles' => Role::all(),
            'typesEntreprise' => TypeEntreprise::all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'typesEntreprise' => TypeEntreprise::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return back()->with('message', "L'utilisateur {$user->name} a été supprimé avec succès");
    }

    /**
     * Activer un utilisateur.
     */
    public function activate(User $user): RedirectResponse
    {
        $user->update(['etat' => true]);

        return redirect()->route('user.index')->with('message', "L'utilisateur a été activé avec succès.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        if ($user->isDirty('role_id')) {
            Cache::forget("user_{$user->id}_is_administrator");
            Cache::forget("user_{$user->id}_is_recruteur");
            Cache::forget("user_{$user->id}_is_candidat");
        }

        return to_route('user.index')
            ->with('message', "L'utilisateur {$user->name} a été modifié avec succès");
    }

    /**
     * Désactiver un utilisateur.
     */
    public function deactivate(User $user): RedirectResponse
    {
        $user->update(['etat' => false]);

        return redirect()->route('user.index')->with('message', "L'utilisateur a été désactivé avec succès.");
    }
}
