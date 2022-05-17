<div class="table-responsive m-t-30 m-b-20">
    <table id="destinations-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/destinations.fields.name')</th>
                <th>@lang('models/destinations.fields.provider_id')</th>
                <th>@lang('models/destinations.fields.from_city_id')</th>
                <th>@lang('models/destinations.fields.to_city_id')</th>
                <th>@lang('models/destinations.fields.starting_terminal_id')</th>
                <th>@lang('models/destinations.fields.arrival_terminal_id')</th>
                <th>@lang('models/destinations.fields.stops')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($destinations as $destination)
            <tr>
                <td>{{ $destination->id }}</td>
                <td>
                    <a href="{{ route('admin.destinations.show', $destination->id) }}"> {{ $destination->name }}</a>
                </td>
                <td>
                    @if(!is_null($destination->provider))
                    <a href="{{ route('admin.providers.show', $destination->provider_id) }}"> {{ $destination->provider->name }}</a>
                    @endif    
                </td>
                <td>
                    @if(!is_null($destination->fromCity))
                    <a href="{{ route('admin.cities.show', $destination->from_city_id) }}"> {{ $destination->fromCity->name }}</a>
                    @endif    
                </td>
                <td>
                    @if(!is_null($destination->toCity))
                    <a href="{{ route('admin.cities.show', $destination->to_city_id) }}"> {{ $destination->toCity->name }}</a>
                    @endif    
                </td>
                <td>
                    @if(!is_null($destination->startingTerminal))
                    <a href="{{ route('admin.terminals.show', $destination->starting_terminal_id) }}"> {{ $destination->startingTerminal->name }}</a>
                    @endif    
                </td>
                <td>
                    @if(!is_null($destination->arrivalTerminal))
                    <a href="{{ route('admin.terminals.show', $destination->arrival_terminal_id) }}"> {{ $destination->arrivalTerminal->name }}</a>
                    @endif    
                </td>
                <td>{{ count($destination->stops ?? []) }}</td>
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
        $('#destinations-table').DataTable({
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