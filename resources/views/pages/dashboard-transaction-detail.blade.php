@extends('layouts.dashboard')

@section('content')
  <div class="section-content section-dashboard-home"data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">{{ $transactions->code }}</h2>
        <p class="dashboard-subtitle">Transaction Details</p>
      </div>
      <div class="dashboard-content" id="transactionDetails">
        <div class="row">
          <div class="col">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
            @endif
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 ">
                    <div class="row margin-form">
                      <div class="col-12 col-md-6">
                        <div class="product-title">Nama</div>
                        <div class="product-subtitle">{{ $transactions->user->name }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">
                          Tanggal Transaksi
                        </div>
                        <div class="product-subtitle">
                          {{ $transactions->created_at }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Status Pembayaran</div>
                        @if ($transactions->transaction_status == 'PENDING')
                        <div class="product-subtitle text-warning">{{ $transactions->transaction_status }}</div>
                        @elseif ($transactions->transaction_status == 'SHIPPING')
                        <div class="product-subtitle text-primary">{{ $transactions->transaction_status }}</div>
                        @else
                        <div class="product-subtitle text-success">{{ $transactions->transaction_status }}</div>
                        @endif
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Telepon</div>
                        <div class="product-subtitle">
                          {{ $transactions->user->phone_number }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Status Pengiriman</div>
                        <div class="row">
                          <div class="col-md-6">
                            @if ($transactions->shipping_status == 'PENDING')
                              <input 
                              type="text" 
                              name="shipping_status" 
                              class="form-control" 
                              value="Pending" disabled>
                            @else
                              <input 
                                type="text" 
                                name="shipping_status" 
                                class="form-control" 
                                value="Sedang dikirim" disabled>
                              <div class="product-title mt-3">Nomor Resi</div>
                              <input 
                                type="text" 
                                name="resi" 
                                class="form-control" 
                                value="{{ $transactions->resi }}"
                                disabled>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Total</div>
                        <div class="product-subtitle">Rp{{ number_format($transactions->total, 0, '.','.') }}</div>
                      </div>
                      <div class="col-12 mt-5">
                        <h5>Shipping Information</h5>
                      </div>
                      <div class="col-12 col-md-6 mt-3">
                        <div class="product-title">Alamat</div>
                        <div class="product-subtitle">
                        {{$transactions->user->address}}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Kecamatan</div>
                        <div class="product-subtitle">
                          {{ App\Models\District::find($transactions->user->districts_id)->name}}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">
                        Kota/Kabupaten
                        </div>
                        <div class="product-subtitle">
                          {{ App\Models\Regency::find($transactions->user->regencies_id)->name}}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Provinsi</div>
                        <div class="product-subtitle">
                          {{ App\Models\Province::find($transactions->user->provinces_id)->name}}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Kode Pos</div>
                        <div class="product-subtitle">{{ $transactions->user->zip_code }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Catatan</div>
                        <div class="product-subtitle">
                          {{ $transactions->notes }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row my-4">
                  <div class="col-12">
                    <hr style="border-width: 3px;">
                  </div>
                </div>
                <div class="row margin-form"> 
                  <h5 class="col-12 mb-3">
                    Product
                  </h5>
                  <div class="col">
                    @foreach ($transaction as $transaction)
                      <div class="card card-list d-block">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-1">
                              <img
                              src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                              alt=""
                              class="w-50"/>
                            </div>
                            <div class="col-md-3">{{ $transaction->code }}</div>
                            <div class="col-md-3">{{ $transaction->product->name }}</div>
                            <div class="col-md-3">Rp{{ number_format($transaction->price, 0, '.','.') }}</div>
                            {{-- <div class="col-md-3">{{ $transaction->created_at->format('Y-m-d') }}</div> --}}
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
