<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\TypeEntreprise;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

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
        $this->authorize('create', User::class);

        $user = User::create($request->validated());

        return to_route('user.index')
            ->with('message', "L'utilisateur {$user->name} a été créé avec succès");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', User::class);

        return view('user.add', [
            'user' => new User,
            'roles' => Role::all(),
            'typesEntreprise' => TypeEntreprise::all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View|RedirectResponse
    {
        $this->authorize('view', User::class);

        if ($user->id === auth()->id()) {
            return to_route('profile.edit', $user);
        }

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View|RedirectResponse
    {
        $this->authorize('update', User::class);

        if ($user->id === auth()->id()) {
            return to_route('profile.edit', $user);
        }

        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'typesEntreprise' => TypeEntreprise::all(),
        ]);
    }

    /**
     * Activer un utilisateur.
     */
    public function activate(User $user): RedirectResponse
    {
        $this->authorize('update', User::class);

        $user->update(['etat' => true]);

        return to_route('user.index')->with('message', "L'utilisateur a été activé avec succès.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', User::class);

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
     * Bloquer un utilisateur.
     */
    public function deactivate(User $user): RedirectResponse
    {
        $this->authorize('update', User::class);

        $user->update(['etat' => false]);

        return to_route('user.index')->with('message', "L'utilisateur a été désactivé avec succès.");
    }
}
