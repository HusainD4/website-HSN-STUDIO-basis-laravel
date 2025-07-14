<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('items')->latest()->get();
        return view('admin.transaction.admin_transaction', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with('items')->findOrFail($id);
        return view('admin.transaction.show_transaction', compact('transaction'));
    }
}
