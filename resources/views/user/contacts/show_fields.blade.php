<!-- Name Field -->
<tr>
    <th>@lang('models/contacts.fields.name')</th>
    <td>{{ $contact->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <th>@lang('models/contacts.fields.email')</th>
    <td>{{ $contact->email }}</td>
</tr>

<!-- Type Field -->
<tr>
    <th>@lang('models/contacts.fields.type')</th>
    <td>{{ __('models/contacts.types.'.$contact->type) }}</td>
</tr>

<!-- Subject Field -->
<tr>
    <th>@lang('models/contacts.fields.subject')</th>
    <td>{{ $contact->subject }}</td>
</tr>

<!-- Message Field -->
<tr>
    <th>@lang('models/contacts.fields.message')</th>
    <td>{{ $contact->message }}</td>
</tr>

<!-- Reply Message Field -->
<tr>
    <th>@lang('models/contacts.fields.reply_message')</th>
    <td>{{ $contact->reply_message }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/contacts.fields.created_at')</th>
    <td>{{ $contact->created_at }}</td>
</tr>