<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Notifications\CommandePrêteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\FactureMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Burger;



class CommandeController extends Controller
{
    // Afficher toutes les commandes
    public function index()
    {
        $commandes = Commande::all(); 
        return view('commandegestion', compact('commandes'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('commandes.create');
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validation que l'user existe dans la table users
            'statut' => 'required|in:En attente,En préparation,Prête,Payée', // Validation sur le statut
            'total' => 'required|numeric',
        ]);

        // Créer la commande
        Commande::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('commandegestion')->with('success', 'Commande créée avec succès.');
    }

    // Afficher une commande spécifique
    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    // Afficher le formulaire de modification
    public function edit(Commande $commande)
    {
        return view('commandes.edit', compact('commande'));
    }

    // Mettre à jour une commande
    public function update(Request $request, Commande $commande)
    {
        // Validation des données
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validation que l'user existe dans la table users
            'statut' => 'required|in:En attente,En préparation,Prête,Payée', // Validation sur le statut
            'total' => 'required|numeric',
        ]);

        // Mettre à jour la commande
        $commande->update($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('commandegestion')->with('success', 'Commande mise à jour avec succès.');
    }

    // Supprimer une commande
    public function destroy(Commande $commande)
    {
        // Supprimer la commande
        $commande->delete();

        // Rediriger avec un message de succès
        return redirect()->route('commandegestion')->with('success', 'Commande supprimée avec succès.');
    }

    // Marquer une commande comme prête et envoyer une notification
    public function marquerCommePrête($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);

        // Marquer la commande comme prête
        $commande->statut = 'Prête';
        $commande->save();

        // Envoyer la notification à l'utilisateur
        $commande->user->notify(new CommandePrêteNotification($commande));

        // Retourner une réponse redirigeant vers la page des commandes avec un message de succès
        return redirect()->route('commandegestion')->with('success', 'La commande a été marquée comme prête et l\'utilisateur a été notifié.');
    }


    public function commandedetailgest($id)
{
    // Récupérer la commande par ID
    $commande = Commande::findOrFail($id);

    // Passer la commande à la vue
    return view('commandedetailgest', compact('commande'));
}


public function modifiercommande($id)
{
    // Récupérer la commande par ID
    $commande = Commande::findOrFail($id);

    // Passer la commande à la vue
    return view('modifiercommande', compact('commande'));
}



public function modif(Request $request, $id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = $request->input('statut');
    $commande->save();

    // Si la commande est prête, générer la facture en PDF et l'envoyer par e-mail
    if ($commande->statut == 'Prête') {
        $pdf = Pdf::loadView('facture', compact('commande'));

        // Enregistrement du PDF dans le stockage local
        $pdfPath = storage_path('app/public/factures/facture_'.$commande->id.'.pdf');
        $pdf->save($pdfPath);

        // Envoi du PDF par e-mail
        Mail::to($commande->email)->send(new FactureMail($commande, $pdfPath));
    }

    return redirect()->route('commandegestion')->with('success', 'Commande mise à jour avec succès');
}



// 📅 1️⃣ Récupérer les commandes en cours de la journée
public function commandesEnCours()
{
    $commandesEnCours = Commande::whereDate('created_at', Carbon::today())  // Filtre sur la date du jour
        ->where('statut', 'En attente') // Commandes en attente
        ->count();

    return response()->json(['en_cours' => $commandesEnCours]);
}

// ✅ 2️⃣ Récupérer les commandes validées de la journée
public function commandesValidees()
{
    $commandesValidees = Commande::whereDate('created_at', Carbon::today())  // Filtre sur la date du jour
        ->where('statut', 'Payée') // Commandes validées (payées)
        ->count();

    return response()->json(['validees' => $commandesValidees]);
}



// 📊 3️⃣ Nombre de commandes par mois (Chart JS)
public function commandesParMois()
{
    $commandes = Commande::select(
            DB::raw('MONTH(created_at) as mois'), 
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

    // Convertir les mois en noms en français
    $commandes = $commandes->map(function ($item) {
        $mois = Carbon::createFromFormat('m', $item->mois)->locale('fr');  // Création de la date en français
        $item->mois = $mois->monthName;  
        return $item;
    });

    return response()->json($commandes);
}

// 📦 4️⃣ Nombre de produits par mois (Chart JS)
public function burgersParMois()
{
    $burgers = Burger::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('mois')  // Regrouper par mois uniquement
        ->orderBy('mois')  // Trier par mois
        ->get();

    // Ajouter une étape de débogage pour inspecter la structure des données
    return response()->json($burgers);
}


    
}
