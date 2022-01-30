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

    <title>Admin - Onallo: Wear Better, Look Better.</title>

    {{-- CSS --}}
    @stack('prepend-style')
    @include('includes.style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.4/datatables.min.css"/>
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
                <img src="/images/logo-admin.svg" alt="" class="my-4" />
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin-dashboard') }}" class="list-group-item list-group-item-action
                {{ (request()->is('admin')) ? 'active' : '' }}"
                >Dashboard</a
                >
                <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action 
                {{ (request()->is('admin/category*')) ? 'active' : ''}}"
                >Categories</a
                >
                <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action
                {{ (request()->is('admin/product')) ? 'active' : '' }}">
                Product Catalogue</a>
                <a href="{{ route('product-gallery.index') }}" class="list-group-item list-group-item-action
                {{ (request()->is('admin/product-gallery*')) ? 'active' : '' }}">
                Product Galleries</a>
                <a href="#" class="list-group-item list-group-item-action"
                >Transactions</a
                >
                <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action
                {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                  Users</a>
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
                <li class="nav-item dropdown" 
                    style="box-shadow: 0 0.10rem 1.75rem 0 rgb(58 59 69 / 10%)">
                  <a
                    class="nav-link "
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    style="font-size: 1.15rem;">
                    <img
                      src="/images/user.png"
                      alt=""
                      class="rounded-circle mr-2 profile-picture "/>
                    Hi, {{Auth::user()->name}}!
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home') }}"
                      >Store</a
                    >
                    <a class="dropdown-item " href="{{ route('admin-dashboard') }}"
                    style="display: none"
                      >Dashboard</a
                    >
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
              </ul>
              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none mt-3">
                <li class="nav-item">
                  <a class="nav-link font-weight-bold" href="#"> Hi, {{Auth::user()->name}}! </a>
                </li>
                <li class="nav-item">
                  <a class="dropdown-item " href="{{ route('home') }}">Store</a>
                  <a class="dropdown-item" href="{{ route('admin-dashboard') }}">Dashboard</a>
                  <div class="dropdown-divider"></div>
                  <a class="nav-link d-inline ml-4" href="/">Logout</a>
                </li>
              </ul>
            </div>
          </nav>

          <!-- Section Content -->
          @yield('content')

        </div>
      </div>
    </div>

    <!-- JavaScript -->
    @stack('prepend-script')
    @include('includes.script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.4/datatables.min.js"></script>
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
