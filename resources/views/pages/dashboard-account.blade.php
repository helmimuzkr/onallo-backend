@extends('layouts.dashboard')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">My Account</h2>
    <p class="dashboard-subtitle">Update your current profile</p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-12">
        <form action="{{ route('dashboard-setting-redirect', 'dashboard-account') }}" method="POST" enctype="multipart/form-data" id="locations">
          @csrf
          <div class="card">
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      aria-describedby="emailHelp"
                      name="name"
                      value="{{ $user->name }}"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      aria-describedby="emailHelp"
                      name="email"
                      value="{{ $user->email }}"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <input
                      type="text"
                      class="form-control"
                      id="address"
                      name="address"
                      value="{{ $user->address }}"
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
                    value="{{ $user->zip_code }}"
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
                      value="{{ $user->phone_number }}"
                    />
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col text-right">
                  <button
                    type="submit"
                    class="btn btn-dark py-2 px-5"
                  >
                    Save Now
                  </button>
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
