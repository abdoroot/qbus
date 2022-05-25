<div class="row">
    <div class="col-md-12">
        <div class="float-left">
            <address>
                @if(!is_null($provider = $tripOrder->provider))
                <h3>
                    <a href="{{ route('admin.providers.show', $provider->id) }}">
                        <b class="text-danger">{{ $provider->name }}</b>
                    </a>
                </h3>
                <p class="text-muted m-l-5"><i class="icon-location-pin"></i> {{ $provider->address }},
                    <br/><i class="icon-envelope"></i> {{ $provider->email }}
                    <br/><i class="icon-phone"></i> {{ $provider->phone }}
                    <br/> <hr>
                </p>
                @endif
            </address>
        </div>
        <div class="float-right text-right">
            <address>
                @if(!is_null($user = $tripOrder->user))
                <h4>
                    <a href="{{ route('admin.users.show', $user->id) }}">
                        <i class="icon-user"></i> {{ $user->name }}
                    </a>
                </h4>
                <h6><i class="icon-phone"></i> {{ $user->phone }}</h4>
                <p class="text-muted m-l-30"><i class="icon-envelope"></i> {!! $user->email !!}</p>
                @endif
            </address>
        </div>
    </div>
    <div class="col-sm-12 mt-5">
        @if(!is_null($trip = $tripOrder->trip))
        <h4>
            <a href="{{ route('admin.trips.show', $trip->id) }}">
                <i class="ti-direction"></i> @lang('models/tripOrders.fields.trip_id') {{ '#' . $trip->id }}
            </a>
        </h4>
        <h5><i class="icon-calender"></i> {{ $trip->date_from }} {{ $trip->date_from !=  $trip->date_to ? ' - ' .  $trip->date_to : '' }}</h5>
        <h5><i class="icon-clock"></i> {{ $trip->time_from }} - {{ $trip->time_to }}</h5>
        <h4 class="text-muted">@lang('models/trips.fields.destination_id') : 
            @if(!is_null($destination = $trip->destination))
            <a href="{{ route('admin.destinations.show', $destination->id) }}">{{ $destination->name }}</a>
            @endif
        </h4>
        @endif
        <h4 class="mt-3">{!! $tripOrder->status_span !!}</h4>
        <h5>
            {{ __('models/tripOrders.types.'.$tripOrder->type) }}
        </h5>
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
                    @foreach($tripOrder->tickets as $ticket)
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
        <small class="text-muted"> @lang('models/tripOrders.fields.count') :</small>
        <p>{{ $tripOrder->count ?? '-' }}</p>
        @if(!empty($additionals = $tripOrder->additionals()))
        <small class="text-muted">@lang('models/trips.fields.additional') </small>
        @foreach($additionals as $additional)
        <p>
            <b>@if(!is_null($addition = $additional['additional'])) {{ $addition->name }} @else {{ $additional['id'] }} @endif : </b> 
            <span class="d-block pl-3 pr-3">@lang('models/tripOrders.fields.count') : {{ $additional['count'] }}</span>
            <span class="d-block pl-3 pr-3">@lang('models/tripOrders.fields.fees') : {{ $additional['fees'] }}</span>
        </p>
        @endforeach
        @endif
        <small class="text-muted"> @lang('models/tripOrders.fields.user_notes') :</small>
        <p>{{ $tripOrder->user_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/tripOrders.fields.provider_notes') :</small>
        <p>{{ $tripOrder->provider_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/tripOrders.fields.admin_notes') :</small>
        <p>{{ $tripOrder->admin_notes ?? '-' }}</p>
        <small class="text-muted"> @lang('models/tripOrders.fields.created_at') :</small>
        <p>{{ Carbon\Carbon::parse($tripOrder->created_at)->format('Y-m-d') }}</p>
    </div>
    <hr class="col-sm-12" />
    <div class="col-md-12">
        <div class="float-right m-t-30 text-right">
            <p>@lang('models/tripOrders.fields.fees'): {{ $tripOrder->fees }}</p>
            <p>@lang('models/tripOrders.fields.tax') : {{ $tripOrder->tax }} </p>
            @if(!is_null($tripOrder->additionalFees))
            <p>@lang('models/tripOrders.fields.additional') : {{ $tripOrder->additionalFees }} </p>
            @endif
            @if(!is_null($coupon = $tripOrder->coupon))
            <p>@lang('models/tripOrders.fields.coupon_id') : 
                <a href="{{ route('admin.coupons.show', $coupon->id) }}">
                    {{ $coupon->name }}
                </a>
                ( {{ $tripOrder->discount }} )
            </p>
            @endif
            <hr>
            <h3><b>@lang('models/tripOrders.fields.total') :</b> {{ $tripOrder->total }}</h3>
        </div>
    </div>
</div>