<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function dashboard_transaction() {
        $transactions = TransactionDetail::with(['transaction.user'])
                                        ->where('users_id', Auth::user()->id)->get();
        $transactions_paginate = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                        ->whereHas('transaction', function($transaction){
                                            $transaction->where('users_id', Auth::user()->id);
                                        })->paginate(5);

        return view('pages.dashboard-transaction', [
            'transactions' => $transactions,
            'paginate' => $transactions_paginate
        ]);
    }

    public function detail(Request $request, $id) {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                        ->findOrFail($id);

        return view('pages.dashboard-transaction-detail', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-detail', $id);
    }
}
