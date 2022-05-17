<!-- Name Field -->
<tr>
    <th>@lang('models/providers.fields.name')</th>
    <td>{{ $provider->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <th>@lang('models/providers.fields.email')</th>
    <td>{{ $provider->email }}</td>
</tr>

<!-- Phone Field -->
<tr>
    <th>@lang('models/providers.fields.phone')</th>
    <td>{{ $provider->phone }}</td>
</tr>

<!-- Address Field -->
<tr>
    <th>@lang('models/providers.fields.address')</th>
    <td>{{ $provider->address }}</td>
</tr>

<!-- Comm Reg Num Field -->
<tr>
    <th>@lang('models/providers.fields.comm_reg_num')</th>
    <td>{{ $provider->comm_reg_num }}</td>
</tr>

<!-- Comm Reg Img Field -->
<tr>
    <th>@lang('models/providers.fields.comm_reg_img')</th>
    <td><img src="{{ asset('images/providers/'.$provider->comm_reg_img) }}" alt="" /></td>
</tr>

<!-- Tax Cert Num Field -->
<tr>
    <th>@lang('models/providers.fields.tax_cert_num')</th>
    <td>{{ $provider->tax_cert_num }}</td>
</tr>

<!-- Tax Field -->
<tr>
    <th>@lang('models/providers.fields.tax')</th>
    <td>{{ $provider->tax }}</td>
</tr>

<!-- Image Field -->
<tr>
    <th>@lang('models/providers.fields.image')</th>
    <td><img src="{{ asset('images/providers/'.$provider->image) }}" alt="" /></td>
</tr>

<!-- Notes Field -->
<tr>
    <th>@lang('models/providers.fields.notes')</th>
    <td>{{ $provider->notes }}</td>
</tr>

<!-- Cities Fields -->
<tr>
    <th>@lang('models/providers.fields.cities')</th>
    <td>
        <ul class="p-t-5">
            @foreach($provider->providerCities() as $providerCity)
            <li><a href="{{ route('admin.cities.show', $providerCity->id) }}">{{ $providerCity->name }}</a></li>
            @endforeach
        </ul>
    </td>
</tr>

<!-- Block Field -->
<tr>
    <th>@lang('models/providers.fields.block')</th>
    <td>{!! $provider->block_span !!}</td>
</tr>

<!-- Block Notes Field -->
<tr>
    <th>@lang('models/providers.fields.block_notes')</th>
    <td>{{ $provider->block_notes }}</td>
</tr>

<!-- Approve Field -->
<tr>
    <th>@lang('models/providers.fields.approve')</th>
    <td>{!! $provider->approve_span !!}</td>
</tr>

<!-- Email Verified At Field -->
<tr>
    <td>@lang('models/providers.fields.email_verified_at')</td>
    <td>{{ $provider->email_verified_at }}</td>
</tr>

<!-- Phone Verified At Field -->
<tr>
    <td>@lang('models/providers.fields.phone_verified_at')</td>
    <td>{{ $provider->phone_verified_at }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <td>@lang('models/providers.fields.created_at')</td>
    <td>{{ $provider->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <td>@lang('models/providers.fields.updated_at')</td>
    <td>{{ $provider->updated_at }}</td>
</tr>

