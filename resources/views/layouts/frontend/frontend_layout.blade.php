<!doctype html>
<html lang="en">
    <head>
        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}
        {!! JsonLd::generate() !!}

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ getenv('APP_NAME') }}</title>

        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="css/bootstrap.min.css"> --}}

        <!-- Font Awesome -->
        <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />

        {{-- Swipper CSS --}}
        <link rel="stylesheet" href="{{ url('/frontend_page/css/swipper.min.css') }}">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ url('frontend_page/css/style.css') }}">

        {{-- BOXICONS --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- ANIMATE ON SCROLL --}}
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        
    </head>
    <body>
        
        <!-- Navigation Bar -->
        @include('layouts.frontend.frontend_header')

        @yield('content')

        {{-- FOOTER --}}
        @include('layouts.frontend.frontend_footer')

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="{{ url('/frontend_page/js/script.js') }}"></script>
        <script src="{{ url('/frontend_page/js/swiper-bundle.min.js') }}"></script>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        @stack('frontend_scripts')
    </body>
</html>