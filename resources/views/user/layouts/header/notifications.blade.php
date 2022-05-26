{{-- <!-- ============================================================== -->
<!-- Notification -->
<!-- ============================================================== -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
        <i class="ti-bell"></i>
        @if(($notifs = Auth::user()->getNotifications(0))->count() > 0)
        <div class="notify warning"> <span class="heartbit"></span> <span class="point"></span> </div>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
        <ul>
            <li>
                <div class="drop-title">@lang('models/notifications.plural')</div>
            </li>
            <li>
                <div class="message-center">
                    @foreach($notifs->get() as $notif)
                    <!-- Message -->
                    <a href="{{ route('notifications.show', $notif->id) }}">
                        <div class="btn btn-{{ $notif->type }} btn-circle"><i class="{{ $notif->icon }}"></i></div>
                        <div class="mail-contnet">
                            <h5>{{ $notif->title }}</h5> <span class="mail-desc">{!! $notif->text !!}</span> <span class="time">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($notif->created_at))->diffForHumans() }}</span> </div>
                    </a>
                    @endforeach
                </div>
            </li>
            <li>
                <a class="nav-link text-center link" href="{{ route('notifications.index') }}"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
        </ul>
    </div>
</li>
<!-- ============================================================== -->
<!-- End Notification -->
<!-- ============================================================== --> --}}