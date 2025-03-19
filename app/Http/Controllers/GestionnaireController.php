<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande; 

class GestionnaireController extends Controller
{
    /**
     * Afficher la page d'accueil du gestionnaire.
     */
    public function home()
    {
        return view('gestionnaireHome'); 
    }

    public function commandegestion()
    {
        // Récupérer toutes les commandes
        $commandes = Commande::all();

        // Retourner la vue avec les commandes
        return view('commandegestion', compact('commandes'));
    }

}
