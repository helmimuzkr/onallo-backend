<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;


class CheckoutController extends Controller
{
    public function process(Request $request) {
        // Save users data
        $user = Auth::user();
        $user->update($request->except(['total_price', 'sub_total', 'notes']));

        // Process checkout
        $code = 'INV/'. mt_rand(00000,99999);
        $carts = Cart::with(['product', 'user'])
                        ->where('users_id', Auth::user()->id)
                        ->get();

        // Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'shipping_price' => 0,
            'code' => $code,
            'notes' => $request->notes,
            'subtotal' => $request->sub_total,
            'total' => $request->total_price,
            'transaction_status' => 'PENDING',
        ]);

        foreach ($carts as $cart) {
            // $trx = 'TRX/'. mt_rand(00000,99999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'code' => $code,
                // 'code' => $trx,
                'price' => $cart->product->price,
                'resi' => '',
                'shipping_status' => 'PENDING',
            ]);
        }

        // Deleting cart after checkout
        Cart::where('users_id', Auth::user()->id)->delete();

        // return dd($transaction);

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //Set parameter
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enabled_payments' => [
                'bca_va', 'bni_va', 'bri_va', 'bank_transfer'
            ]
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }
    }

    public function callback(Request $request) {

    }
}
