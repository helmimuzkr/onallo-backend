@extends('layouts.auth')

@section('content')
  <div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row justify-content-center align-items-center row-login">
          <div class="col-lg-5">
            <h2>
              Memulai untuk beli dengan  </br>
              cara terbaru
            </h2>
            <form method="POST" action="{{ route('register') }}" class="mt-3">
              @csrf
              <div class="form-group">
                <label>Full name</label>
                <input id="name" 
                  v-model="name"  
                  type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name" 
                  value="{{ old('name') }}" 
                  autocomplete="name"
                  required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Email address</label>
                <input id="email" 
                  name="email" 
                  v-model="email"
                  @change="checkForEmail()"
                  class="form-control @error('email') is-invalid @enderror" 
                  :class="{ 'is-invalid': this.email_unavailable }"
                  type="email"
                  aria-describedby="emailHelp" 
                  value="{{ old('email') }}" 
                  autocomplete="email" 
                  required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input id="password" 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                name="password"  
                autocomplete="new-password" 
                required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Password Confirm</label>
                <input id="password_confirm" 
                type="password" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                name="password_confirmation"  
                autocomplete="new-password" 
                required>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-dark btn-block mt-4" 
                      :disabled="this.email_unavailable">
                Sign Up Now
              </button>
              <a href="{{ route('login') }}" class="btn btn-signup btn-block">
                Back to Sign In
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
    <!-- Pesan Error menggunakan Toasted Vue.js -->
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);/* Memanggil library vue-toasted */

      var register = new Vue({
        el: '#register'/* id="register" */,
        mounted() {
          AOS.init();/* memanggil AOS.init */
         
        },
        methods: {
          checkForEmail: function() {
            var self = this;
            axios.get('{{ route('api-register-check') }}', {
              params: {
                email: self.email
              }
            })
              .then(function (response) {
                // Handle Success
                if(response.data == 'Available') {
                  self.$toasted.show(
                    "Email anda bisa digunakan!", {
                      position: "top-center",
                      className: "rounded", 
                      duration: 1000 
                    }
                  );
                }else { // Handle Error
                  self.email_unavailable = false;
                  self.$toasted.error(/* menginisialisasi method error toasted */
                    /* Pesan Error */ 
                    "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {/* Parameter */ 
                      position: "top-center",/* Posisi error diatas */
                      className: "rounded", /* Background errornya bulat */
                      duration: 1000 /* durasinya 1000ms */
                    }
                  );
                  self.email_unavailable = true;
                }
                 console.log(response.data);
              })
          }
        },
        data() {
          return {
            name: 'Helmi',
            email: 'helmi@gmail.com',
            email_unavailable: false,
          }
        },
      });
    </script>    
@endpush