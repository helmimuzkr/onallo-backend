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

    <title>Dashboard - Onallo: Wear Better, Look Better.</title>

    {{-- CSS --}}
    @stack('prepend-style')
    @include('includes.style')
    @method('addon-style')

  </head>

  <body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <div class="page-dashboard">
      <div
        class="d-flex aos-init aos-animate"
        id="wrapper"
        data-aos="fade-right"
      >
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/sidebar-logo-onaloid.svg" alt="" class="my-4" />
          </div>
          <div class="list-group list-group-flush">
            <a
              href="{{ route('dashboard') }}"
              class="list-group-item list-group-item-action"
              style="display: none"
              >Dashboard</a
            >
            <a
              href="{{ route('dashboard-transaction') }}"
              class="list-group-item list-group-item-action
              {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }}"
              >My Transactions</a
            >
            
            <a
              href="{{ route('dashboard-account') }}"
              class="list-group-item list-group-item-action
              {{ (request()->is('dashboard/account')) ? 'active' : '' }}"
              >My Account</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();"  
                class="list-group-item list-group-item-action"
                >Logout
            </a>
            <form id="logout-form" 
                  action="{{ route('logout') }}" 
                  method="POST" 
                  style="display: none;">
            @csrf
            </form>
          </div>
        </div>
        <!-- #Sidebar -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <!-- navbar -->
          <nav
            class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
            <button
              class="btn btn-secondary d-md-none mr-auto mr-2"
              id="menu-toggle"
            >
              &laquo; Menu
            </button>

            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-capitalize" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown">
                  <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <img
                      src="/images/user.png"
                      alt=""
                      class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{Auth::user()->name}}!
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="{{ route('home') }}" class="dropdown-item">Back To Store</a>
                    <a href="{{ route('cart') }}" class="dropdown-item">Cart</a>
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
              <ul class="navbar-nav d-block d-lg-none mt-3">
                <li class="nav-item">
                  <a class="nav-link" href="#"> Hi, Angga </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('dashboard') }}" class="dropdown-item">Transaction</a>
                  <a href="{{ route('dashboard-account') }}" class="dropdown-item">Settings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block" href="#"> Cart </a>
                </li>
              </ul>
            </div>
          </nav>

          <!-- Section Content -->
          @yield('content')

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    @include('includes.script')
    <!-- script toggle -->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
  </body>
</html>
