<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json(['status' => 200, 'message' => 'Transactions retrieved successfully.', 'data' => $transactions], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json(['status' => 201, 'message' => 'Transaction created successfully.', 'data' => $transaction], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return $transaction ? response()->json(['status' => 200, 'message' => 'Transaction retrieved.', 'data' => $transaction], 200) :
                              response()->json(['status' => 404, 'message' => 'Transaction not found.'], 404);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) return response()->json(['status' => 404, 'message' => 'Transaction not found.'], 404);

        $transaction->update($request->all());
        return response()->json(['status' => 200, 'message' => 'Transaction updated successfully.', 'data' => $transaction], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) return response()->json(['status' => 404, 'message' => 'Transaction not found.'], 404);

        $transaction->delete();
        return response()->json(['status' => 200, 'message' => 'Transaction deleted successfully.'], 200);
    }
}
