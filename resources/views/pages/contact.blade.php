@extends('layouts.app')

@section('content')
<div class="page-content pages-contact">
    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row text-center">
          <div class="col-12">
            <h1>Kontak Kami</h1>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-4">
            <div class="card py-4 mb-3">
              <div class="row align-items-center">
                <div class="col-4 d-flex justify-content-end">
                  <img
                    src="/images/icon-email.svg"
                    alt=""
                    class="img-fluid"
                  />
                </div>
                <div class="col-8">
                  <div class="title">Email</div>
                  <div class="text">onalloid@gmail.com</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card py-4 mb-3">
              <div class="row align-items-center">
                <div class="col-4 d-flex justify-content-end">
                  <img
                    src="/images/icon-telephone.svg"
                    alt=""
                    class="img-fluid"
                  />
                </div>
                <div class="col-8">
                  <div class="title">Telephone</div>
                  <div class="text">+62 851 6300 6345</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card py-4 mb-3">
              <div class="row align-items-center">
                <div class="col-4 d-flex justify-content-end">
                  <img
                    src="/images/icon-instagram.svg"
                    alt=""
                    class="img-fluid"
                  />
                </div>
                <div class="col-8">
                  <div class="title">Instagram</div>
                  <div class="text">onallo.id</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- More Info -->
    <section id="more-info" class="my-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <div class="row">
              <div class="col">
                <h1>For partnership and business development, reach us at</h1>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col d-flex">
                <img
                  src="/images/icon-place.svg"
                  alt="icon-location"
                  class="mr-3"
                />
                <div class="text">
                  Jl. Pemuda, Salero, Ternate Utara, Kota Ternate, Maluku
                  Utara 97725
                </div>
              </div>
            </div>
            <div class="row align-items-center mt-3">
              <div class="col d-flex">
                <img
                  src="/images/icon-whatsapp.png"
                  alt="icon-whatsapp"
                  style="width: 30px; height: 30px"
                />
                <div class="col">
                  <div class="title">Or Talk To Us</div>
                  <div class="text">+62 8212 5299 60</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="map">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3989.426963688929!2d127.38249206542969!3d0.8025109767913817!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x329cb1622db81687%3A0xda65a66e6af21b02!2sJl.%20Pemuda%2C%20Salero%2C%20Ternate%20Utara%2C%20Kota%20Ternate%2C%20Maluku%20Utara!5e0!3m2!1sen!2sid!4v1642244334005!5m2!1sen!2sid"
                width="550"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
@endsection