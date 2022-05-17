<!-- Name Field -->
<tr>
    <th>@lang('models/destinations.fields.name')</th>
    <td>{{ $destination->name }}</td>
</tr>

<!-- From City Id Field -->
<tr>
    <th>@lang('models/destinations.fields.from_city_id')</th>
    <td>
        @if(!is_null($fromCity = $destination->fromCity)) {{ $fromCity->name }} @endif
    </td>
</tr>

<!-- To City Id Field -->
<tr>
    <th>@lang('models/destinations.fields.to_city_id')</th>
    <td>
        @if(!is_null($toCity = $destination->toCity)) {{ $toCity->name }} @endif
    </td>
</tr>

<!-- Starting Terminal Id Field -->
<tr>
    <th>@lang('models/destinations.fields.starting_terminal_id')</th>
    <td>
        @if(!is_null($startingTerminal = $destination->startingTerminal))
        <a href="{{ route('provider.terminals.show', $startingTerminal->id) }}">{{ $startingTerminal->name }}</a>
        @endif
    </td>
</tr>

<tr>
    <th>@lang('models/destinations.fields.stops')</th>
    <td>
        <ul>
            @foreach($destination->stopTerminals() as $stopTerminal)
            <li>
                <a href="{{ route('provider.terminals.show', $stopTerminal->id) }}" class="text-primary">{{ $stopTerminal->name }}</a> 
            </li>
            @endforeach
        </ul>
    </td>
</tr>

<!-- Arrival Terminal Id Field -->
<tr>
    <th>@lang('models/destinations.fields.arrival_terminal_id')</th>
    <td>
        @if(!is_null($arrivalTerminal = $destination->arrivalTerminal))
        <a href="{{ route('provider.terminals.show', $arrivalTerminal->id) }}">{{ $arrivalTerminal->name }}</a>
        @endif
    </td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/destinations.fields.created_at')</th>
    <td>{{ $destination->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/destinations.fields.updated_at')</th>
    <td>{{ $destination->updated_at }}</td>
</tr>

