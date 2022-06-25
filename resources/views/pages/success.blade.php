@extends('layouts.success')

@section('content')
<div class="page-content page-success">
    <div class="section-success" data-aos="zoom-in">
      <div class="container">
        <div class="row row-login align-items-center justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Transaction Processed!</h2>
            <p class="mt-2">
              Silahkan tunggu konfirmasi email dari kami dan kami akan <br />
              menginformasikan resi secept mungkin!
            </p>
            <div>
              <a class="btn btn-dark w-50 mt-4" href="{{ route('dashboard-transaction')  }}">
                My Transactions
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