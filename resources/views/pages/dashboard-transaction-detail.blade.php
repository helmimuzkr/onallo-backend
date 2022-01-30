@extends('layouts.dashboard')

@section('content')
<div class="section-content section-dashboard-home"data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title"></h2>
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
        <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-4">
               <div class="row">
                 <div class="col">
                  <img
                  src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                  alt=""
                  class="rounded w-100 mb-3"
                />
                 </div>
               </div>
                <div class="row mt-3 mb-5">
                  <div class="col">
                    <div class="product-title">Status Transaksi</div>
                    @if ($transaction->shipping_status == 'PENDING')
                      <input 
                      type="text" 
                      name="shipping_status" 
                      class="form-control" 
                      value="Pending" disabled>
                    @elseif ($transaction->shipping_status == 'SHIPPING')
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
                      value="{{ $transaction->resi }}"
                      disabled>
                    @else
                      <input 
                      type="text" 
                      name="shipping_status" 
                      class="form-control" 
                      value="Berhasil" disabled>
                    @endif
                    {{-- <select 
                    name="shipping_status" 
                    id="shipping_status" 
                    class="form-control" 
                    v-model="status">
                     <option value="PENDING">Pending</option>
                     <option value="SHIPPING">Sedang dikirim</option>
                     <option value="SUCCESS">Berhasil</option>
                   </select> --}}
                  </div>
                  {{-- <template v-if="status == 'SHIPPING'">
                   <div class="col-12 my-3">
                     <div class="product-title">Nomor Resi</div>
                     <input 
                     type="text" 
                     name="resi" 
                     class="form-control" 
                     v-model="resi">
                   </div>
                   <div class="col-12">
                     <button 
                     type="submit" 
                     class="btn btn-dark btn-block"
                     >Update resi
                   </button>
                   </div>
                  </template> --}}
                </div>
              </div>
              <div class="col-12 col-md-8 ">
                <div class="row margin-form">
                  <div class="col-12 col-md-6">
                    <div class="product-title">Nama</div>
                    <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
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
                    <div class="product-subtitle text-danger">
                      {{ $transaction->transaction->transaction_status}}
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">Total</div>
                    <div class="product-subtitle">{{ $transaction->transaction->total }}</div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">Telepon</div>
                    <div class="product-subtitle">
                      {{ $transaction->transaction->user->phone_number }}
                    </div>
                  </div>
                  <div class="col-12 mt-4">
                    <h5>Shipping Information</h5>
                  </div>
                  <div class="col-12 col-md-6 mt-3">
                    <div class="product-title">Alamat</div>
                    <div class="product-subtitle">
                     {{$transaction->transaction->user->address}}
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">Kecamatan</div>
                    <div class="product-subtitle">
                      {{ App\Models\District::find($transaction->transaction->user->districts_id)->name}}
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">
                     Kota/Kabupaten
                    </div>
                    <div class="product-subtitle">
                      {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name}}
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">Provinsi</div>
                    <div class="product-subtitle">
                      {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name}}
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">Kode Pos</div>
                    <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="product-title">Catatan</div>
                    <div class="product-subtitle">
                      {{ $transaction->transaction->notes }}
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
  var transactionDetails = new Vue({
    el: "#transactionDetails",
    data: {
      status: "{{ $transaction->shipping_status }}",
        resi: "{{ $transaction->resi }}",
    },
  });
</script>
@endpush