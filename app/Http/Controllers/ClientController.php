<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger;
use Illuminate\Support\Facades\Auth;
use App\Models\Panier; 
use App\Models\Commande; 
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;
class ClientController extends Controller
{
    /**
     * Afficher la page d'accueil du client avec les burgers disponibles.
     */
    public function home()
    {
        $burgers = Burger::where('archived', 0)->get(); // Récupère les burgers non archivés
        return view('clientHome', compact('burgers')); 
    }



    public function ajouterAuPanier(Request $request)
{
    // Validation de l'existence du burger
    $request->validate([
        'burger_id' => 'required|exists:burgers,id',
    ]);

    // Vérifier si l'utilisateur est connecté
    if (Auth::check()) {
        $burgerId = $request->burger_id;
        $burger = Burger::find($burgerId);

        if ($burger) {
            $user = Auth::user();

            // Vérifier si l'utilisateur a un panier existant
            $panier = $user->panier()->where('burger_id', $burger->id)->first();

            if ($panier) {
                // Si le burger est déjà dans le panier, on incrémente la quantité
                $panier->quantite += 1;
                $panier->prix_total = $panier->quantite * $burger->prix;  // Mettre à jour le prix total
                $panier->save();
            } else {
                // Sinon, créer un nouvel enregistrement dans le panier
                $user->panier()->create([
                    'burger_id' => $burger->id,
                    'quantite' => 1,
                    'prix_total' => $burger->prix
                ]);
            }

            return redirect()->route('panier')->with('success', 'Burger ajouté au panier');
        }
    }

    return redirect()->route('panier')->with('error', 'Erreur lors de l\'ajout au panier');
}



public function panier()
{
    // Récupérer les produits dans le panier pour l'utilisateur connecté
    $panierItems = Panier::where('user_id', Auth::id())->get();

    // Calculer le total
    $total = $panierItems->sum(function($item) {
        return $item->prix_total;
    });

    // Retourner la vue avec les données du panier
    return view('panier', compact('panierItems', 'total'));
}



public function validerPanier()
{
    // Récupérer les éléments du panier
    $panierItems = Panier::where('user_id', Auth::id())->get();

    // Passer les éléments du panier à la vue 'commandeHome'
    return view('commandeHome')->with('panierItems', $panierItems);
}
public function valider(Request $request)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'adresse' => 'required|string|max:255',
        'telephone' => 'required|string|max:15',
        'commentaires' => 'nullable|string|max:255',
        'methode_paiement' => 'required|in:espece,wave,orange_money',
    ]);

    // Récupérer les éléments du panier
    $panierItems = Panier::where('user_id', Auth::id())->get();

    // Calculer le total du panier
    $total = $panierItems->sum(function($item) {
        return $item->prix_total; // Calcul du total des prix des articles dans le panier
    });

    // Récupérer les noms des burgers dans le panier
    $nomproduits = $panierItems->map(function ($item) {
        return $item->burger->nom; // Récupère le nom du burger lié à chaque article du panier
    })->implode(', '); // Combine les noms des burgers séparés par une virgule

    // Créer une nouvelle commande
    $commande = new Commande();
    $commande->user_id = Auth::id();
    $commande->statut = 'En attente';
    $commande->total = $total; // Utiliser le total calculé
    $commande->methode_paiement = $validatedData['methode_paiement'];
    $commande->adresse = $validatedData['adresse'];
    $commande->telephone = $validatedData['telephone'];
    $commande->commentaires = $validatedData['commentaires'] ?? '';
    $commande->email = Auth::user()->email;
    $commande->nomproduit = $nomproduits; // Ajouter les noms des burgers à la commande
    $commande->save();

    // 📌 Ajouter une notification dans la table `notifications`
    Notification::create([
        'commande_id' => $commande->id,
        'message' => "Nouvelle commande reçue (#{$commande->id}) d'un total de {$commande->total}Fcfa. Email du client : " . Auth::user()->email,
        'lue' => false, // La notification n'est pas encore lue
    ]);

    // 📩 Envoi de l'e-mail au gestionnaire
    Mail::raw("Nouvelle commande reçue.\n\nID: {$commande->id}\nTotal: {$commande->total}Fcfa\nClient: " . Auth::user()->name . "\nEmail: " . Auth::user()->email . "\nAdresse: {$commande->adresse}\nTéléphone: {$commande->telephone}\nProduits: {$commande->nomproduit}", function($message) {
        $message->to('996220.lima@gmail.com')
                ->subject('Nouvelle Commande Reçue');
    });

    // Retirer les produits du panier après la commande
    Panier::where('user_id', Auth::id())->delete();

    // Rediriger vers la confirmation
    return redirect()->route('Listecommande')->with('success', 'Votre commande a été lancée');
}








    public function Listecommande()
    {
        $commandes = Auth::user()->commandes;  
        return view('Listecommande', compact('commandes'));
    }
    

    
}
