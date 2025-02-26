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

    public function show($id)
    {
        $report = Report::find($id);
        
        if (!$report) {
            return response()->json(['status' => 404, 'message' => 'Report not found.'], 404);
        }
        
        return response()->json(['status' => 200, 'message' => 'Report retrieved successfully.', 'data' => $report], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'type' => 'required|string',
            'notes' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $report = Report::create($request->all());

        return response()->json(['status' => 201, 'message' => 'Report created successfully.', 'data' => $report], 201);
    }

    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        
        if (!$report) {
            return response()->json(['status' => 404, 'message' => 'Report not found.'], 404);
        }
        
        $request->validate([
            'admin_id' => 'exists:admins,id',
            'type' => 'string',
            'notes' => 'nullable|string',
            'date' => 'date',
        ]);
        
        $report->update($request->all());
        
        return response()->json(['status' => 200, 'message' => 'Report updated successfully.', 'data' => $report], 200);
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        
        if (!$report) {
            return response()->json(['status' => 404, 'message' => 'Report not found.'], 404);
        }
        
        $report->delete();
        
        return response()->json(['status' => 200, 'message' => 'Report deleted successfully.'], 200);
    }
}
