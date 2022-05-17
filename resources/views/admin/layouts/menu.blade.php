<li class="user-pro"> 
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <i class="mdi mdi-account-circle p-l-5" style="font-size: 20px;"></i>
        <span class="hide-menu">{{ Auth::guard('admin')->user()->name }}</span>
    </a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.profile.index') }}"><i class="ti-user"></i> @lang('msg.profile')</a></li>
        <li><a href="{{ route('admin.profile.index', ['active' => 'settings']) }}"><i class="ti-settings"></i> @lang('msg.settings')</a></li>
        <li>
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> @lang('auth.sign_out')
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
<li> 
    <a class="waves-effect waves-dark" href="{{ route('admin.home') }}" aria-expanded="false">
        <i class="icon-home"></i>
        <span class="hide-menu"> @lang('msg.dashboard') </span>
    </a>
</li>

<li> 
    <a class="waves-effect waves-dark" href="{{ route('admin.calender') }}" aria-expanded="false">
        <i class="icon-calender"></i>
        <span class="hide-menu">@lang('msg.calender') </span>
    </a>
</li>

<li> 
    <a class="waves-effect waves-dark" href="{{ route('admin.tax_report') }}" aria-expanded="false">
        <i class="icon-chart"></i>
        <span class="hide-menu">@lang('msg.tax_report') </span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.app_users')</li>
<li class="@if(Request::is('admin/admins*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.admins.index') }}" aria-expanded="false">
        <i class="ti-shield"></i>
        <span class="hide-menu"> @lang('models/admins.plural')</span>
    </a>
</li>

<li> 
    <a class="has-arrow waves-effect waves-dark @if($menuActive = (
            Request::is('admin/providers*') || 
            Request::is('admin/accounts*') || 
            Request::is('admin/buses*') || 
            Request::is('admin/destinations*') || 
            Request::is('admin/trips*') || 
            Request::is('admin/packages*') || 
            Request::is('admin/terminals*'))) active @endif" href="javascript:void(0)" aria-expanded="false">
        <i class="icon-user"></i>
        <span class="hide-menu">
            @lang('models/providers.plural') 
            @if(($menu_providers_count = App\Models\Provider::where('approve', 0)->count()) > 0)
            <span class="badge badge-pill badge-warning ml-auto">{{ $menu_providers_count }}</span>
            @endif
        </span>
    </a>
    <ul aria-expanded="false" class="collapse @if($menuActive) in @endif">
        <li><a href="{{ route('admin.providers.index') }}" class="@if(Request::is('admin/providers*')) active @endif">@lang('models/providers.plural') </a></li>
        <li><a href="{{ route('admin.accounts.index') }}" class="@if(Request::is('admin/accounts*')) active @endif">@lang('models/accounts.plural') </a></li>
        <li><a href="{{ route('admin.buses.index') }}" class="@if(Request::is('admin/buses*')) active @endif">@lang('models/buses.plural') </a></li>
        <li><a href="{{ route('admin.destinations.index') }}" class="@if(Request::is('admin/destinations*')) active @endif">@lang('models/destinations.plural') </a></li>
        <li><a href="{{ route('admin.trips.index') }}" class="@if(Request::is('admin/trips*')) active @endif">@lang('models/trips.plural') </a></li>
        <li><a href="{{ route('admin.packages.index') }}" class="@if(Request::is('admin/packages*')) active @endif">@lang('models/packages.plural') </a></li>
        <li><a href="{{ route('admin.terminals.index') }}" class="@if(Request::is('admin/terminals*')) active @endif">@lang('models/terminals.plural') </a></li>
    </ul>
</li>

<li class="@if(Request::is('admin/users*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.users.index') }}" aria-expanded="false">
        <i class="icon-people"></i>
        <span class="hide-menu"> @lang('models/users.plural')</span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.orders')</li>

<li class="@if(Request::is('admin/busOrders*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.busOrders.index') }}" aria-expanded="false">
        <i class="ti-truck"></i>
        <span class="hide-menu">@lang('models/busOrders.plural')</span>
    </a>
