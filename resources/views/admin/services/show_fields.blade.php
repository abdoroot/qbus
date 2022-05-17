<!-- Title Field -->
<tr>
    <th>@lang('models/services.fields.title')</th>
    <td>{{ $service->title }}</td>
</tr>

<!-- Text Field -->
<tr>
    <th>@lang('models/services.fields.text')</th>
    <td>{{ $service->text }}</td>
</tr>

<!-- Image Field -->
<tr>
    <th>@lang('models/services.fields.image')</th>
    <td><img src="{{ asset('images/services/'.$service->image) }}" alt="" /></td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/services.fields.created_at')</th>
    <td>{{ $service->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/services.fields.updated_at')</th>
    <td>{{ $service->updated_at }}</td>
</tr>

