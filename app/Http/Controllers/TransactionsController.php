<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Assuming you have a Transaction model

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', ['transactions' => $transactions]);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return view('transactions.show', ['transaction' => $transaction]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        // Create a new transaction
        $transaction = new Transaction();
        $transaction->amount = $validatedData['amount'];
        $transaction->description = $validatedData['description'];
        // Set other attributes
        $transaction->save();

        return redirect('/transactions')->with('success', 'Transaction created successfully!');
    }

    public function update(Request $request, $id)
    {
        // Logic for updating a transaction
    }

    public function destroy($id)
    {
        // Logic for deleting a transaction
    }
}

