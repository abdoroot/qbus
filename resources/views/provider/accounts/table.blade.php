<div class="table-responsive m-t-30 m-b-20">
    <table id="accounts-table" class="table display table-bordered table-striped no-wrap" style="width: 100%;">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/accounts.fields.username')</th>
                <th>@lang('models/accounts.fields.email')</th>
                <th>@lang('models/accounts.fields.phone')</th>
                <th>@lang('models/accounts.fields.role')</th>
                <th>@lang('models/accounts.fields.active')</th>
                @if(!isset($action) || $action !== false) <th>@lang('crud.action')</th> @endif
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>
                    <a href="{{ route('provider.accounts.show', $account->id) }}" class="text-info">
                        {{ $account->username }}
                    </a>
                </td>
                <td>{{ $account->email }}</td>
                <td>{{ $account->phone }}</td>
                <td>@lang('models/accounts.roles.'.$account->role)</td>
                <td>{!! $account->active_span !!}</td>
                @if(!isset($action) || $action !== false)
                <td>
                    <a href="{{ route('provider.accounts.edit', $account->id) }}"
                        class='btn btn-info btn-sm'>
                            <i class="ti-pencil"></i>
                        </a>
                    {!! Form::open(['route' => ['provider.accounts.destroy', $account->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
                        {!! Form::button('<i class="ti-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-confirm']) !!}
                    {!! Form::close() !!}
                </td>
                @endif
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
        $('#accounts-table').DataTable({
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