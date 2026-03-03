<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Stocker un nouvel utilisateur
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        // ✅ Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        // ✅ Création user avec Fillable
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // hash password
        ]);

        // ✅ Assigner role
        $user->assignRole($validated['role']);

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur créé avec succès !');
    }

    // Afficher le formulaire d’édition
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Mettre à jour l’utilisateur
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        // ✅ Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // optionnel
            'role' => 'required|string|exists:roles,name',
        ]);

        // ✅ Update user
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        // ✅ Sync roles
        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // Supprimer l’utilisateur
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur supprimé avec succès !');
    }
}