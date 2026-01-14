<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;
use App\Models\Maintenance;
use App\Models\Assignment;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistiques générales
        $totalMateriel = Material::count();
        $totalEmployes = User::where('role', 'employee')->count();

        // 2. État du stock
        $dispo = Material::where('status', 'available')->count();
        $affecte = Material::where('status', 'assigned')->count();
        $panne = Material::where('status', 'broken')->count();

        // 3. Dernières actions (pour afficher un petit historique récent)
        $recentAssignments = Assignment::with(['user', 'material'])
                                ->orderBy('created_at', 'desc')
                                ->take(5) // Les 5 dernières
                                ->get();

        return view('dashboard', compact(
            'totalMateriel',
            'totalEmployes',
            'dispo',
            'affecte',
            'panne',
            'recentAssignments'
        ));
    }
}
