<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('inscription');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed', // L'absence de hachage ici
            'image' => 'required|image|max:2048',
        ]);

        // Enregistrement de l'utilisateur sans hachage du mot de passe
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password']; // Mot de passe en texte clair

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        // Connexion automatique après l'inscription
        Auth::login($user);

        // 🚀 **Redirection vers gestionnaireHome après inscription**
        return redirect()->route('client.home', ['id' => $user->id]);
    }
}
