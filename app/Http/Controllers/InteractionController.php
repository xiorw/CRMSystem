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
}