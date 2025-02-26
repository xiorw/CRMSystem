<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return response()->json(['status' => 200, 'message' => 'Admins retrieved successfully.', 'data' => $admins], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['status' => 201, 'message' => 'Admin created successfully.', 'data' => $admin], 201);
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return $admin ? response()->json(['status' => 200, 'message' => 'Admin retrieved.', 'data' => $admin], 200) :
                        response()->json(['status' => 404, 'message' => 'Admin not found.'], 404);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin) return response()->json(['status' => 404, 'message' => 'Admin not found.'], 404);

        $admin->update($request->only('name', 'email', 'password'));
        return response()->json(['status' => 200, 'message' => 'Admin updated successfully.', 'data' => $admin], 200);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) return response()->json(['status' => 404, 'message' => 'Admin not found.'], 404);

        $admin->delete();
        return response()->json(['status' => 200, 'message' => 'Admin deleted successfully.'], 200);
    }
}
