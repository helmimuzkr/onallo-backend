@extends('layouts.app')

@section('content')
<div class="page-content pages-home" style="margin-top: 100px">
    <!-- Produk -->
    <section class="categories-products">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <!-- Kategori -->
            <div class="row mb-5">
              <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                <section class="page-categories">
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item disabled"
                      ><b>Kategori</b></a
                    >
                    <a
                      href="{{ route('catalog') }}"
                      class="list-group-item list-group-item-action {{ (request()->is('catalog')) ? 'active' : '' }}"
                      >Semua Produk</a>
                    @foreach ($categories as $category)
                    <a href="{{ route('catalog-details', $category->slug) }}" 
                      class="list-group-item list-group-item-action">
                      {{ $category->name }}
                    </a>
                    @endforeach
                  </div>
                </section>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <!-- Products -->
            <section class="store-products">
              <div class="row">
                @php
                    $increamentProduct = 0;
                @endphp
                @forelse ($products as $product)
                <div
                class="col-md-6 col-lg-4"
                data-aos="fade-up"
                data-aos-delay="{{ $increamentProduct+= 100 }}">
                <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                  <div class="card">
                    <div class="products-thumbnail">
                      <div
                        class="products-image"
                        style="
                        @if($product->galleries->count())
                          background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
                        @else
                          background-image: #eee
                        @endif
                        ">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="products-text card-tittle">
                        {{ $product->name }}
                      </div>
                      <div class="products-price">Rp{{ number_format($product->price, 0, '.', '.') }}</div>
                    </div>
                  </div>
                </a>
              </div>
              @empty
              <div class="col-12 text-center py-5" 
                    data-aos="fade-up" 
                    data-aos-delay="100">
              No Product Found
              </div>
              @endforelse
              </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-center">
                  {{ $products->links() }}
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection