<!-- ============================================================== -->
<!-- Logo -->
<!-- ============================================================== -->
<div class="navbar-header">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <!-- Logo icon --><b>
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img src="{{ $app_logo }}" alt="@lang('msg.app_name')" class="dark-logo" />
            <!-- Light Logo icon -->
            <img src="{{ $app_logo_light }}" alt="@lang('msg.app_name')" class="light-logo" />
        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="hidden-sm-down"> @lang('msg.app_name')
        </span>
    </a>
</div>
<!-- ============================================================== -->
<!-- End Logo -->
<!-- ============================================================== -->