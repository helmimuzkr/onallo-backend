@extends('layouts.dashboard')

@section('title')
    Dashboard Product
@endsection

@section('content')
<div
class="section-content section-dashboard-home" data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">My Products</h2>
    <p class="dashboard-subtitle">Manage it well and get money</p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-12">
        <a
          href="/dashboard-products-create.html"
          class="btn btn-dark mr-2"
          >Tambah Produk</a
        >
        <button type="button" class="btn btn-danger">
          Delete Product
        </button>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a
          href="/dashboard-products-details.html"
          class="card card-dashboard-products d-block"
        >
          <div class="card-body">
            <img
              src="/images/dashboard-product-card.png"
              alt=""
              class="w-100 mb-2"
            />
            <div class="product-title">Kaos Polos</div>
            <div class="product-subtitle">T-Shirt</div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a
          href="/dashboard-products-details.html"
          class="card card-dashboard-products d-block"
        >
          <div class="card-body">
            <img
              src="/images/dashboard-product-card.png"
              alt=""
              class="w-100 mb-2"
            />
            <div class="product-title">Kaos Polos</div>
            <div class="product-subtitle">T-Shirt</div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a
          href="/dashboard-products-details.html"
          class="card card-dashboard-products d-block"
        >
          <div class="card-body">
            <img
              src="/images/dashboard-product-card.png"
              alt=""
              class="w-100 mb-2"
            />
            <div class="product-title">Kaos Polos</div>
            <div class="product-subtitle">T-Shirt</div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a
          href="/dashboard-products-details.html"
          class="card card-dashboard-products d-block"
        >
          <div class="card-body">
            <img
              src="/images/dashboard-product-card.png"
              alt=""
              class="w-100 mb-2"
            />
            <div class="product-title">Kaos Polos</div>
            <div class="product-subtitle">T-Shirt</div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a
          href="/dashboard-products-details.html"
          class="card card-dashboard-products d-block"
        >
          <div class="card-body">
            <img
              src="/images/dashboard-product-card.png"
              alt=""
              class="w-100 mb-2"
            />
            <div class="product-title">Kaos Polos</div>
            <div class="product-subtitle">T-Shirt</div>
          </div>
        </a>
      </div>
    </div>
  </div>
 </div>
</div>
@endsection