<!-- Title Field -->
<tr>
    <th>@lang('models/chats.fields.title')</th>
    <td><i class="{{ $chat->icon }}"></i> {{ $chat->title }}</td>
</tr>

<!-- Text Field -->
<tr>
    <th>@lang('models/chats.fields.text')</th>
    <td>{!! $chat->text !!}</td>
</tr>

<!-- Url Field -->
<tr>
    <th>@lang('models/chats.fields.url')</th>
    <td>
        @if(!is_null($chat->url))
        <a class="text-info" href="{{ $chat->url }}">{{ $chat->url }}</a>
        @endif
    </td>
</tr>

<!-- Type Field -->
<tr>
    <th>@lang('models/chats.fields.type')</th>
    <td><span class="label label-{{ $chat->type }}">{{ $chat->type }}</span></td>
</tr>

<!-- Read At Field -->
<tr>
    <td>@lang('models/chats.fields.read_at')</td>
    <td>{{ $chat->read_at }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('models/chats.fields.created_at')</td>
    <td>{{ $chat->created_at }}</td>
</tr>