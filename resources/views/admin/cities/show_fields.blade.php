@foreach($locales as $locale)
<!-- Name {{ $locale }} Field -->
<tr>
    <th>@lang('models/cities.fields.name') ({{ $locale }})</th>
    <td>{{ $city->getTranslation('name', $locale) }}</td>
</tr>
@endforeach

<!-- Created At Field -->
<tr>
    <th>@lang('models/cities.fields.created_at')</th>
    <td>{{ $city->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/cities.fields.updated_at')</th>
    <td>{{ $city->updated_at }}</td>
</tr>

