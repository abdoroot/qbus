<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('design/assets/css/framework/tailwind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/assets/css/framework/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/assets/css/framework/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/assets/css/style.css') }}">
    <title> {{ __('msg.app_name') }} |  @yield('title') </title>
    @yield('page-styles')
</head>

<body class="overflow-x-hidden">
    <div id="@yield('id')">
        @include('guest.layouts.nav')
        
        @yield('content')
        
        @include('guest.layouts.footer')
    </div>
    <script src="{{  asset('design/assets/js/jquery.min.js') }}"> </script>
    <script src="{{  asset('design/assets/js/slick.min.js') }}"> </script>
    <script src="{{  asset('design/assets/js/index.js') }}"> </script>

    @yield('page-scripts')
</body>

</html>