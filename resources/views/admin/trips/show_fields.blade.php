<!-- Provider Id Field -->
<tr>
    <th>@lang('models/trips.fields.provider_id')</th>
    <td>
        @if(!is_null($provider = $trip->provider))
        <a href="{{ route('admin.providers.show', $trip->provider_id) }}">{{ $provider->name }}</a>
        @endif
    </td>
</tr>

<!-- Destination Id Field -->
<tr>
    <th>@lang('models/trips.fields.destination_id')</th>
    <td>
        @if(!is_null($destination = $trip->destination))
        <a href="{{ route('admin.destinations.show', $trip->destination_id) }}">{{ $destination->name }}</a>
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
        <a href="{{ route('admin.buses.show', $trip->bus_id) }}">{{ $bus->plate }}</a>
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