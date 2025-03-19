<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    // Afficher toutes les entrées dans paiements
    public function index()
    {
        $paiements = Paiement::all(); // Récupère toutes les entrées dans la table paiements
        return view('paiements.index', compact('paiements'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $commandes = Commande::all(); // Récupère toutes les commandes pour lier un paiement à une commande
        return view('paiements.create', compact('commandes'));
    }

    // Enregistrer une nouvelle entrée dans paiements
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'commande_id' => 'required|exists:commandes,id', // Vérifier si la commande existe
            'montant' => 'required|numeric|min:0', // Le montant doit être un nombre
            'date_paiement' => 'required|date', // La date de paiement doit être une date valide
        ]);

        // Créer l'entrée dans paiements
        Paiement::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('paiements.index')->with('success', 'Paiement ajouté avec succès.');
    }

    // Afficher une entrée spécifique de paiements
    public function show(Paiement $paiement)
    {
        return view('paiements.show', compact('paiement'));
    }

    // Afficher le formulaire de modification
    public function edit(Paiement $paiement)
    {
        $commandes = Commande::all(); // Récupère toutes les commandes pour lier un paiement à une commande
        return view('paiements.edit', compact('paiement', 'commandes'));
    }

    // Mettre à jour une entrée dans paiements
    public function update(Request $request, Paiement $paiement)
    {
        // Validation des données
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        // Mettre à jour l'entrée dans paiements
        $paiement->update($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    // Supprimer une entrée dans paiements
    public function destroy(Paiement $paiement)
    {
        // Supprimer l'entrée
        $paiement->delete();

        // Rediriger avec un message de succès
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
