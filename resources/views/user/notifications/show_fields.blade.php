<!-- Title Field -->
<tr>
    <th>@lang('models/notifications.fields.title')</th>
    <td><i class="{{ $notification->icon }}"></i> {{ $notification->title }}</td>
</tr>

<!-- Text Field -->
<tr>
    <th>@lang('models/notifications.fields.text')</th>
    <td>{{ $notification->text }}</td>
</tr>

<!-- Url Field -->
<tr>
    <th>@lang('models/notifications.fields.url')</th>
    <td>
        @if(!is_null($notification->url))
        <a class="text-info" href="{{ $notification->url }}">{{ $notification->url }}</a>
        @endif
    </td>
</tr>

<!-- Icon Field -->
<tr>
    <th>@lang('models/notifications.fields.icon')</th>
    <td><img src="{{ asset('images/notifications/'.$notification->icon) }}"></td>
</tr>

<!-- Type Field -->
<tr>
    <th>@lang('models/notifications.fields.type')</th>
    <td><span class="label label-{{ $notification->type }}">{{ $notification->type }}</span></td>
</tr>

<!-- Read At Field -->
<tr>
    <td>@lang('models/notifications.fields.read_at')</td>
    <td>{{ $notification->read_at }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('models/notifications.fields.created_at')</td>
    <td>{{ $notification->created_at }}</td>
</tr>