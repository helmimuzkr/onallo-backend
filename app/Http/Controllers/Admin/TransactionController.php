<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::with(['user']);

            return Datatables::of($query)
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
                                <a class="dropdown-item" href=" '. route('transaction.edit', $item->id) .' ">
                                    Edit
                                </a>
                                <form action=" '. route('transaction.destroy', $item->id) .' " method="POST">
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
                 ->editColumn('created_at',function($data){
                     return  $data->created_at->format('d-m-Y');   
                 })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                        ->whereHas('transaction', function($transaction){
                                            $transaction->where('users_id', Auth::user()->id);
                                        })->get();
        $transactions_paginate = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                        ->whereHas('transaction', function($transaction){
                                            $transaction->where('users_id', Auth::user()->id);
                                        })->paginate(5);

        $item = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                        ->findOrFail($id);

        $transactions = Transaction::with(['user'])->findOrFail($id);

        
        return view('pages.admin.transaction.edit',[
            'item' => $item,
            'transaction' => $transaction,
            'transactions' => $transactions,
            'transactions_paginate' => $transactions_paginate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $transactions = Transaction::findOrFail($id);

        $transactions->update($data);

        $transaction = TransactionDetail::findOrFail($id);

        $transaction->update($data);


        return redirect()->route('transaction.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findorFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }
}