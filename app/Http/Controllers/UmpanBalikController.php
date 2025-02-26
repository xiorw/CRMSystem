<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmpanBalik;

class UmpanBalikController extends Controller
{
    public function index()
    {
        $umpan_baliks = UmpanBalik::all();
        return response()->json(['status' => 200, 'message' => 'Umpan Baliks retrieved successfully.', 'data' => $umpan_baliks], 200);
    }

    public function show($id)
    {
        $umpan_balik = UmpanBalik::find($id);

        if (!$umpan_balik) {
            return response()->json(['status' => 404, 'message' => 'Umpan Balik not found.'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Umpan Balik retrieved successfully.', 'data' => $umpan_balik], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'rating' => 'required|integer|min:1|max:5',
            'date' => 'required|date',
        ]);

        $umpan_balik = UmpanBalik::create($request->all());

        return response()->json(['status' => 201, 'message' => 'Umpan Balik created successfully.', 'data' => $umpan_balik], 201);
    }

    public function update(Request $request, $id)
    {
        $umpan_balik = UmpanBalik::find($id);

        if (!$umpan_balik) {
            return response()->json(['status' => 404, 'message' => 'Umpan Balik not found.'], 404);
        }

        $request->validate([
            'customer_id' => 'exists:customers,id',
            'rating' => 'integer|min:1|max:5',
            'date' => 'date',
        ]);

        $umpan_balik->update($request->all());

        return response()->json(['status' => 200, 'message' => 'Umpan Balik updated successfully.', 'data' => $umpan_balik], 200);
    }

    public function destroy($id)
    {
        $umpan_balik = UmpanBalik::find($id);

        if (!$umpan_balik) {
            return response()->json(['status' => 404, 'message' => 'Umpan Balik not found.'], 404);
        }

        $umpan_balik->delete();

        return response()->json(['status' => 200, 'message' => 'Umpan Balik deleted successfully.'], 200);
    }
}
