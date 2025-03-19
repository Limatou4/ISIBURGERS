<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger;

class MenuController extends Controller
{
    public function showMenu(Request $request)
{
    // Récupérer la catégorie depuis la requête (par exemple, 'classiques', 'veggie', etc.)
    $categorie = $request->input('categorie');
    
    // Si aucune catégorie n'est sélectionnée, afficher tous les burgers
    if ($categorie) {
        // Filtrer les burgers selon la catégorie
        $burgers = Burger::where('categorie', $categorie)->get();
    } else {
        // Afficher tous les burgers si aucun filtre n'est appliqué
        $burgers = Burger::all();
    }

    // Passer les burgers à la vue
    return view('menu', ['burgers' => $burgers]);
}
}