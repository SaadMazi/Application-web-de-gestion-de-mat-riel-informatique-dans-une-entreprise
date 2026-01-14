<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['user', 'material'])
                        ->whereNull('end_date')
                        ->get();

        return view('assignments.index', compact('assignments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'material_id' => 'required|exists:materials,id',
        ]);

        $material = Material::find($request->material_id);

        if ($material->status !== 'available') {
            return back()->withErrors(['msg' => 'Material is not available!']);
        }

        DB::transaction(function () use ($request, $material) {

            Assignment::create([
                'user_id' => $request->user_id,
                'material_id' => $request->material_id,
                'start_date' => now(),
            ]);

            $material->update(['status' => 'assigned']);
        });

        return redirect()->back()->with('success', 'Material assigned successfully');
    }

    public function returnMaterial($assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        DB::transaction(function () use ($assignment) {

            $assignment->update(['end_date' => now()]);
            $assignment->material->update(['status' => 'available']);
        });

        return back()->with('success', 'Material returned');
    }
    public function create()
    {
        $users = User::all();

        $materials = Material::where('status', 'available')->get();

        return view('assignments.create', compact('users', 'materials'));
    }
}
