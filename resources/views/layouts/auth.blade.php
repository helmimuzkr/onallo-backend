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
    @include('includes.navbar')

    <!-- Page Content -->
    @yield('content')
    
    <!-- Footer -->
    @include('includes.footer')

    <!-- JavaScript -->
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

  </body>
</html>
