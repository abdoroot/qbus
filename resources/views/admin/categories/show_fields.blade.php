@foreach($locales as $locale)
<!-- Name {{ $locale }} Field -->
<tr>
    <th>@lang('models/categories.fields.name') ({{ $locale }})</th>
    <td>{{ $category->getTranslation('name', $locale) }}</td>
</tr>

@endforeach

<!-- Created At Field -->
<tr>
    <th>@lang('models/categories.fields.created_at')</th>
    <td>{{ $category->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/categories.fields.updated_at')</th>
    <td>{{ $category->updated_at }}</td>
</tr>

