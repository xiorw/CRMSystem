<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return response()->json(['status' => 200, 'message' => 'Reports retrieved successfully.', 'data' => $reports], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'notes' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $report = Report::create($request->all());

        return response()->json(['status' => 201, 'message' => 'Report created successfully.', 'data' => $report], 201);
    }
}
