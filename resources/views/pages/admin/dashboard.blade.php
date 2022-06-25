@extends('layouts.admin')

@section('content')
<div class="section-content section-dashboard-home"data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Dashboard</h2>
    <p class="dashboard-subtitle">
      This is Onallo Administration Panel.
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-body">
            <div class="dashboard-card-title">User</div>
            <div class="dashboard-card-subtitle">{{ $customer }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-body">
            <div class="dashboard-card-title">Revenue</div>
            <div class="dashboard-card-subtitle">Rp{{ number_format($revenue, 0, '.', '.') }}</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-body">
            <div class="dashboard-card-title">Transaction</div>
            <div class="dashboard-card-subtitle">{{ number_format($transaction, 0, '.', '.') }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3" >
      <div class="col-12 mt-2">
        <h5 class="mb-3">Recent Transactions</h5>
        @foreach ($transaction_data as $transaction)
            <a
            class="card card-list d-block"
            href="{{ route('transaction.edit', $transaction->id) }}">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">{{ $transaction->code }}</div>
                @if ($transaction->transaction_status == 'SUCCESS')
                    <div class="col-md-3 font-weight-bold text-success">Pembayaran Sukses</div>
                @elseif ($transaction->transaction_status == 'FAILED')
                    <div class="col-md-3 font-weight-bold text-danger">Pesanan Gagal</div> 
                @else
                    <div class="col-md-3 font-weight-bold">Belum dibayar</div> 
                @endif
                <div class="col-md-3">Rp{{ number_format($transaction->total, 0, '.','.') }}</div>
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
      </div>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-3">
            <div class="link text-center">
                {{ $transaction_data->links() }}
            </div>
        </div>
    </div>
  </div>
 </div>
</div>
@endsection