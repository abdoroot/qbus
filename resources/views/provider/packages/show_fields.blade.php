<!-- Name Field -->
<tr>
    <th>@lang('models/packages.fields.name')</th>
    <td>{{ $package->name }}</td>
</tr>

<!-- Image Field -->
<tr>
    <th>@lang('models/packages.fields.image')</th>
    <td><img src="{{ asset('images/packages/'.$package->image) }}" alt="" /></td>
</tr>

<!-- Fees Field -->
<tr>
    <th>@lang('models/packages.fields.fees')</th>
    <td>{{ $package->fees }}</td>
</tr>

<!-- Destinations Field -->
<tr>
    <th>@lang('models/packages.fields.destinations')</th>
    <td>
        <ul class="">
            @foreach($package->packageDestinations() as $destination)
            <li><a href="{{ route('provider.destinations.show', $destination->id) }}">{{ $destination->name }}</a></li>
            @endforeach
        </ul>
    </td>
</tr>

<!-- Starting City Id Field -->
<tr>
    <th>@lang('models/packages.fields.starting_terminal_id')</th>
    <td>@if(!is_null($startingCity = $package->startingCity)) {{ $startingCity->name }} @endif</td>
</tr>

<!-- Date From Field -->
<tr>
    <th>@lang('models/packages.fields.date_from')</th>
    <td>{{ $package->date_from }}</td>
</tr>

<!-- Time From Field -->
<tr>
    <th>@lang('models/packages.fields.time_from')</th>
    <td>{{ $package->time_from }}</td>
</tr>

<!-- Rate Field -->
<tr>
    <th>@lang('models/packages.fields.rate')</th>
    <td>{{ $package->rate }}</td>
</tr>

<!-- Description Field -->
<tr>
    <th>@lang('models/packages.fields.description')</th>
    <td>{{ $package->description }}</td>
</tr>

<!-- Auto Approve Field -->
<tr>
    <th>@lang('models/packages.fields.auto_approve')</th>
    <td>{!! $package->auto_approve_span !!}</td>
</tr>

<!-- Additionals Field -->
<tr>
    <th>@lang('models/packages.fields.additional')</th>
    <td>
        <ul class="list-style-none">
            @foreach($package->additionals() as $row)
            <li><i class="fas fa-check text-success"></i> {{ $row['additional']->name }}  ({{ $row['fees'] }})</li>
            @endforeach
        </ul>
    </td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/packages.fields.created_at')</th>
    <td>{{ $package->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/packages.fields.updated_at')</th>
    <td>{{ $package->updated_at }}</td>
</tr>

