<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //on récupère les différents users dans notre model role
        //en préchargent les permissions pour éviter le "eager loading" (N + 1).
        $roles = Role::with(['permissions', 'users'])->get();

        return view('role.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        // Créer le rôle
        $role = Role::create([
            'name' => $request->validated('name'),
        ]);

        // Synchroniser les permissions
        $role->permissions()->sync($request->validated('permissions'));

        // Synchroniser les utilisateurs si des IDs sont fournis
        if (! empty($request->validated('user_ids'))) {
            $role->users()->sync($request->validated('user_ids'));
        }

        // Rediriger avec un message de succès
        return to_route('role.index')->with('message', "Le rôle $role->name a été créé avec succès");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions = Permission::all(['id', 'name'])->sortBy('id');
        $users = User::where('id', '!=', auth()->id())->get();
        $role = new Role;

        return view('role.add', compact('role', 'permissions', 'users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View
    {
        //on précharge les permissions pour éviter le "eager loading" (N + 1)
        //        $role->load('permissions');
        $permissions = Permission::all(['id', 'name'])->sortBy('id');

        return view('role.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all(['id', 'name'])->sortBy('id');
        $users = User::where('id', '!=', auth()->id())->get();

        return view('role.edit', compact('role', 'permissions', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        if (! $role->deletable) {
            return back()
                ->with('error', 'Ce rôle ne peut pas être supprimé.');
        }

        if ($role->isAssignedToUsers()) {
            return back()
                ->with('error', 'Impossible de supprimer le rôle car il est attribué à un ou plusieurs utilisateurs.');
        }
        $role->delete();

        return back()->with('message', 'Rôle supprimer avec succès');
    }

    public function activer(Role $role): RedirectResponse
    {
        if ($role->etat && $role->isAssignedToUsers()) {
            return back()
                ->with('error', 'Impossible de désactiver le rôle, car il est attribué à un ou plusieurs utilisateurs.');
        }

        $isModelActive = $role->etat;
        $message = $isModelActive ? "Rôle $role->name désactivé" : "Rôle $role->name activé";

        $role->update([
            'etat' => ! $isModelActive,
        ]);

        return back()->with('message', $message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        // Mettre à jour le rôle
        $role->update([
            'name' => $request->validated('name'),
        ]);

        // Synchroniser les permissions
        $role->permissions()->sync($request->validated('permissions'));

        // Récupérer les utilisateurs à synchroniser depuis la requête
        $userIds = $request->validated('user_ids', []);

        // Ajouter l'utilisateur connecté s'il a ce rôle
        if (auth()->user()->roles->contains($role)) {
            $userIds[] = auth()->id();
        }

        // Synchroniser les utilisateurs
        $role->users()->sync($userIds);

        // Rediriger avec un message de succès
        return to_route('role.index')->with('message', "Le rôle {$role->name} a été modifié avec succès");
    }
}
