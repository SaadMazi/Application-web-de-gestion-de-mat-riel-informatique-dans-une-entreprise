<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Très important pour le mot de passe

class EmployeeController extends Controller
{
    // 1. Liste des employés
    public function index()
    {
        // On ne veut voir que les employés, pas les admins
        $employees = User::where('role', 'employee')->get();
        return view('employees.index', compact('employees'));
    }

    // 2. Formulaire de création
    public function create()
    {
        return view('employees.create');
    }

    // 3. Enregistrer un nouvel employé
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
            'password' => Hash::make($request->password), // On crypte le mot de passe
            'role' => 'employee', // On force le rôle "employee"
        ]);

        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès !');
    }

    // 4. Supprimer un employé
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Empêcher de supprimer un admin par erreur
        if($user->role === 'admin') {
            return back()->with('error', 'Impossible de supprimer un administrateur ici.');
        }

        $user->delete();
        return back()->with('success', 'Employé supprimé.');
    }
}
