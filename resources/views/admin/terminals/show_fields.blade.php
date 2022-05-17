<!-- Provider Id Field -->
<tr>
    <th>@lang('models/terminals.fields.provider_id')</th>
    <td>
        @if(!is_null($provider = $terminal->provider))
        <a href="{{ route('admin.providers.show', $provider->id) }}">{{ $provider->name }}</a>
        @endif
    </td>
</tr>

<!-- Name Field -->
<tr>
    <th>@lang('models/terminals.fields.name')</th>
    <td>{{ $terminal->name }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/terminals.fields.created_at')</th>
    <td>{{ $terminal->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/terminals.fields.updated_at')</th>
    <td>{{ $terminal->updated_at }}</td>
</tr>

