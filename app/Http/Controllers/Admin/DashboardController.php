<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class DashboardController extends Controller
{
    public function index() {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries']);
        $recentTransactions = Transaction::with(['user'])->orderBy('created_at', 'desc')->paginate(4);
        
        // dd($transactions);

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
                    return $carry + $item->price;
        });

        $customer = User::count();

        return view('pages.admin.dashboard', [
            'transaction' => $transactions->count(),
            'transaction_data' => $recentTransactions,
            // 'transaction' => $transactions,
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }
}
