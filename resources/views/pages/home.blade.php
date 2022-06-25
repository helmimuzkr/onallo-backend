@extends('layouts.app')

@section('content')
<div class="page-content pages-home">
    <!-- Hero -->
    <section class="store-carousel">
      <div class="container">
        <div class="row">
          <div class="col-lg-12" data-aos="zoom-in">
            <div
              id="storeCarousel"
              class="carousel slide"
              data-ride="carousel"
            >
              <ol class="carousel-indicators">
                <li
                  data-target="#storeCarousel"
                  data-slide-to="0"
                  class="active"
                ></li>
                <li data-target="#storeCarousel" data-slide-to="1"></li>
                <li data-target="#storeCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active" style="max-height: 300px; border-radius: 10px; overflow: hidden;">
                  <img
                    src="/images/banner.jpg"
                    class="d-block w-100"
                    alt="Carousel Image"
                  />
                </div>
                <div class="carousel-item" style="max-height: 300px; border-radius: 10px; overflow: hidden;">
                  <img
                    src="/images/banner.jpg"
                    class="d-block w-100"
                    alt="Carousel Image"
                  />
                </div>
                <div class="carousel-item" style="max-height: 300px; border-radius: 10px; overflow: hidden;">
                  <img
                    src="/images/banner.jpg"
                    class="d-block w-100"
                    alt="Carousel Image"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- New Products -->
    <section class="new-arivals">
      <div class="container">
        <div class="row text-center">
          <div class="col-12" data-aos="fade-up">
            <h3>New Arivals</h3>
          </div>
        </div>
        <div class="row">
          @php $increamentProduct = 0 @endphp
          @forelse ($products as $product)
              <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $increamentProduct+= 100 }}">
                <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                  <div class="card">
                    <div class="products-thumbnail">
                      <div
                        class="products-image"
                        style="
                          @if($product->galleries->count())
                              background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                          @else 
                              background-image: #eee
                          @endif
                        ">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="products-text card-tittle">{{ $product->name }}</div>
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
      </div>
    </section>
  </div>
@endsection