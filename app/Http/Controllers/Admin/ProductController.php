<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\DataTables;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = Product::with('category');

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle mr-1 mb-1"
                                    type="button"
                                    data-toggle="dropdown">
                                    Action   
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href=" '. route('product.edit', $item->id) .' ">
                                        Edit
                                    </a>
                                    <form action=" '. route('product.destroy', $item->id) .' " method="POST">
                                        '. method_field('delete'). csrf_field() .'
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('updated_at',function($data){
                    return  $data->updated_at->format('d-m-Y');
                 })
                 ->editColumn('created_at',function($data){
                     return  $data->created_at->format('d-m-Y');   
                 })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        // $gallery = [
        //     'products_id' => $product->id,
        //     'photos' => $request->file('photos')->store('assets/product', 'public')
        // ];
        // ProductGallery::created($gallery);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $item = Product::findOrFail($id);
        $categories = Category::all();
        
        return view('pages.admin.product.edit', [
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        
        $item = Product::findOrFail($id);
        
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}
