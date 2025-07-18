<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionItem;

class CustomerTransactionController extends Controller
{
    public function index()
    {
        $transactions = TransactionItem::whereHas('transaction', function ($query) {
            $query->where('id', Auth::id());
        })->latest()->get();

        return view('hsnstudio.detail_transaksi_customers.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = TransactionItem::whereHas('transaction', function ($query) {
            $query->where('id', Auth::id());
        })->findOrFail($id);

        return view('hsnstudio.detail_transaksi_customers.show', compact('transaction'));
    }
}
