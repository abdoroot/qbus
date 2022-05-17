<li class="user-pro"> 
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <img src="{{ asset('images/providers/'.Auth::guard('provider')->user()->provider->image) }}" alt="" class="img-circle">
        <span class="hide-menu">{{ Auth::guard('provider')->user()->username }}</span>
    </a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('provider.profile.index') }}"><i class="ti-user"></i> @lang('msg.profile')</a></li>
        <li><a href="{{ route('provider.profile.index', ['active' => 'account']) }}"><i class="ti-settings"></i> @lang('msg.settings')</a></li>
        <li>
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> @lang('auth.sign_out')
            </a>
            <form id="logout-form" action="{{ route('provider.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>

<li> 
    <a class="waves-effect waves-dark" href="{{ route('provider.home') }}" aria-expanded="false">
        <i class="icon-home"></i>
        <span class="hide-menu">@lang('msg.dashboard') </span>
    </a>
</li>

<li> 
    <a class="waves-effect waves-dark" href="{{ route('provider.calender') }}" aria-expanded="false">
        <i class="icon-calender"></i>
        <span class="hide-menu">@lang('msg.calender') </span>
    </a>
</li>
@if(Auth::guard('provider')->user()->role == 'admin')
<li> 
    <a class="waves-effect waves-dark" href="{{ route('provider.tax_report') }}" aria-expanded="false">
        <i class="icon-chart"></i>
        <span class="hide-menu">@lang('msg.tax_report') </span>
    </a>
</li>
@endif

<li class="nav-small-cap">--- @lang('msg.orders')</li>

<li class="@if(Request::is('provider/busOrders*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.busOrders.index') }}" aria-expanded="false">
        <i class="ti-truck"></i>
        <span class="hide-menu">
            @lang('models/busOrders.plural')
            @if(($menu_busOrders_count = Auth::guard('provider')->user()->provider->busOrders->where('status', 'pending')->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_busOrders_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('provider/tripOrders*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.tripOrders.index') }}" aria-expanded="false">
        <i class="ti-ticket"></i>
        <span class="hide-menu">
            @lang('models/tripOrders.plural')
            @if(($menu_tripOrders_count = Auth::guard('provider')->user()->provider->tripOrders->where('status', 'pending')->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_tripOrders_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('provider/packageOrders*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.packageOrders.index') }}" aria-expanded="false">
        <i class="ti-shopping-cart"></i>
        <span class="hide-menu">
            @lang('models/packageOrders.plural')
            @if(($menu_packageOrders_count = Auth::guard('provider')->user()->provider->packageOrders->where('status', 'pending')->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_packageOrders_count }}</span>
            @endif
        </span>
    </a>
</li>
@if(Auth::guard('provider')->user()->role == 'admin')
<li class="@if(Request::is('provider/reviews*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.reviews.index') }}" aria-expanded="false">
        <i class="ti-star"></i>
        <span class="hide-menu">@lang('models/reviews.plural') </span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.settings')</li>

<li class="@if(Request::is('provider/coupons*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.coupons.index') }}" aria-expanded="false">
        <i class="ti-gift"></i>
        <span class="hide-menu">@lang('models/coupons.plural') </span>
    </a>
</li>

<li class="@if(Request::is('provider/trips*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.trips.index') }}" aria-expanded="false">
        <i class="ti-direction"></i>
        <span class="hide-menu">@lang('models/trips.plural') </span>
    </a>
</li>

<li class="@if(Request::is('provider/packages*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.packages.index') }}" aria-expanded="false">
        <i class="ti-package"></i>
        <span class="hide-menu">@lang('models/packages.plural') </span>
    </a>
</li>

<li class="@if(Request::is('provider/accounts*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.accounts.index') }}" aria-expanded="false">
        <i class="icon-user"></i>
        <span class="hide-menu">
            @lang('models/accounts.plural')
            @if(($menu_accounts_count = Auth::guard('provider')->user()->provider->accounts->where('active', 0)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_accounts_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('provider/buses*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.buses.index') }}" aria-expanded="false">
        <i class="ti-truck"></i>
        <span class="hide-menu">@lang('models/buses.plural')</span>
    </a>
</li>


<li class="@if(Request::is('provider/terminals*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.terminals.index') }}" aria-expanded="false">
        <i class="ti-direction"></i>
        <span class="hide-menu">@lang('models/terminals.plural') </span>
    </a>
</li>


<li class="@if(Request::is('provider/destinations*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.destinations.index') }}" aria-expanded="false">
        <i class="icon-globe"></i>
        <span class="hide-menu">@lang('models/destinations.plural') </span>
    </a>
</li>
@endif

<li class="nav-small-cap">--- @lang('msg.messages')</li>

<li class="@if(Request::is('provider/notifications*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.notifications.index') }}" aria-expanded="false">
        <i class="icon-bell"></i>
        <span class="hide-menu">
            @lang('models/notifications.plural')
            @if(($menu_notifications_count = Auth::guard('provider')->user()->getNotifications(0)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_notifications_count }}</span>
            @endif
        </span>
    </a>
</li>