<div class="table-responsive m-t-30 m-b-20">
    <table id="reviews-table" class="table display table-bordered table-striped no-wrap" style="width: 100%;">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/reviews.fields.name')</th>
                <th>@lang('models/reviews.fields.provider_id')</th>
                <th>@lang('models/reviews.fields.trip_id')</th>
                <th>@lang('models/reviews.fields.package_id')</th>
                <th>@lang('models/reviews.fields.bus_order_id')</th>
                <th>@lang('models/reviews.fields.rate')</th>
                <th>@lang('models/reviews.fields.publish')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->name }}</td>
                <td>@if(!is_null($provider = $review->provider))<a href="{{ route('admin.providers.show', $provider->id) }}">{{ $provider->name }}</a>@endif</td>
                <td>@if(!is_null($trip = $review->trip))<a href="{{ route('admin.trips.show', $trip->id) }}">{{ $trip->name }}</a>@endif</td>
                <td>@if(!is_null($package = $review->package))<a href="{{ route('admin.packages.show', $package->id) }}">{{ $package->name }}</a>@endif</td>
                <td>@if(!is_null($busOrder = $review->busOrder))<a href="{{ route('admin.busOrders.show', $busOrder->id) }}">{{ $busOrder->name }}</a>@endif</td>
                <td>{{ $review->rate }}</td>
                <td>{!! $review->publish_span !!}</td>
                <td>
                    <a href="{{ route('admin.reviews.show', $review->id) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.reviews.destroy', $review->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
                        {!! Form::button('<i class="ti-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-confirm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('third_party_stylesheets')
<link rel="stylesheet" type="text/css"
    href="{{ asset('elite/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('elite/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
@endpush

@push('third_party_scripts')
<!-- This is data table -->
<script src="{{ asset('elite/assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('elite/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
@endpush

@push('page_scripts')
<script>
    $(function () {
        // responsive table
        $('#reviews-table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
                // , 'pdf'
            ],
        });
        $('.buttons-copy, .buttons-print, .buttons-excel').addClass('btn btn-primary mr-1');
    });
</script>
@endpush