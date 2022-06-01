<!-- Plate Field -->
<tr>
    <th>@lang('models/buses.fields.plate')</th>
    <td>{{ $bus->plate }}</td>
</tr>

<!-- Image Field -->
<tr>
    <th>@lang('models/buses.fields.image')</th>
    <td><img src="{{ asset('images/buses/'.$bus->image) }}" /></td>
</tr>

<!-- Passengers Field -->
<tr>
    <th>@lang('models/buses.fields.passengers')</th>
    <td>{{ $bus->passengers }}</td>
</tr>

<!-- Account Id Field -->
<tr>
    <th>@lang('models/buses.fields.account_id')</th>
    <td>
        @if(!is_null($account = $bus->account))
        <a href="{{ route('provider.accounts.show', $account->id) }}">{{ $account->username }}</a>
        @endif
    </td>
</tr>

<!-- Rate Field -->
<tr>
    <th>@lang('models/buses.fields.rate')</th>
    <td>{{ $bus->rate }}</td>
</tr>

<!-- Active Field -->
<tr>
    <th>@lang('models/buses.fields.active')</th>
    <td>{!! $bus->active_span !!}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/buses.fields.created_at')</th>
    <td>{{ $bus->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/buses.fields.updated_at')</th>
    <td>{{ $bus->updated_at }}</td>
</tr>

