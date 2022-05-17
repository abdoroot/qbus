<li class="user-pro"> 
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <img src="{{ asset('elite/assets/images/users/1.jpg') }}" alt="user-img" class="img-circle"><span class="hide-menu">Mark Jeckson</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('profile.index') }}"><i class="ti-user"></i> @lang('msg.profile')</a></li>
        <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
        <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
        <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
        <li>
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> @lang('auth.sign_out')
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
<li> 
    <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false">
        <i class="icon-speedometer"></i>
        <span class="hide-menu">@lang('msg.dashboard') <span class="badge badge-pill badge-cyan ml-auto">4</span></span>
    </a>
</li>
<li> 
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <i class="icon-cart"></i>
        <span class="hide-menu">
            @lang('models/busOrders.plural') 
            @if(Auth::check() && (($menuCount = Auth::user()->busOrders->where('status', 'approved')->count()) > 0))
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menuCount }}</span>
            @endif
        </span>
    </a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('busOrders.index') }}">@lang('models/busOrders.plural')  </a></li>
        <li><a href="{{ route('busOrders.create') }}">@lang('crud.add_new')</a></li>
    </ul>
</li>
