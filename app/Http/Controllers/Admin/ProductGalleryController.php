<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductGallery;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = ProductGallery::with('product');

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <form action=" '. route('product-gallery.destroy', $item->id) .' " method="POST">
                        '. method_field('delete'). csrf_field() .'
                            <button type="submit" class="btn btn-danger text-white">
                                Delete
                            </button>
                        </form>
                    ';
                })
                ->editColumn('photos', function($item) {
                    return $item->photos ? '<img src="'. Storage::url($item->photos) .'"
                    style="max-height:32px;">' : '';
                })
                ->editColumn('updated_at',function($data){
                    return  $data->updated_at->format('d-m-Y');
                 })
                 ->editColumn('created_at',function($data){
                     return  $data->created_at->format('d-m-Y');   
                 })
                ->rawColumns(['action', 'photos'])
                ->make();
        }

        return view('pages.admin.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.admin.product-gallery.create', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductGalleryRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
