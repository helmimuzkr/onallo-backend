<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\DataTables;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\ProductGallery;

class GalleryDelete extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries','category'])->get();

        return view('product.edit',[
            'products' => $products
        ]);
    }

    public function details(Request $request, $id)
    {
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();

        return view('product.edit',[
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product.edit', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findorFail($id);
        $item->delete();

        return redirect()->route('product.edit', $item->products_id);
    }

    public function create()
    {
        $categories = Category::all();

        return view('product.edit',[
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        /* $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public')
        ]; */
        $gallery = $request->all();
        $gallery['photos'] = $request->file('photos')->store('assets/product', 'public');
        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}