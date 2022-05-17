<!-- Username Field -->
<tr>
    <th>@lang('models/accounts.fields.username')</th>
    <td>{{ $account->username }}</td>
</tr>

<!-- Active Field -->
<tr>
    <th>@lang('models/accounts.fields.active')</th>
    <td>{!! $account->active_span !!}</td>
</tr>

<!-- Email Field -->
<tr>
    <th>@lang('models/accounts.fields.email')</th>
    <td>{{ $account->email }}</td>
</tr>

<!-- Phone Field -->
<tr>
    <th>@lang('models/accounts.fields.phone')</th>
    <td>{{ $account->phone }}</td>
</tr>

<!-- Role Field -->
<tr>
    <th>@lang('models/accounts.fields.role')</th>
    <td>{{ __('models/accounts.roles.'.$account->role) }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/accounts.fields.created_at')</th>
    <td>{{ $account->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/accounts.fields.updated_at')</th>
    <td>{{ $account->updated_at }}</td>
</tr>

