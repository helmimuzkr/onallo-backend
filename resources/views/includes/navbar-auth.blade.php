<nav
class="
  navbar navbar-expand-lg navbar-light
  bg-light
  navbar-store
  fixed-top
  navbar-fixed-top 
"
data-aos="fade-down"
>
<div class="container">
  <a href="{{ route('home') }}" class="navbar-brand">
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
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('catalog') }}" class="nav-link">Catalog</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
      </li>
    </ul>
    <a
    href="{{-- {{ route('login') }} --}}"
    class="btn btn-dark nav-link px-4 text-white ml-auto"
    >Login
  </a>
  </div>
</div>
</nav>