<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart() {
        $cart = Cart::with(['product.galleries', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();

        return view('pages.cart', [
            'cart' => $cart
        ]);
    }

    public function delete($id) {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart');
    }

    public function checkout_success() {
        return view('pages.success');
    }
}
