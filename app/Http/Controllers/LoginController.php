<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('connexion');  // Assurez-vous que la vue connexion.blade.php existe
    }

    /**
     * Authentifie un utilisateur.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validation des champs du formulaire de connexion
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Tentative de connexion sans hachage
        $user = User::where('email', $request->email)->first();

        // Si un utilisateur existe et que les mots de passe correspondent
        if ($user && $user->password === $request->password) {
            // Connexion manuelle
            Auth::login($user);

            // Vérifier le rôle de l'utilisateur
            if ($user->role == 'gestionnaire') {
                // Redirection vers la page du gestionnaire si le rôle est 'gestionnaire'
                return redirect()->route('gestionnaire.home');
            } elseif ($user->role == 'client') {
                // Redirection vers la page du client si le rôle est 'client'
                return redirect()->route('client.home');
            }
        }

        // Si les informations de connexion sont incorrectes
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
}
