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
        $users = User::paginate(10); // ou User::all()
        return view('users.index', compact('users'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Stocker un nouvel utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        $createdUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $createdUser->assignRole($validated['role']);

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur créé avec succès !');
    }

    // Afficher le formulaire d’édition
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Mettre à jour l’utilisateur
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // Supprimer l’utilisateur
    public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
}
}
