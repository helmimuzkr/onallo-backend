@extends('layouts.app')

@section('content')
<div class="page-content page-cart">
  <section
    class="store-breadcrumbs"
    data-aos="fade-down"
    data-aos-delay="100"
  >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/index.html">Home</a>
              </li>
              <li class="breadcrumb-item active">Cart</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="store-cart">
    <div class="container">
      <!-- Table Cart -->
      <div class="row">
        <div
          class="col-12 table-tesponsive"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <table
            class="table table-borderless table-cart"
            aria-describedby="Cart"
          >
            <thead>
              <tr>
                <td scope="col">Gambar</td>
                <td scope="col">Nama</td>
                <td scope="col">Harga</td>
                <td scope="col">Menu</td>
              </tr>
            </thead>
            <tbody>
              @php
                $subTotalPrice = 0;
                $total = 0;
              @endphp
              @foreach ($cart as $cart)
                <tr>
                  <td style="width: 25%">
                    @if ($cart->product->galleries->count())
                      <img
                      src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                      alt=""
                      class="cart-image"/>
                    @else
                    <img
                    style="background-color: #eee;"
                    alt=""
                    class="cart-image"/>
                    @endif
                  </td>
                  <td style="width: 35%">
                    <div class="product-title">{{ $cart->product->name }}</div>
                    <!-- Baris untuk informasi size yang dibeli -->
                    <!-- <div class="product-subtitle">Ukuran XL</div> -->
                  </td>
                  <td style="width: 35%">
                    <div class="product-title">Rp{{ number_format($cart->product->price, 0, '.', '.') }}</div>
                    <!-- <div class="product-subtitle">Rupiah</div> -->
                  </td>
                  <td class="text-center" style="width: 20%">
                    <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-remove-cart px-0">
                        <img src="images/trash-icon.svg" alt="" />
                      </button>
                    </form>
                  </td>
                </tr>
                @php
                    $subTotalPrice += $cart->product->price
                @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Garis Pembatas -->
      <!--           <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-md-12">
          <hr />
        </div>
      </div> -->

      <!-- Form Alamat -->
      <form action="{{ route('checkout') }}" method="POST" id="locations" enctype="multipart/form-data">
        @csrf
        <div
        class="row mb-2 aos-init"
        data-aos="fade-up"
        data-aos-delay="350">
        <div class="col-12">
          <h5 class="mt-5 mb-4">Detail Pengiriman</h5>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="address">Alamat</label>
            <input
              type="text"
              class="form-control"
              id="address"
              name="alamat"
              value="Alamat"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="provinces_id">Provinsi</label>
            <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
              <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
            </select>
            <select v-else class="form-control"></select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="regencies_id">Kota/Kabupaten</label>
            <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
              <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
            </select>
            <select v-else class="form-control"></select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="districts_id">Kecamatan</label>
            <select name="districts_id" id="districts_id" class="form-control" v-if="districts" v-model="districts_id">
              <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
            </select>
            <select v-else class="form-control"></select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="zip_code">Kode Pos</label>
            <input
            type="text"
            class="form-control"
            id="zip_code"
            name="zip_code"
            value=""
          />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone_number">Nomor Telepon</label>
            <input
              type="text"
              class="form-control"
              id="phone_number"
              name="phone_number"
              value=""
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="notes">Catatan</label>
            <input
              type="text"
              class="form-control"
              id="notes"
              name="notes"
              value=""
            />
          </div>
        </div>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12 col-md-5">
          <h5>Informasi Pembayaran</h5>
        </div>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="250">
        <div class="col-4 col-md-2 mt-3">
          <div class="product-title">Rp{{ number_format($subTotalPrice ?? 0, 0, '.', '.') }}</div>
          <div class="product-subtitle">Subtotal</div>
        </div>
        <div class="col-4 col-md-2 mt-3">
          <div class="product-title">Rp.13,000</div>
          <div class="product-subtitle">Ongkir</div>
        </div>
        <div class="col-4 col-md-2 mt-3">
          <div class="product-title" style="color: #073466">
            <b>Rp{{ number_format($subTotalPrice + 13000, 0, '.', '.') }}</b>
          </div>
          <div class="product-subtitle">
            <b>Total</b>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <button type="submit" class="btn btn-dark mt-4 px-4 btn-block">
            Checkout Now
          </button>
        </div>
      </div>
      <input type="hidden" name="sub_total" value="{{ $subTotalPrice }}">
      <input type="hidden" name="total_price" value="{{ $subTotalPrice + 13000 }}">
      </form>
    </div>
  </section>
</div>
@endsection


@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Script vue.js untuk galery -->
<script>
  var locations = new Vue({
    el: "#locations",
    mounted() {
      AOS.init();/* memanggil AOS.init */
      this.getProvincesData();
    },
    data: {
      provinces: null,
      regencies: null,
      districts: null,
      provinces_id: null,
      regencies_id: null,
      districts_id: null,

    },
    methods: {
      getProvincesData: function() {
        var self = this;
        axios.get('{{ route('api-provinces') }}')
        .then(function(response) {
            self.provinces = response.data;
          }) 
      },
      getRegenciesData: function() {
        var self = this;
        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
        .then(function(response) {
            self.regencies = response.data;
          }) 
      },
      getDistrictsData: function() {
        var self = this;
        axios.get('{{ url('api/districts') }}/' + self.regencies_id)
        .then(function(response) {
            self.districts = response.data;
          }) 
      },
    },
    watch: {
      provinces_id: function(val, oldVal) {
        this.regencies_id = null;
        this.getRegenciesData();
      },
      regencies_id: function(val, oldVal) {
        this.districts_id = null;
        this.getDistrictsData();
      }
    }
  });
</script>
@endpush
