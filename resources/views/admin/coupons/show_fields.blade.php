<!-- Provider Id Field -->
<tr>
    <th>@lang('models/coupons.fields.provider_id')</th>
    <td>
        @if(!is_null($coupon->provider))
        <a href="{{ route('admin.providers.show', $coupon->provider_id) }}" class="text-primary"> {{ $coupon->provider->name }}</a>
        @endif
    </td>
</tr>

<!-- Name Field -->
<tr>
    <th>@lang('models/coupons.fields.name')</th>
    <td>{{ $coupon->name }}</td>
</tr>

<!-- Date From Field -->
<tr>
    <th>@lang('models/coupons.fields.date_from')</th>
    <td>{{ $coupon->date_from }}</td>
</tr>

<!-- Date To Field -->
<tr>
    <th>@lang('models/coupons.fields.date_to')</th>
    <td>{{ $coupon->date_to }}</td>
</tr>

<!-- Type Field -->
<tr>
    <th>@lang('models/coupons.fields.type')</th>
    <td>{{ __('models/coupons.types.'.$coupon->type) }}</td>
</tr>

<!-- Discount Field -->
<tr>
    <th>@lang('models/coupons.fields.discount')</th>
    <td>{{ $coupon->discount }}</td>
</tr>

<!-- Code Field -->
<tr>
    <th>@lang('models/coupons.fields.code')</th>
    <td>{{ $coupon->code }}</td>
</tr>

<!-- Status Field -->
<tr>
    <th>@lang('models/coupons.fields.status')</th>
    <td>{!! $coupon->status_span !!}</td>
</tr>

<!-- Admin Notes Field -->
<tr>
    <th>@lang('models/coupons.fields.admin_notes')</th>
    <td>{{ $coupon->admin_notes }}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/coupons.fields.created_at')</th>
    <td>{{ $coupon->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/coupons.fields.updated_at')</th>
    <td>{{ $coupon->updated_at }}</td>
</tr>

