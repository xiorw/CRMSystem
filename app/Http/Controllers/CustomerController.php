<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['status' => 200, 'message' => 'Customers retrieved successfully.', 'data' => $customers], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['status' => 201, 'message' => 'Customer created successfully.', 'data' => $customer], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return $customer ? response()->json(['status' => 200, 'message' => 'Customer retrieved.', 'data' => $customer], 200) :
                           response()->json(['status' => 404, 'message' => 'Customer not found.'], 404);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) return response()->json(['status' => 404, 'message' => 'Customer not found.'], 404);

        $customer->update($request->only('name', 'email', 'phone', 'address', 'password'));
        return response()->json(['status' => 200, 'message' => 'Customer updated successfully.', 'data' => $customer], 200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) return response()->json(['status' => 404, 'message' => 'Customer not found.'], 404);

        $customer->delete();
        return response()->json(['status' => 200, 'message' => 'Customer deleted successfully.'], 200);
    }
}