@extends('layouts.success')

@section('content')
  <div class="page-content page-success">
    <div class="section-success" data-aos="zoom-in">
      <div class="container">
        <div class="row row-login align-items-center justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Welcome to Store</h2>
            <p class="mt-2">
              Kamu sudah berhasil terdaftar</br>
              bersama kami. Let’s grow up now.
            </p>
            <div>
              <a class="btn btn-dark w-50 mt-4" href="/dashboard.html">
                My Dashboard
              </a>
              <a class="btn btn-signup w-50 mt-2" href="/catalog.html">
                Go To Shopping
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
@endsection