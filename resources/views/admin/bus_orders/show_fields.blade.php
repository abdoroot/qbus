<div class="row">
    <div class="col-md-12">
        <div class="float-left">
            <address>
                @if(!is_null($provider = $busOrder->provider))
                <h3>
                    <a href="{{ route('admin.providers.show', $provider->id) }}">
                        <b class="text-danger">{{ $provider->name }}</b>
                    </a>
                </h3>
                <p class="text-muted m-l-5">{{ $provider->address }},
                    <br/><i class="icon-envelope"></i> {{ $provider->email }}
                    <br/><i class="icon-phone"></i> {{ $provider->phone }}
                    <br/> <hr>
                    @if(!is_null($bus = $busOrder->bus))
                    <a href="{{ route('admin.buses.show', $bus->id) }}" >
                        <i class="ti-truck"></i> {{ $bus->plate }}
                    </a>
                    @else - @endif
                </p>
                @endif
            </address>
        </div>
        <div class="float-right text-right">
            <address>
                @if(!is_null($user = $busOrder->user))
                <h4>
                    <a href="{{ route('admin.users.show', $user->id) }}">
                        <i class="icon-user"></i> {{ $user->name }}
                    </a>
                </h4>
                <h6><i class="icon-phone"></i> {{ $user->phone }}</h4>
                <p class="text-muted m-l-30">{!! $user->email !!}</p>
                @endif
            </address>
        </div>
    </div>
    <div class="col-sm-4">
        <h4>@lang('models/busOrders.datetime')</h4>
        <h5><i class="icon-calender"></i> {{ $busOrder->date_from }} {{  $busOrder->date_from !=  $busOrder->date_to ? ' - ' .  $busOrder->date_to : '' }}</h5>
        <h5><i class="icon-clock"></i> {{ $busOrder->time_from }} - {{ $busOrder->time_to }}</h5>
        <h4>{!! $busOrder->status_span !!}</h4>
        <h4 class="text-muted">@lang('models/busOrders.destination') :</h4>
        <h5>
            <ul class="timeline pl-0">
                @foreach($busOrder->destinationCities() as $city)
                <li>
                    <a href="javascript:void(0)" class="link">{{ $city->name }}</a> 
                </li>
                @endforeach
            </ul>
        </h5>
    </div>
    <div class="col-sm-8">
        <div class="map-box">
            <iframe width="100%" height="200" frameborder="0" style="border:0" allowfullscreen
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"></iframe>
        </div>
    </div>
    <hr class="col-sm-12" />
    <div class="col-sm-12">
        <small class="text-muted"> @lang('models/busOrders.fields.user_notes') :</small>
        <p>{{ $busOrder->user_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/busOrders.fields.provider_notes') :</small>
        <p>{{ $busOrder->provider_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/busOrders.fields.admin_notes') :</small>
        <p>{{ $busOrder->admin_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/busOrders.fields.created_at') :</small>
        <p>{{ Carbon\Carbon::parse($busOrder->created_at)->format('Y-m-d') }}</p>
    </div>
    <hr class="col-sm-12" />
    <div class="col-md-12">
        <div class="float-right m-t-30 text-right">
            <p>@lang('models/busOrders.fields.fees'): {{ $busOrder->fees }}</p>
            <p>@lang('models/busOrders.fields.tax') : {{ $busOrder->tax }} </p>
            <hr>
            <h3><b>@lang('models/busOrders.fields.total') :</b> {{ $busOrder->total }}</h3>
        </div>
    </div>
</div>