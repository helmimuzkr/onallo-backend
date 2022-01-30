<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function detail(Request $request, $id) {
        $product = Product::with(['galleries'])->where('slug', $id)->firstOrFail();

        return view('pages.detail', [
            'product' => $product
        ]);
    }

    public function add(Request $request, $id) {

        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ];

        Cart::create($data);

        return redirect()->route('catalog');
    }
}
