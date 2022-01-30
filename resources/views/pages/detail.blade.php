@extends('layouts.app')

@section('content')
<div class="page-content page-details">
  <section
    class="store-breadcrumbs"
    data-aos="fade-down"
    data-aos-delay="100"
  >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/index.html">Home</a>
              </li>
              <li class="breadcrumb-item active">Product Details</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- Gallery -->
  <div class="container" >
    <div class="row">
        <div data-aos="zoom-in" class="col-lg-7 aos-init" >
          <section  class="store-gallery" id="gallery">
            <div class="row">
              <div class="col-2">
                <div class="row justify-content-around">
                  <div class="col-12 col-lg-12 mt-2 mt-lg-0 px-0"
                        v-for="(photo, index) in photos"
                        :key="photo.id"
                        data-aos="zoom-in"
                        data-aos-delay="100">
                    <a href="#" v-on:click="changeActive(index)">
                      <img
                        :src="photo.url"
                        class="w-100 thumbnail-image"
                        :class="{ active: index == activePhoto}"
                        alt="product images"/>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-10 col-md-9">
                <transition name="slide-fade" mode="out-in">
                  <img
                    :src="photos[activePhoto].url"
                    :key="photos[activePhoto].id"
                    class="w-100 main-image  "
                    alt="Product image"/>
                </transition>
              </div>
            </div>
          </section>
        </div>

        <!-- Details Gallery -->
        <div class="col-12 col-md-5">
          <section class="store-details-container">
            <div class="row">
              <div class="col-12">
                <div class="store-details-container" >
                  <section class="store-heading">
                    <div class="container">
                      <div class="row">
                        <div class="col-12  aos-init" data-aos="fade-up" data-aos-delay="100">
                          <h3>{{ $product->name }}</h3>
                          <div class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="store-button">
                    <div class="container">
                      <div class="row mt-lg-4  aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-12">
                          @auth
                            <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <button type="submit" class="btn btn-dark py-2 text-white mb-3 btn-block">
                                Tambah ke Keranjang
                              </button> 
                            </form>
                          @else
                          <a type="submit" href="{{ route('login') }}" class="btn btn-dark text-white mb-2 btn-block">
                            Tambah ke Keranjang
                          </a> 
                          <small class="text-muted">*Login terlebih dahulu jika ingin menambah produk ke keranjang</small>
                          @endauth
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="store-description">
                    <div class="container">
                      <div class="row mt-4">
                        <div class="col-12  aos-init" data-aos="fade-up" data-aos-delay="200">
                          {!! $product->description !!}
                        </div>
                      </div>
                  </section>
                </div>
              </div>
            </div>
          </section>
        </div>
    </div>
 </div>
</div>

@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<!-- Script vue.js untuk galery -->
<script>
  var gallery = new Vue({
    el: "#gallery",
    mounted() {
      AOS.init();
    },
    data: {
      activePhoto: 0,
      photos: [
        @foreach ($product->galleries as $gallery )
        {
          id: {{ $gallery->id }},
          url: "{{ Storage::url($gallery->photos) }}",
        },
        @endforeach
      ],
    },
    methods: {
      changeActive(id) {
        this.activePhoto = id;
      },
    },
  });
</script>
@endpush