@extends('layouts.admin')

@section('content')
<div class="section-content section-dashboard-home"data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $item->code }}</h2>
            <p class="dashboard-subtitle">Transaction Details</p>
        </div>
        <div class="dashboard-content" >
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
                    <form action="{{ route('transaction.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        @foreach ($transactions as $transaction)
                                            <a
                                            class="card card-list d-block"
                                            href="{{ route('dashboard-transaction-detail', $transaction->id) }}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                    <img
                                                        src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                        alt=""
                                                        class="w-50"
                                                    />
                                                    </div>
                                                    <div class="col-md-2">{{ $transaction->code }}</div>
                                                    <div class="col-md-3">{{ $transaction->product->name }}</div>
                                                    <div class="col-md-3">Rp{{ number_format($transaction->product->price, 0, '.','.') }}</div>
                                                    <div class="col-md-2">{{ $transaction->created_at->format('Y-m-d') }}</div>
                                                    <div class="col-md-1 d-none d-md-block">
                                                    <img
                                                        src="/images/dashboard-icon-arrow.svg"
                                                        alt=""
                                                    />
                                                    </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                        <div class="row" id="transactionStatus">
                                            <div class="col">
                                                <div class="product-title">Status Transaksi</div>
                                                <select 
                                                    name="transaction_status" 
                                                    id="transaction_status" 
                                                    class="form-control" 
                                                    v-model="status">
                                                    <option value="PENDING">Pending</option>
                                                    <option value="FAILED">Gagal</option>
                                                    <option value="SUCCESS">Berhasil</option>
                                                </select>
                                            </div>
                                            <div class="col-12 my-3">
                                                <button 
                                                type="submit" 
                                                class="btn btn-dark btn-block"
                                                >Update Status Transaksi
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row mt-3" id="shippingStatus">
                                            <div class="col">
                                                <div class="product-title">Status Pengiriman</div>
                                                <select 
                                                    name="shipping_status" 
                                                    id="shipping_status" 
                                                    class="form-control" 
                                                    v-model="status">
                                                    <option value="PENDING">Pending</option>
                                                    <option value="SHIPPING">Sedang dikirim</option>
                                                    <option value="SUCCESS">Berhasil</option>
                                                </select>
                                            </div>
                                            <template v-if="status == 'SHIPPING'">
                                                <div class="col-12 mt-3">
                                                    <div class="product-title">Nomor Resi</div>
                                                    <input 
                                                    type="text" 
                                                    name="resi" 
                                                    class="form-control" 
                                                    v-model="resi"
                                                    value="{{ $transaction->resi }}">
                                                </div>
                                            </template>
                                            <template v-if="status == 'SUCCESS'">
                                                <div class="col-12 mt-3">
                                                    <div class="product-title">Nomor Resi</div>
                                                    <input 
                                                    type="text" 
                                                    name="resi" 
                                                    class="form-control" 
                                                    v-model="resi"
                                                    value="{{ $transaction->resi }}"
                                                    disabled>
                                                </div>
                                            </template>
                                            <div class="col-12 my-3">
                                                <button 
                                                type="submit" 
                                                class="btn btn-dark btn-block"
                                                >Update resi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8 ">
                                        <div class="row margin-form">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Nama</div>
                                                <div class="product-subtitle">{{ $item->user->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Nama Produk</div>
                                                <div class="product-subtitle">{{ $transaction->product->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                Tanggal Transaksi
                                                </div>
                                                <div class="product-subtitle">
                                                {{ $transaction->created_at }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Status Pembayaran</div>
                                                @if ($item->transaction_status == 'PENDING')
                                                    <div class="product-subtitle text-warning">
                                                        {{ $item->transaction_status}}
                                                    </div>
                                                @elseif ($item->transaction_status == 'SUCCESS')
                                                    <div class="product-subtitle text-success">
                                                        {{ $item->transaction_status}}
                                                    </div>
                                                @else
                                                    <div class="product-subtitle text-danger">
                                                        Gagal
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Total</div>
                                                <div class="product-subtitle">Rp{{ number_format($item->total, 0, '.','.') }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Telepon</div>
                                                <div class="product-subtitle">
                                                {{ $item->user->phone_number }}
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <h5>Shipping Information</h5>
                                            </div>
                                            <div class="col-12 col-md-6 mt-3">
                                                <div class="product-title">Alamat</div>
                                                <div class="product-subtitle">
                                                {{$item->user->address}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Kecamatan</div>
                                                <div class="product-subtitle">
                                                {{ App\Models\District::find($item->user->districts_id)->name}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                Kota/Kabupaten
                                                </div>
                                                <div class="product-subtitle">
                                                {{ App\Models\Regency::find($item->user->regencies_id)->name}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Provinsi</div>
                                                <div class="product-subtitle">
                                                {{ App\Models\Province::find($item->user->provinces_id)->name}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Kode Pos</div>
                                                <div class="product-subtitle">{{ $item->user->zip_code }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Catatan</div>
                                                <div class="product-subtitle">
                                                {{ $item->notes }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script>
  var shippingStatus = new Vue({
    el: "#shippingStatus",
    data: {
      status: "{{ $transaction->shipping_status }}",
        resi: "{{ $transaction->resi }}",
    },
  });
  var transactionStatus = new Vue({
    el: "#transactionStatus",
    data: {
      status: "{{ $item->transaction_status }}",
    },
  });
</script>
@endpush