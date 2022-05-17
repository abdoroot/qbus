<div class="row">
    <div class="col-md-12">
        <div class="float-left">
            <address>
                @if(!is_null($provider = $packageOrder->provider))
                <h3>
                    <b class="text-danger">{{ $provider->name }}</b>
                </h3>
                <p class="text-muted m-l-5">{{ $provider->address }},
                    <br/><i class="icon-envelope"></i> {{ $provider->email }}
                    <br/><i class="icon-phone"></i> {{ $provider->phone }}
                    <br/> <hr>
                </p>
                @endif
            </address>
        </div>
        <div class="float-right text-right">
            <address>
                @if(!is_null($user = $packageOrder->user))    
                @include('provider.reviews.user_modal') 
                <h4>
                    <a href="javascript:;" data-toggle="modal" data-target="#user-modal">
                        <i class="icon-user"></i> {{ $user->name }}
                    </a>
                </h4>
                <h6><i class="icon-phone"></i> {{ $user->phone }}</h4>
                <p class="text-muted m-l-30">{!! $user->email !!}</p>
                @endif
            </address>
        </div>
    </div>
    <div class="col-sm-12 mt-5">
        @if(!is_null($package = $packageOrder->package))
        <h4>
            <a href="{{ route('provider.packages.show', $package->id) }}">
                <i class="ti-package"></i> {{ $package->name }}
            </a>
        </h4>
        <h5><i class="icon-calender"></i> {{ $package->date_from }}</h5>
        <h5><i class="icon-clock"></i> {{ $package->time_from }}</h5>
        <h4 class="text-muted">@lang('models/packages.fields.destinations') : 
            <ul class="timeline">
                @foreach($package->packageDestinations() as $destination)
                <a href="{{ route('provider.destinations.show', $destination->id) }}">{{ $destination->name }}</a>
                @endforeach
            </ul>
        </h4>
        <p>{{ $package->description }}</p>
        @endif
        <h4 class="mt-3">{!! $packageOrder->status_span !!}</h4>
    </div>
    <div class="col-md-6">
        <div class="table-responsive m-t-40" style="clear: both;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@lang('models/tickets.singular') #</th>
                        <th>@lang('models/tickets.fields.seat_num')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packageOrder->tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->seat_num }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-12">
        <small class="text-muted"> @lang('models/packageOrders.fields.user_notes') :</small>
        <p>{{ $packageOrder->user_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/packageOrders.fields.provider_notes') :</small>
        <p>{{ $packageOrder->provider_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/packageOrders.fields.created_at') :</small>
        <p>{{ Carbon\Carbon::parse($packageOrder->created_at)->format('Y-m-d') }}</p>
    </div>
    <hr class="col-sm-12" />
    <div class="col-md-12">
        <div class="float-right m-t-30 text-right">
            <p>@lang('models/packageOrders.fields.fees'): {{ $packageOrder->fees }}</p>
            <p>@lang('models/packageOrders.fields.tax') : {{ $packageOrder->tax }} </p>
            @if(!is_null($coupon = $packageOrder->coupon))
            <p>@lang('models/packageOrders.fields.coupon_id') : 
                <a href="{{ route('provider.coupons.show', $coupon->id) }}">
                    {{ $coupon->name }}
                </a>
                ( {{ $packageOrder->discount }} )
            </p>
            @endif
            <hr>
            <h3><b>@lang('models/packageOrders.fields.total') :</b> {{ $packageOrder->total }}</h3>
        </div>
    </div>
</div>