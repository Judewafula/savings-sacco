<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account; // Assuming you have an Account model


class AccountsController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', ['accounts' => $accounts]);
    }

    public function show($id)
    {
        $account = Account::find($id);
        return view('accounts.show', ['account' => $account]);
    }

    public function store(Request $request)
    {
       if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized. Only admin can create users.');
    }
        // Logic for storing a new account
    }

    public function update(Request $request, $id)
    {
        // Logic for updating an account
    }

    public function destroy($id)
    {
        // Logic for deleting an account
    }


public function create()
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized. Only admin can create users.');
    }
    return view('users.create');
}

public function __construct()
{
    $this->middleware('auth');
    $this->middleware('is_admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
}
}