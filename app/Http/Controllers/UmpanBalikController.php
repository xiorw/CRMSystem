<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $umpan_baliks = UmpanBalik::all();
        return response()->json(['status' => 200, 'message' => 'Umpan Baliks retrieved successfully.', 'data' => $umpan_baliks], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'rating' => 'required|integer|min:1|max:5',
            'date' => 'required|date',
        ]);

        $umpan_balik = Feedback::create($request->all());

        return response()->json(['status' => 201, 'message' => 'Umpan Balik created successfully.', 'data' => $umpan_balik], 201);
    }
}