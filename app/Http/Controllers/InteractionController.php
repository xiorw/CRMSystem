<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;

class InteractionController extends Controller
{
    public function index()
    {
        $interactions = Interaction::all();
        return response()->json(['status' => 200, 'message' => 'Interactions retrieved successfully.', 'data' => $interactions], 200);
    }

    public function show($id)
    {
        $interaction = Interaction::find($id);
        
        if (!$interaction) {
            return response()->json(['status' => 404, 'message' => 'Interaction not found.'], 404);
        }
        
        return response()->json(['status' => 200, 'message' => 'Interaction retrieved successfully.', 'data' => $interaction], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|string',
            'date' => 'required|date',
        ]);

        $interaction = Interaction::create($request->all());

        return response()->json(['status' => 201, 'message' => 'Interaction created successfully.', 'data' => $interaction], 201);
    }

    public function update(Request $request, $id)
    {
        $interaction = Interaction::find($id);
        
        if (!$interaction) {
            return response()->json(['status' => 404, 'message' => 'Interaction not found.'], 404);
        }
        
        $request->validate([
            'customer_id' => 'exists:customers,id',
            'type' => 'string',
            'date' => 'date',
        ]);
        
        $interaction->update($request->all());
        
        return response()->json(['status' => 200, 'message' => 'Interaction updated successfully.', 'data' => $interaction], 200);
    }

    public function destroy($id)
    {
        $interaction = Interaction::find($id);
        
        if (!$interaction) {
            return response()->json(['status' => 404, 'message' => 'Interaction not found.'], 404);
        }
        
        $interaction->delete();
        
        return response()->json(['status' => 200, 'message' => 'Interaction deleted successfully.'], 200);
    }
}
