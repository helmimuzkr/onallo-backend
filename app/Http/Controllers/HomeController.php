<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $products = Product::with(['galleries'])->take(4)->get(); //Jadikan array supaya bisa ambil lebih dari 1 relasi
        return view('pages.home', [
            'products' => $products
        ]);
    }
}
