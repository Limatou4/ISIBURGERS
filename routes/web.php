<?php

use App\Http\Controllers\BurgerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeBurgerController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;


Route::get('/burgers/filter', [BurgerController::class, 'filterBurgers'])->name('filtrer.burgers');
Route::get('/notification-home', [NotificationController::class, 'show'])->name('notification.home');

Route::get('/stats/commandes-en-cours', [CommandeController::class, 'commandesEnCours']);
Route::get('/stats/commandes-validees', [CommandeController::class, 'commandesValidees']);
Route::get('/stats/commandes-par-mois', [CommandeController::class, 'commandesParMois']);
Route::get('/stats/produits-par-categorie', [CommandeController::class, 'produitsParCategorieParMois']);


Route::put('/commande/{id}/modif', [CommandeController::class, 'modif'])->name('commande.modif');

Route::get('/commandedetailgest/{id}', [CommandeController::class, 'commandedetailgest'])->name('commandedetailgest');
Route::get('/modifiercommande/{id}', [CommandeController::class, 'modifiercommande'])->name('modifiercommande');

Route::get('/commandegestion', [GestionnaireController::class, 'commandegestion'])->name('commandegestion');
Route::post('/commande/valider', [ClientController::class, 'valider'])->name('payer.commande');

Route::get('/commande', [ClientController::class, 'validerPanier'])->name('commande.home');
Route::middleware('auth')->get('/Listecommande', [ClientController::class, 'Listecommande'])->name('Listecommande');

Route::post('/ajouter-au-panier', [ClientController::class, 'ajouterAuPanier'])->name('ajouter-au-panier');
Route::get('/panier', [ClientController::class, 'panier'])->name('panier');
Route::get('/favoris', [ClientController::class, 'favoris'])->name('favoris');
Route::delete('/burgers/{id}', [BurgerController::class, 'supprimer'])->name('burgers.supprimer');
Route::put('/burgers/{id}/archiver', [BurgerController::class, 'archiver'])->name('burgers.archiver');
Route::get('/modifier-burger/{id}', [BurgerController::class, 'modifierBurger'])->name('modifierBurger');
Route::put('burgers/{id}', [BurgerController::class, 'update'])->name('burgers.update');


// Route pour afficher la page d'inscription
Route::get('/', function () {
    return view('inscription');
});

// Page d'inscription
Route::get('/inscription', [UserController::class, 'showRegistrationForm'])->name('inscription');
Route::post('/inscription', [UserController::class, 'store'])->name('register.store');

// Page de connexion
Route::get('/connexion', function () {
    return view('connexion');  
})->name('connexion');
Route::post('/connexion', [LoginController::class, 'login'])->name('login.store');

// Déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/connexion');
})->name('logout');

// Routes de gestion des burgers
Route::get('/Ajouterburgers-home', function () {
    return view('AjouterburgersHome');
})->name('Ajouterburgers.home');

Route::get('/AfficherBurgers-home', [BurgerController::class, 'index'])->name('AfficherBurgers.home');

// Route pour afficher la page des burgers
Route::get('/burgers-home', function () {
    return view('burgersHome');
})->name('burgers.home');


Route::get('/paiement-home', function () {
    return view('paiementHome');
})->name('paiement.home');

Route::get('/statistique-home', function () {
    return view('statiqueHome');
})->name('statistique.home');



Route::get('/profil-home', function () {
    return view('profilHome');
})->name('profil.home');

// Page d'accueil du gestionnaire
Route::get('/gestionnaire/home', [GestionnaireController::class, 'home'])->name('gestionnaire.home');

// Page d'accueil du client
Route::get('/client/home', [ClientController::class, 'home'])->name('client.home');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Routes liées au profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Définir les ressources pour chaque modèle
    Route::resource('burgers', BurgerController::class);
    Route::resource('commandes_burgers', CommandeBurgerController::class);
    Route::post('/commandes/{commandeId}/marquer-comme-prete', [CommandeController::class, 'marquerCommePrête'])->name('commandes.marquerCommePrete');
    Route::resource('paiements', PaiementController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
