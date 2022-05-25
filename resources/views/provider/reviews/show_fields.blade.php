@if(!is_null($user = $review->user))
<!-- User Id Field -->
<tr>
    <th>@lang('models/reviews.fields.user_id')</th>
    <td>
        <a href="javascript:;" data-toggle="modal" data-target="#user-modal">{{ $user->name }}</a>
        @include('provider.reviews.user_modal')  
    </td>
</tr>
@endif

<!-- Name Field -->
<tr>
    <th>@lang('models/reviews.fields.name')</th>
    <td>{{ $review->name }}</td>
</tr>

<!-- Email Field -->
<tr>
    <th>@lang('models/reviews.fields.email')</th>
    <td>{{ $review->email }}</td>
</tr>

@if(!is_null($trip = $review->trip))
<!-- Trip Id Field -->
<tr>
    <th>@lang('models/reviews.fields.trip_id')</th>
    <td>
        <a href="{{ route('provider.trips.show', $trip->id) }}">{{ $trip->name }}</a>
    </td>
</tr>
@endif

@if(!is_null($package = $review->package))
<!-- Package Id Field -->
<tr>
    <th>@lang('models/reviews.fields.package_id')</th>
    <td>
        <a href="{{ route('provider.packages.show', $package->id) }}">{{ $package->name }}</a>
    </td>
</tr>
@endif

@if(!is_null($busOrder = $review->busOrder))
<!-- Bus Order Id Field -->
<tr>
    <th>@lang('models/reviews.fields.bus_order_id')</th>
    <td>
        <a href="{{ route('provider.busOrders.show', $busOrder->id) }}">{{ $busOrder->name }}</a>
    </td>
</tr>
@endif

<!-- Rate Field -->
<tr>
    <th>@lang('models/reviews.fields.rate')</th>
    <td>{{ $review->rate }}</td>
</tr>

<!-- Review Field -->
<tr>
    <th>@lang('models/reviews.fields.review')</th>
    <td>{{ $review->review }}</td>
</tr>

<!-- Active Field -->
<tr>
    <th>@lang('models/reviews.fields.publish')</th>
    <td>{!! $review->publish_span !!}</td>
</tr>

<!-- Created At Field -->
<tr>
    <th>@lang('models/reviews.fields.created_at')</th>
    <td>{{ $review->created_at }}</td>
</tr>

<!-- Updated At Field -->
<tr>
    <th>@lang('models/reviews.fields.updated_at')</th>
    <td>{{ $review->updated_at }}</td>
</tr>

