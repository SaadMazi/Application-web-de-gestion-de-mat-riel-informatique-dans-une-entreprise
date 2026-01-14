<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category; // N'oublie pas d'importer Category
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // 1. Afficher la liste du matériel
    public function index()
    {
        $materials = Material::with('category')->get();
        return view('materials.index', compact('materials'));
    }

    // 2. Afficher le formulaire de création
    public function create()
    {
        $categories = Category::all();
        return view('materials.create', compact('categories'));
    }

    // 3. Enregistrer un nouveau matériel
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'serial_number' => 'required|unique:materials',
            'category_id' => 'required|exists:categories,id',
        ]);

        Material::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'category_id' => $request->category_id,
            'status' => 'available' // Par défaut
        ]);

        return redirect()->route('materials.index')->with('success', 'Matériel ajouté !');
    }

    // Tu peux ajouter destroy (supprimer) plus tard
    public function destroy(Material $material)
    {
        $material->delete();
        return back()->with('success', 'Matériel supprimé');
    }
}
