<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Afficher la page de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Traiter la connexion
    public function login(Request $request)
    {
        // Validation des champs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Essayer de connecter l'utilisateur
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirection vers le Dashboard après succès
            return redirect()->route('dashboard')->with('success', 'Vous êtes connecté !');
        }

        // Si échec
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    // 3. Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}
