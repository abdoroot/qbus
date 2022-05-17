<div class="table-responsive m-t-30 m-b-20">
    <table id="coupons-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/coupons.fields.name')</th>
                <th>@lang('models/coupons.fields.date_from')</th>
                <th>@lang('models/coupons.fields.date_to')</th>
                <th>@lang('models/coupons.fields.type')</th>
                <th>@lang('models/coupons.fields.discount')</th>
                <th>@lang('models/coupons.fields.code')</th>
                <th>@lang('models/coupons.fields.provider_id')</th>
                <th>@lang('models/coupons.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td><a href="{{ route('admin.coupons.show', [$coupon->id]) }}">{{ $coupon->name }}</a></td>
                <td>{{ $coupon->date_from }}</td>
                <td>{{ $coupon->date_to }}</td>
                <td>{{ $coupon->type }}</td>
                <td>{{ $coupon->discount }}</td>
                <td>{{ $coupon->code }}</td>
                <td>
                    @if(!is_null($coupon->provider))
                    <a href="{{ route('admin.providers.show', $coupon->provider_id) }}" class="text-primary"> {{ $coupon->provider->name }}</a>
                    @endif
                </td>
                <td>{!! $coupon->status_span !!}</td>
                <td>
                    <a href="{{ route('admin.coupons.edit', [$coupon->id]) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.coupons.destroy', $coupon->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
        $('#coupons-table').DataTable({
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