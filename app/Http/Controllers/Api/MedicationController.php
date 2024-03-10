<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medication; 
class MedicationController extends Controller
{

    public function index()
    {
        $medications = Medication::all();

        $data = [
            'status' => 200,
            'medications' => $medications
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "quantity" => "required"
        ]);

        // Create a new medication instance
        $medication = Medication::create([
            "name" => $request->name,
            "description" => $request->description,
            "quantity" => $request->quantity
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "New medication added successfully",
            "medication" => $medication 
        ]);
    }

    public function show($id)
    {
        $medication = Medication::find($id);

        if (!$medication) {
            return response()->json([
                "status" => false,
                "message" => "Medication not found"
            ], 404);
        }

        return response()->json([
            "status" => true,
            "medication" => $medication
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $medication = Medication::find($id);

        if (!$medication) {
            return response()->json([
                "status" => false,
                "message" => "Medication not found"
            ], 404);
        }

        $medication->update($request->all());

        return response()->json([
            "status" => true,
            "message" => "Medication updated successfully",
            "medication" => $medication
        ], 200);
    }

    public function destroy($id ,Request $request, Medication $medication)
    {
        $medication = Medication::withTrashed()->findOrFail($id);

        if ($request->user()->user_role !== 'owner') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $medication->delete();

        return response()->json(['message' => 'Medication deleted successfully'], 200);
    }
}
