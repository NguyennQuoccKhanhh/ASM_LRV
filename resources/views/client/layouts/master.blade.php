<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> @yield('title') - Website Tin Tức </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('client.layouts.partials.css')
</head>

<body>
    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        @include('client.layouts.partials.navbar-top')
        @include('client.layouts.partials.navbar-menu')

    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        @include('client.layouts.partials.search-by-keyword')
    </div>
    <!-- Modal Search End -->
    @yield('content')
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        @include('client.layouts.partials.footer')
    </div>
    <!-- Footer End -->
    <!-- JavaScript Libraries -->
    @include('client.layouts.partials.js')
</body>

</html>
