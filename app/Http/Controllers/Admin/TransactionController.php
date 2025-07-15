<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

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

    /**
     * Update status (action) dari transaction item (via AJAX).
     */
    public function updateAction(Request $request, $id)
{
    $request->validate([
        'action' => 'required|in:pending,cancel,dikirim,sukses'
    ]);

    $item = TransactionItem::findOrFail($id);
    $item->action = $request->action;
    $item->save();

    return response()->json([
        'message' => 'Status produk berhasil diupdate ke "' . ucfirst($request->action) . '"'
    ]);
}
    
}
