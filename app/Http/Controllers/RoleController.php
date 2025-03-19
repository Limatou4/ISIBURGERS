<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Afficher toutes les entrées dans roles
    public function index()
    {
        $roles = Role::all();  // Récupérer toutes les entrées dans la table 'roles'
        return view('roles.index', compact('roles'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('roles.create');
    }

    // Enregistrer une nouvelle entrée dans roles
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',  // Le nom du rôle est requis et doit être une chaîne de caractères
        ]);

        // Créer une nouvelle entrée dans roles
        Role::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('roles.index')->with('success', 'Rôle ajouté avec succès.');
    }

    // Afficher une entrée spécifique de roles
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    // Afficher le formulaire de modification
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Mettre à jour une entrée dans roles
    public function update(Request $request, Role $role)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',  // Le nom du rôle est requis et doit être une chaîne de caractères
        ]);

        // Mettre à jour l'entrée dans roles
        $role->update($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('roles.index')->with('success', 'Rôle mis à jour avec succès.');
    }

    // Supprimer une entrée dans roles
    public function destroy(Role $role)
    {
        // Supprimer l'entrée
        $role->delete();

        // Rediriger avec un message de succès
        return redirect()->route('roles.index')->with('success', 'Rôle supprimé avec succès.');
    }
}
