{{-- <!-- Name Field -->
<tr>
    <td colspan="2">
        <div class="row">
            <div class="col-md-4"><img src="{{ asset('images/trips/'.$trip->image) }}" alt="" 
                style="width: 100%;
                    height: auto;
                    max-height: initial;" /></div>
            <div class="col-md-8 pt-3">
                <p><span class="card-title">@lang('models/trips.fields.name') : </span> {{ $trip->name }} </p>
                <p><span class="card-title">@lang('models/trips.fields.description') : </span> {{ $trip->description }} </p>
                <p><i class="icon-calender"></i> {{ $trip->date_from . ($trip->date_from != $trip->date_to ? ' - ' . $trip->date_to : '') }} </p>
                <p><i class="icon-clock"></i> {{ $trip->time_from . ' - ' . $trip->time_to }}</p>
                <p><i class="icon-star"></i> {{ $trip->rate }}</p>
            </div>
        </div>
    </td>
</tr>

<!-- Program Field -->
<tr>
    <td colspan="2">
        <div class="row">
            <div class="col-md-12">
                <h5 class="card-title">@lang('models/trips.destination')</h5>
                <h6 class="card-subtitle">@lang('models/trips.fields.type') : {{ __('models/trips.types.'.$trip->type) }}</h6>
                <ul class="timeline">
                    @foreach($trip->tripCities as $program)
                    @if(!is_null($city = $program->city))
                    <li>
                        <a href="javascript:void(0)" class="link">{{ $city->name }}</a> 
                        <p>{{ $program->description }}</p>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12">
                <h5 class="card-title">@lang('models/trips.location')</h5>
                <div class="map-box pl-5">
                    <iframe width="100%" height="200" frameborder="0" style="border:0" allowfullscreen
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"></iframe>
                </div>
            </div>
        </div>
    </td>
</tr> --}}

<!-- Destination Id Field -->
<tr>
    <th>@lang('models/trips.fields.destination_id')</th>
    <td>
        @if(!is_null($destination = $trip->destination))
        <a href="{{ route('provider.destinations.show', $trip->destination_id) }}">{{ $destination->name }}</a>
        @endif
    </td>
</tr>

<!-- Date From Field -->
<tr>
    <th>@lang('models/trips.fields.date_from')</th>
    <td>{{ $trip->date_from }}</td>
</tr>

<!-- Date To Field -->
<tr>
    <th>@lang('models/trips.fields.date_to')</th>
    <td>{{ $trip->date_to }}</td>
</tr>

<!-- Time From Field -->
<tr>
    <th>@lang('models/trips.fields.time_from')</th>
    <td>{{ $trip->time_from }}</td>
</tr>

<!-- Time From Field -->
<tr>
    <th>@lang('models/trips.fields.time_to')</th>
    <td>{{ $trip->time_to }}</td>
</tr>

<!-- Bus Id Field -->
<tr>
    <th>@lang('models/trips.fields.bus_id')</th>
    <td>
        @if(!is_null($bus = $trip->bus))
        <a href="{{ route('provider.buses.show', $trip->bus_id) }}">{{ $bus->plate }}</a>
        @endif
    </td>
</tr>

<!-- Fees Field -->
<tr>
    <th>@lang('models/trips.fields.fees')</th>
    <td>{{ $trip->fees }}</td>
</tr>

<!-- Max Field -->
<tr>
    <th>@lang('models/trips.fields.max')</th>
    <td>{{ $trip->max }} <span class="text-success">({{ $trip->tickets()->count() }} @lang('models/tickets.plural') @lang('msg.taken'))</span></td>
</tr>

<!-- Description Field -->
<tr>
    <th>@lang('models/trips.fields.description')</th>
    <td>{{ $trip->description }}</td>
</tr>

{{-- <!-- Provider Notes Field -->
<tr>
    <th>@lang('models/trips.fields.provider_notes')</th>
    <td>{{ $trip->provider_notes }}</td>
</tr> --}}

<!-- Auto Approve Field -->
<tr>
    <th>@lang('models/trips.fields.auto_approve')</th>
    <td>{!! $trip->auto_approve_span !!}</td>
</tr>

<!-- Additionals Field -->
<tr>
    <th>@lang('models/trips.fields.additional')</th>
    <td>
        <ul class="list-style-none">
            @foreach($trip->additionals() as $row)
            <li><i class="fas fa-check text-success"></i> {{ $row['additional']->name }}  ({{ $row['fees'] }})</li>
            @endforeach
        </ul>
    </td>
</tr>

<!-- Rate Field -->
<tr>
    <th>@lang('models/trips.fields.rate')</th>
    <td>{{ $trip->rate }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/trips.fields.created_at')</th>
    <td>{{  $trip->created_at  }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/trips.fields.updated_at')</th>
    <td>{{  $trip->updated_at  }}</td>
</tr>