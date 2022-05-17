<div class="table-responsive m-t-30 m-b-20">
    <table id="trip_orders-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/tripOrders.fields.trip_id')</th>
                <th>@lang('models/tripOrders.fields.user_id')</th>
                <th>@lang('models/tripOrders.fields.count')</th>
                <th>@lang('models/tripOrders.fields.total')</th>
                <th>@lang('models/tripOrders.fields.status')</th>
                <th>@lang('models/tripOrders.fields.type')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tripOrders as $tripOrder)
            <tr>
                <td>{{ $tripOrder->id }}</td>
                <td>
                    @if(!is_null($trip = $tripOrder->trip))
                    <a href="{{ route('admin.trips.show', $trip->id) }}">{{ $trip->name }}</a>
                    @endif
                </td>
                <td>
                    @if(!is_null($user = $tripOrder->user))
                    <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                    @endif
                </td>
                <td>{{ $tripOrder->count }}</td>
                <td>{{ $tripOrder->total }}</td>
                <td>{!! $tripOrder->status_span !!}</td>
                <td>{{ __('models/tripOrders.types.'.$tripOrder->type) }}</td>
                <td>
                    <a href="{{ route('admin.tripOrders.show', [$tripOrder->id]) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.tripOrders.destroy', $tripOrder->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
        $('#trip_orders-table').DataTable({
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