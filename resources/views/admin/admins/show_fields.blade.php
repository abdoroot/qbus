<!-- Name Field -->
<tr>
    <th> @lang('models/admins.fields.name') </th>
    <td>{{ $admin->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <th> @lang('models/admins.fields.email') </th>
    <td>{{ $admin->email }}</td>
</tr>

<!-- Active Field -->
<tr>
    <th> @lang('models/admins.fields.status') </th>
    <td>{!! $admin->active_span !!}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('crud.created_at')</td>
    <td>{{ $admin->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <td>@lang('crud.updated_at')</td>
    <td>{{ $admin->updated_at }}</td>
</tr>