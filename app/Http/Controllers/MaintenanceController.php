<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function index()
    {
        // CORRECTION ICI : 'statut' au lieu de 'status'
        $maintenances = Maintenance::with('material')
                        ->where('statut', 'open')
                        ->get();

        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $materials = Material::where('status', '!=', 'broken')->get();
        return view('maintenances.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'description' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            Maintenance::create([
                'material_id' => $request->material_id,
                // CORRECTION ICI : Vérifie si ta colonne est 'description' ou 'description_probleme'
                'description_probleme' => $request->description,
                'statut' => 'open', // CORRECTION ICI
            ]);

            Material::where('id', $request->material_id)->update(['status' => 'broken']);
        });

        return redirect()->route('maintenances.index')->with('success', 'Panne signalée');
    }

    public function close($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        DB::transaction(function () use ($maintenance) {
            // CORRECTION ICI
            $maintenance->update(['statut' => 'resolved']);

            $maintenance->material->update(['status' => 'available']);
        });

        return back()->with('success', 'Matériel réparé !');
    }
}
