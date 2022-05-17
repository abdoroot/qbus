<div class="table-responsive m-t-30 m-b-20">
    <table id="trips-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                {{-- <th>@lang('models/trips.fields.name')</th>
                <th>@lang('models/trips.fields.image')</th> --}}
                <th>@lang('models/trips.fields.destination_id')</th>
                <th>@lang('models/trips.fields.date_from')</th>
                <th>@lang('models/trips.fields.date_to')</th>
                <th>@lang('models/trips.fields.provider_id')</th>
                <th>@lang('models/trips.fields.bus_id')</th>
                <th>@lang('models/trips.fields.fees')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
            <tr>
                <td>{{ $trip->id }}</td>
                {{-- <td><a href="{{ route('admin.trips.show', [$trip->id]) }}">{{ $trip->name }}</a></td>
                <td><img src="{{ asset('images/trips/'.$trip->image) }}" alt="" /></td> --}}
                <td>
                    @if(!is_null($destination = $trip->destination))
                    <a href="{{ route('admin.destinations.show', $trip->destination_id) }}">{{ $destination->name }}</a>
                    @endif
                </td>
                <td>{{ $trip->date_from }}</td>
                <td>{{ $trip->date_to }}</td>
                <td>
                    @if(!is_null($provider = $trip->provider))
                    <a href="{{ route('admin.providers.show', $trip->provider_id) }}">{{ $provider->name }}</a>
                    @endif
                </td>
                <td>
                    @if(!is_null($bus = $trip->bus))
                    <a href="{{ route('admin.buses.show', $trip->bus_id) }}">{{ $bus->plate }}</a>
                    @endif
                </td>
                <td>{{ $trip->fees }}</td>
                <td>
                    <a href="{{ route('admin.trips.show', [$trip->id]) }}"
                        class='btn btn-primary btn-sm'>
                            <i class="ti-eye"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.trips.destroy', $trip->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
        $('#trips-table').DataTable({
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