<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Burger; 
use Illuminate\Support\Facades\Storage;

class BurgerController extends Controller
{
    




public function modifierBurger($id)
{
    $burger = Burger::findOrFail($id); 
    return view('modifierBurgersHome', compact('burger')); 
}



public function supprimer($id)
{
    // Trouver le burger par son ID
    $burger = Burger::findOrFail($id);

    // Supprimer le burger de la base de données
    $burger->delete();

    // Retourner une réponse après la suppression
    return redirect()->route('burgers.index')->with('success', 'Le burger a été supprimé.');
}




public function archiver($id)
{
    // Trouver le burger par son ID
    $burger = Burger::findOrFail($id);

    // Changer la valeur de 'archived' à 1 (archivé)
    $burger->archived = 1;

    // Sauvegarder les modifications
    $burger->save();

    // Retourner une réponse, rediriger ou répondre selon vos besoins
    return redirect()->route('burgers.index')->with('success', 'Le burger a été archivé.');
}


// Méthode pour mettre à jour le burger
public function update(Request $request, $id)
{
    // Valider les données reçues
    $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        'description' => 'required|string',
        'stock' => 'required|integer',
        'archived' => 'nullable|boolean',
    ]);

    $burger = Burger::findOrFail($id);

    // Mettre à jour les champs du burger
    $burger->nom = $request->input('nom');
    $burger->prix = $request->input('prix');
    $burger->description = $request->input('description');
    $burger->stock = $request->input('stock');
    $burger->archived = $request->has('archived') ? 1 : 0;

    // Si une nouvelle image est téléchargée, la sauvegarder et mettre à jour le champ image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/burgers', 'public');
        $burger->image = $imagePath;
    }

    // Sauvegarder les changements dans la base de données
    $burger->save();

    return redirect()->route('burgers.index')->with('success', 'Burger mis à jour avec succès');
}



public function index()
{    
    $burgers = Burger::where('archived', 0)->get();

    return view('AfficherBurgersHome', compact('burgers'));
}









    public function store(Request $request)
    {
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'archived' => 'nullable|boolean',
        ]);

        // Traitement de l'image
        $imagePath = $request->file('image')->store('burgers', 'public');

        // Enregistrement des données dans la base de données
        $burger = new Burger();
        $burger->nom = $request->input('nom');
        $burger->prix = $request->input('prix');
        $burger->image = $imagePath;
        $burger->description = $request->input('description');
        $burger->stock = $request->input('stock');
        $burger->archived = $request->has('archived') ? 1 : 0;
        $burger->created_at = now();
        $burger->updated_at = now();
        $burger->save();

        // Redirection ou retour avec un message de succès
        return redirect()->back()->with('success', 'Burger ajouté avec succès!');
    }





    public function filterBurgers(Request $request)
{
    // Récupérer les filtres
    $libelle = $request->input('libelle');
    $prix_min = $request->input('prix_min');
    $prix_max = $request->input('prix_max');

    // Construire la requête pour filtrer les burgers
    $query = Burger::query();

    if ($libelle) {
        $query->where('nom', 'like', '%' . $libelle . '%');
    }

    if ($prix_min) {
        $query->where('prix', '>=', $prix_min);
    }

    if ($prix_max) {
        $query->where('prix', '<=', $prix_max);
    }

    // Récupérer les burgers filtrés
    $burgers = $query->get();

    // Retourner la vue avec les burgers filtrés
    return view('menu', compact('burgers'));
}
}
