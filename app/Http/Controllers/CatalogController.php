<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function catalog() {
        $categories = Category::all();
        $products = Product::with(['galleries'])->paginate(6);

        return view('pages.catalog', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug) {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(6);

        return view('pages.catalog', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }
}
