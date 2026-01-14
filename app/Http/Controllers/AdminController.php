<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 1. Liste des administrateurs
    public function index()
    {
        // On ne récupère QUE les admins
        $admins = User::where('role', 'admin')->get();
        return view('admins.index', compact('admins'));
    }

    // 2. Formulaire de création
    public function create()
    {
        return view('admins.create');
    }

    // 3. Enregistrer un nouvel Admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // C'est ici que la magie opère : on force le rôle Admin
        ]);

        return redirect()->route('admins.index')->with('success', 'Nouvel administrateur créé !');
    }

    // 4. Supprimer un admin
    public function destroy($id)
    {
        // Sécurité : Empêcher de supprimer son propre compte
        if (Auth::id() == $id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Administrateur supprimé.');
    }
}
