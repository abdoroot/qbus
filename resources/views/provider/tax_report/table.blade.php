<div class="table-responsive m-t-30 m-b-20">
    <table id="orders-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('models/busOrders.fields.created_at')</th>
                <th>@lang('crud.id')</th>
                <th>@lang('msg.model')</th>
                <th>@lang('models/busOrders.fields.tax')</th>
                <th>@lang('models/busOrders.fields.total')</th>
                <th>@lang('models/busOrders.fields.user_id')</th>
                <th>@lang('models/busOrders.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ __('models/'.($model = str_replace('_o', 'O', $order->getTable())).'.singular') }}</td>
                <td>{{ $order->tax }}</td>
                <td>{{ $order->total }}</td>
                <td> @if(!is_null($user = $order->user)) {{ $user->name }} @endif </td>
                <td>{!! $order->status_span !!}</td>
                <td>
                    <a href="{{ route('provider.'.$model.'.show', [$order->id]) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-eye"></i>
                        </a>
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
        $('#orders-table').DataTable({
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