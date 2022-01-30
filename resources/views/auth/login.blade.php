  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8" />
      <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
      />
      <meta name="description" content="" />
      <meta name="author" content="" />
  
      
      <title>Onallo: Wear Better, Look Better.</title>
      
      {{-- CSS --}}
      @stack('prepend-style')
      @include('includes.style')
      @stack('addon-style')
      
    </head>
  
    <body>
      <!-- Navigation Bar -->
  <nav class="
    navbar navbar-expand-lg navbar-light
    bg-light navbar-store fixed-top navbar-fixed-top " data-aos="fade-down">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand mr-0">
        <img src="/images/logo-onalloid.svg" alt="Logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive" style="margin-right: 200px !important">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item {{ (request()->is('/*')) ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item {{ (request()->is('catalog*')) ? 'active' : '' }}">
            <a href="{{ route('catalog') }}" class="nav-link">Catalog</a>
          </li>
          <li class="nav-item {{ (request()->is('contact*')) ? 'active' : '' }}">
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
    <!-- Page Content -->
    <div class="page-content page-auth">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row justify-content-center align-items-center row-login">
                    <div class="col-lg-5">
                    <h2>
                        Belanja kebutuhan utama,<br />
                        menjadi lebih mudah
                    </h2>
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                            @csrf
                            <div class="form-group">
                            <label>Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required 
                            autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="form-group">
                            <label for="">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <button type="submit" class="btn btn-dark btn-block mt-4">
                            Sign In
                            </button>
                            <a href="{{ route('register') }}" class="btn btn-signup btn-block">
                            Register
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

      
      <!-- Footer -->
      @include('includes.footer')
  
      <!-- JavaScript -->
      @stack('prepend-script')
      @include('includes.script')
      @stack('addon-script')
  
    </body>
  </html>
  