</li>

<li class="@if(Request::is('admin/tripOrders*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.tripOrders.index') }}" aria-expanded="false">
        <i class="ti-ticket"></i>
        <span class="hide-menu">@lang('models/tripOrders.plural')</span>
    </a>
</li>

<li class="@if(Request::is('admin/packageOrders*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.packageOrders.index') }}" aria-expanded="false">
        <i class="ti-shopping-cart"></i>
        <span class="hide-menu">@lang('models/packageOrders.plural')</span>
    </a>
</li>

<li class="@if(Request::is('admin/coupons*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.coupons.index') }}" aria-expanded="false">
        <i class="ti-star"></i>
        <span class="hide-menu">
            @lang('models/coupons.plural')
            @if(($menu_coupons_count = App\Models\Coupon::where('status', 'pending')->count()) > 0)
            <span class="badge badge-pill badge-primary ml-auto">{{ $menu_coupons_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('admin/reviews*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.reviews.index') }}" aria-expanded="false">
        <i class="ti-star"></i>
        <span class="hide-menu">@lang('models/reviews.plural')</span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.messages')</li>

<li class="@if(Request::is('admin/notifications*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.notifications.index') }}" aria-expanded="false">
        <i class="icon-bell"></i>
        <span class="hide-menu"> 
            @lang('models/notifications.plural')
            @if(($menu_notifications_count = Auth::guard('admin')->user()->getNotifications(0)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_notifications_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('admin/contacts*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.contacts.index') }}" aria-expanded="false">
        <i class="icon-envelope"></i>
        <span class="hide-menu"> 
            @lang('models/contacts.plural')
            @if(($menu_contacts_count = App\Models\Contact::where('read_at', null)->count()) > 0)
            <span class="badge badge-pill badge-primary ml-auto">{{ $menu_contacts_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.settings')</li>

<li class="@if(Request::is('admin/translation*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.translation') }}" aria-expanded="false">
        <i class="icon-globe"></i>
        <span class="hide-menu">@lang('msg.translation')</span>
    </a>
</li>

<li> 
    <a class="has-arrow waves-effect waves-dark @if($menuActive = (
            Request::is('admin/settings*') || 
            Request::is('admin/cities*') || 
            Request::is('admin/categories*') || 
            Request::is('admin/features*') || 
            Request::is('admin/services*') || 
            Request::is('admin/emails*') || 
            Request::is('admin/additionals*'))) active @endif" href="javascript:void(0)" aria-expanded="false">
        <i class="icon-settings"></i>
        <span class="hide-menu">@lang('msg.settings') </span>
    </a>
    <ul aria-expanded="false" class="collapse @if($menuActive) in @endif">
        <li><a href="{{ route('admin.settings.index') }}" class="@if(Request::is('admin/settings*')) active @endif">@lang('models/settings.plural') </a></li>
        <li><a href="{{ route('admin.cities.index') }}" class="@if(Request::is('admin/cities*')) active @endif">@lang('models/cities.plural') </a></li>
        {{-- <li><a href="{{ route('admin.categories.index') }}" class="@if(Request::is('admin/categories*')) active @endif">@lang('models/categories.plural') </a></li> --}}
        <li><a href="{{ route('admin.features.index') }}" class="@if(Request::is('admin/features*')) active @endif">@lang('models/features.plural') </a></li>
        <li><a href="{{ route('admin.services.index') }}" class="@if(Request::is('admin/services*')) active @endif">@lang('models/services.plural') </a></li>
        <li><a href="{{ route('admin.emails.index') }}" class="@if(Request::is('admin/emails*')) active @endif">@lang('models/emails.plural') </a></li>
        <li><a href="{{ route('admin.additionals.index') }}" class="@if(Request::is('admin/additionals*')) active @endif">@lang('models/additionals.plural') </a></li>
    </ul>
</li>

