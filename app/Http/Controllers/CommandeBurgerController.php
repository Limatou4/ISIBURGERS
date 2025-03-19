<?php

namespace App\Http\Controllers;

use App\Models\CommandeBurger;
use Illuminate\Http\Request;

class CommandeBurgerController extends Controller
{
    // Afficher toutes les entrées dans commandes_burgers
    public function index()
    {
        $commandesBurgers = CommandeBurger::all(); // Récupère toutes les entrées dans la table commandes_burgers
        return view('commandes_burgers.index', compact('commandesBurgers'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('commandes_burgers.create');
    }

    // Enregistrer une nouvelle entrée dans commandes_burgers
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'commande_id' => 'required|exists:commandes,id', // Vérifier si la commande existe
            'burger_id' => 'required|exists:burgers,id', // Vérifier si le burger existe
            'quantite' => 'required|integer|min:1', // La quantité doit être un entier positif
        ]);

        // Créer l'entrée dans commandes_burgers
        CommandeBurger::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('commandes_burgers.index')->with('success', 'Burger ajouté à la commande avec succès.');
    }

    // Afficher une entrée spécifique de commandes_burgers
    public function show(CommandeBurger $commandeBurger)
    {
        return view('commandes_burgers.show', compact('commandeBurger'));
    }

    // Afficher le formulaire de modification
    public function edit(CommandeBurger $commandeBurger)
    {
        return view('commandes_burgers.edit', compact('commandeBurger'));
    }

    // Mettre à jour une entrée dans commandes_burgers
    public function update(Request $request, CommandeBurger $commandeBurger)
    {
        // Validation des données
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'burger_id' => 'required|exists:burgers,id',
            'quantite' => 'required|integer|min:1',
        ]);

        // Mettre à jour l'entrée dans commandes_burgers
        $commandeBurger->update($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('commandes_burgers.index')->with('success', 'Entrée mise à jour avec succès.');
    }

    // Supprimer une entrée dans commandes_burgers
    public function destroy(CommandeBurger $commandeBurger)
    {
        // Supprimer l'entrée
        $commandeBurger->delete();

        // Rediriger avec un message de succès
        return redirect()->route('commandes_burgers.index')->with('success', 'Entrée supprimée avec succès.');
    }
}
