@extends('layouts.app')

@section('content')
<div class="page-content page-cart">
  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
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
        <div class="col-12 table-tesponsive" data-aos="fade-up" data-aos-delay="100">
          <table class="table table-borderless table-cart" aria-describedby="Cart">
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
      <form action="{{ route('checkout') }}" method="POST" id="locations" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2 aos-init" data-aos="fade-up" data-aos-delay="350">
        <div class="col-12">
          <h5 class="mt-5 mb-4">Detail Pengiriman</h5>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" class="form-control" id="address" name="alamat" value="{{ $cart->user->address }}" required/>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="provinces_id">Provinsi</label>
            <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id" required>
              <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
            </select>
            <select v-else class="form-control" required></select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label >Kota/Kabupaten</label>
            <select name="city_id" id="regencies_id" class="form-control" v-if="regencies" v-model="city_id" required>
              <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
            </select>
            <select v-else class="form-control" required></select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="zip_code">Kode Pos</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $cart->user->zip_code }}" required/>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="phone_number">Nomor Telepon</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $cart->user->phone_number }}" required/>
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
            />
          </div>
        </div>
        <div class="col-6 mt-3">
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label class="font-weight-bold">Kurir Pengiriman</label>
                <div class="form-check form-check">
                  <input
                    class="form-check-input select-courier"
                    type="radio"
                    name="courier"
                    id="ongkos_kirim-jne"
                    value="jne"
                    v-model="courier_type"
                    @change="getOngkir()" />
                  <label class="form-check-label  mr-4" for="ongkos_kirim-jne" >JNE</label >
                  <input
                    class="form-check-input select-courier"
                    type="radio"
                    name="courier"
                    id="ongkos_kirim-tiki"
                    value="tiki"
                    v-model="courier_type"
                    @change="getOngkir()" />
                  <label class="form-check-label  mr-4" for="ongkos_kirim-tiki" >TIKI</label>
                  <input
                    class="form-check-input select-courier"
                    type="radio"
                    name="courier"
                    id="ongkos_kirim-pos"
                    value="pos"
                    v-model="courier_type"
                    @change="getOngkir()" />
                  <label class="form-check-label " for="ongkos_kirim-pos" >POS</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 mt-3">
          <div class="form-group" v-if="cost">
            <label class="font-weight-bold">Layanan Jasa</label>
            <br />
           <div
              v-for="value in costs"
              :key="value.service"
              class="form-check form-check-inline"
            >
              <input
                class="form-check-input"
                type="radio"
                name="cost"
                :id="value.service"
                :value="value.cost[0].value + '_' + value.service"
                v-model="costService"
                @change="getCostService()"
              />
              <label
                class="form-check-label font-weight-normal mr-5"
                :for="value.service"
              >
                 @{{ value.service }} - Rp.
                @{{ value.cost[0].value }}</label
              >
            </div>
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
          <div class="product-title" name="courier"  id="courier_cost">Rp0</div>
          <div class="product-subtitle">Tujuan <p id="tujuan"></p></div>
        </div>
        <div class="col-4 col-md-2 mt-3">
          <div class="product-title" style="color: #073466" id="totalPembayaran">Rp0
            {{-- <b>Rp{{ number_format($subTotalPrice + 13000, 0, '.', '.') }}</b> --}}
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
      <input type="hidden" id="totalPrice" name="total" value="{{ $subTotalPrice }}">
      <input type="hidden" id="totalPay" name="total_pay" value="{{ $subTotalPrice }}">
      </form>
    </div>
  </section>
</div>
@endsection


@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- Script vue.js untuk galery -->
<script>
  var locations = new Vue({
    el: "#locations",
    mounted() {
      AOS.init();/* memanggil AOS.init */
      this.getProvincesData();
    },
    data(){
          return{
            courier:false,
            courier_cost:0,
            courier_service:"",
            cost:false,
            costs:[],
            costService:null,
            provinces:null,
            regencies:null,
            provinces_id:null,
            city_id:null,
            courier_type:null,
            checkout:null,
          }
        },
    methods: {
      GetCourier(){
            var self = this;
            self.courier = true;
             axios.get('{{ url('api/city_id') }}/' + self.city_id)
                    .then(function(response){
                    self.city = response.data.name;
                    document.getElementById("tujuan").innerHTML  = response.data.name;
              });
            // console.log(self.city_id)
          },
      getOngkir(){
        var self = this;
          axios.post("{{ route('api-checkOngkir') }}", {
            city_destination: self.city_id, // <-- ID kota
            courier: self.courier_type, // jenis kurir
          })
            .then((response) => {
              
              // set state cost menjadi true, untuk menampilkan pilihan cost pengiriman
              self.cost = true;
              //assign state costs dengan hasil response
              self.costs = response.data.data[0].costs;
            })
            .catch((error) => {
              console.log(error);
            });
        
      },

      getCostService(){
            var self = this;
            let shipping = self.costService.split("_");
            self.checkout = true;
            
            self.courier_cost = shipping[0];
            self.courier_service = shipping[1];
            let total = document.getElementById('totalPay').value;
            // console.log(total)
            console.log(self.courier_cost)
            let formatCost = new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 5 }).format(self.courier_cost);
            document.getElementById('courier_cost').innerHTML = `Rp${formatCost}`;
            let totalPayment = parseInt(total) + parseInt(self.courier_cost);
            let formatPayment = new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 6 }).format(totalPayment);
            console.log("total " + totalPayment);
            document.getElementById('totalPembayaran').innerHTML = `Rp${formatPayment}`;
            
            document.getElementById('totalPrice').value = totalPayment;
          },
      getProvincesData: function() {
        var self = this;
        axios.get('{{ route('api-provinces') }}')
        .then(function(response) {
            self.provinces = response.data;
          }) 
      },
      getRegenciesData: function() {
        var self = this;
        axios.get('{{ url('api/city') }}/' + self.provinces_id)
                    .then(function(response){
                      console.log(response.data)
                    self.regencies = response.data;
                      
              });
      },
    },
    watch: {
      provinces_id: function(val, oldVal) {
        this.regencies_id = null;
        this.getRegenciesData();
      },
    }
  });
</script>
@endpush
