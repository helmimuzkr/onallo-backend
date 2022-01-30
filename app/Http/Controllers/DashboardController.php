<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index() {
        /* $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            }); */
        
        // dd($transactions);

        /* $revenue = $transactions->get()->reduce(function ($carry, $item) {
                    return $carry + $item->price;
        }); */
        
        $transactions = TransactionDetail::count();

        $revenue = Transaction::where('users_id', Auth::user()->id)->sum('total');

        // dd($revenue);

        $customer = User::count();

        return view('pages.dashboard', [
            // 'transaction_count' => $transactions->count(),
            // 'transaction_data' => $transactions->get(),
            'transaction' => $transactions,
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }
}