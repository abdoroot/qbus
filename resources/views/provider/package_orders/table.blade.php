<div class="table-responsive m-t-30 m-b-20">
    <table id="package_orders-table" class="table display table-bordered table-spackageed no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/packageOrders.fields.package_id')</th>
                <th>@lang('models/packageOrders.fields.user_id')</th>
                <th>@lang('models/packageOrders.fields.count')</th>
                <th>@lang('models/packageOrders.fields.total')</th>
                <th>@lang('models/packageOrders.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packageOrders as $packageOrder)
            <tr>
                <td>{{ $packageOrder->id }}</td>
                <td>
                    @if(!is_null($package = $packageOrder->package))
                    <a href="{{ route('provider.packages.show', $package->id) }}">{{ $package->name }}</a>
                    @endif
                </td>
                <td>
                    @if(!is_null($user = $packageOrder->user)){{ $user->name }}@endif
                </td>
                <td>{{ $packageOrder->count }}</td>
                <td>{{ $packageOrder->total }}</td>
                <td>{!! $packageOrder->status_span !!}</td>
                <td>
                    <a href="{{ route('provider.packageOrders.show', [$packageOrder->id]) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['provider.packageOrders.destroy', $packageOrder->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
        $('#package_orders-table').DataTable({
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