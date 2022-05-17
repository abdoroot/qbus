<!-- Name Field -->
<tr>
    <th>@lang('models/additionals.fields.name')</th>
    <td>{{ $additional->name }}</td>
</tr>

<!-- Icon Field -->
<tr>
    <th>@lang('models/additionals.fields.icon')</th>
    <td>{!! $additional->icon !!}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/additionals.fields.created_at')</th>
    <td>{{ $additional->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/additionals.fields.updated_at')</th>
    <td>{{ $additional->updated_at }}</td>
</tr>

