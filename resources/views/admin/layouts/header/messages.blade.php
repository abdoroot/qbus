<!-- ============================================================== -->
<!-- Messages -->
<!-- ============================================================== -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
        <i class="ti-email"></i>
        @if(App\Models\Contact::where('read_at', null)->count() > 0)
        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
        @endif
    </a>
    <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
        <ul>
            <li>
                <div class="drop-title">{{ trans_choice('you_have_n_new_messages', 5, ['n' => 5]) }}</div>
            </li>
            <li>
                <div class="message-center">
                    @foreach(App\Models\Contact::where('read_at', null)->get() as $contact)
                    <!-- Message -->
                    <a href="{{ route('admin.contacts.show', $contact->id) }}">
                        <div class="mail-contnet">
                            <h5>{{ substr($contact->subject, 0, 20) . (Str::length($contact->subject) > 20 ? ' ..' : '') }}</h5> 
                            <span class="mail-desc">{{ $contact->message }}
                            </span> 
                            <span class="time">{{ Carbon\Carbon::parse($contact->created_at)->format('H:i a') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </li>
            <li>
                <a class="nav-link text-center link" href="{{ route('admin.contacts.index') }}"> <strong>@lang('msg.see_all_messages')</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
        </ul>
    </div>
</li>
<!-- ============================================================== -->
<!-- End Messages -->
<!-- ============================================================== -->