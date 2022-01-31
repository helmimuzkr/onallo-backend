@extends('layouts.dashboard')

@section('content')
  <div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Transactions</h2>
        <p class="dashboard-subtitle">
          Bigresult start from the small one
        </p>
      </div>
      <div class="dashboard-content">
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
        <div class="row justify-content-center my-5">
          <div class="col-md-3">
            <div class="link text-center">
              {{ $paginate->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
