<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(env('APP_FAVICON', 'elite/assets/images/favicon.png')) }}">
    <title>{{ __('msg.app_name') }} | @yield('title')</title>
    
    <link href="{{ asset('elite/assets/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('elite/assets/node_modules/toast-master/css/jquery.toast.css') }}">
    
    @stack('third_party_stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('elite/horizontal/dist/css/style.min.css') }}" rel="stylesheet">
    @if(App::isLocale('ar'))
    <link href="{{ asset('css/vertical-rtl.css') }}" rel="stylesheet">
    @endif
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @stack('page_css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="horizontal-nav skin-megna fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{ __('msg.app_name') }}</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        @include('user.layouts.header')

        @include('user.layouts.sidebar')

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">
                            @if(View::hasSection('page-title'))
                                @yield('page-title')
                            @else
                                @yield('title')
                            @endif
                        </h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('msg.app_name')</a></li>
                                @yield('breadcrumb')
                            </ol>
                            @yield('top-buttons')
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                @yield('content')
                
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

        @include('user.layouts.footer')
        
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('elite/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('elite/horizontal/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('elite/horizontal/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('elite/horizontal/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>

    @stack('third_party_scripts')

    <!--Custom JavaScript -->
    <script src="{{ asset('elite/horizontal/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @stack('page_scripts')
</body>
</html>
