{{-- Navbar --}}
@guest
  <nav class="
    navbar navbar-expand-lg navbar-light
    bg-white navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand mr-0">
        <img src="/images/logo-onalloid.svg" alt="Logo" />
      </a>
      <button
        class="navbar-toggler mt-2"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
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
        <a
        href="{{ route('login') }}"
        class="btn btn-dark nav-link px-5 text-white"
        >Login
        </a>
      </div>
    </div>
  </nav>
@endguest

{{-- Navbar AUTH --}}
@auth
  <nav class="
  navbar navbar-expand-lg navbar-light
  bg-white navbar-store fixed-top navbar-fixed-top py-2" data-aos="fade-down">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand mr-5">
        <img src="/images/logo-onalloid.svg" alt="Logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
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
        <ul class="navbar-nav d-none d-none d-lg-flex">
          <li class="nav-item dropdown">
            <a
              href="#"
              class="nav-link px-0 mx-0"
              id="navbarDropdown"
              data-toggle="dropdown"
              role="button"
              >
              <img
                src="/images/user.png"
                alt=""
                class="rounded-circle mr-2 profile-picture"
                />Hi, {{ Auth::user()->name }}!
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('dashboard-transaction') }}" class="dropdown-item">Transaction</a>
              <a href="{{ route('dashboard-account') }}" class="dropdown-item">Settings</a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault(); 
                  document.getElementById('logout-form').submit();"  
                  class="dropdown-item"
                  >Logout
              </a>
              <form id="logout-form" 
                    action="{{ route('logout') }}" 
                    method="POST" 
                    style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
          <li class="nav-item">
            <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
              @php
                  $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
              @endphp
              @if ($carts > 0)
                <img src="/images/cart.svg" alt="cart" />
                <div class="card-badge">{{ $carts }}</div>
              @else
                <img src="/images/cart.svg" alt="cart" />
              @endif
            </a>
          </li>
        </ul>

        <!-- Mobile Menu -->
        <ul class="navbar-nav d-block d-lg-none">
          <li class="nav-item">
            <a href="#" class="nav-link font-weight-bold">Hi, {{ Auth::user()->name }}</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('dashboard-transaction') }}" class="nav-link d-inline-block">Transaction
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('dashboard-account') }}" class="nav-link d-inline-block">Settings</a>
          </li>
          <li class="navbar-item">
            <a href="{{ route('cart') }}" class="nav-link d-inline-block">Cart</a>
          </li>
          <li class="navbar-item">
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
@endauth