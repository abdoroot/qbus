<div class="table-responsive m-t-30 m-b-20">
    <table id="packages-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/packages.fields.name')</th>
                <th>@lang('models/packages.fields.image')</th>
                <th>@lang('models/packages.fields.date_from')</th>
                <th>@lang('models/packages.fields.fees')</th>
                <th>@lang('models/packages.fields.provider_id')</th>
                <th>@lang('models/packages.fields.starting_city_id')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td><a href="{{ route('admin.packages.show', $package->id) }}" class="text-info">{{ $package->name }}</a></td>
                <td><img src="{{ asset('images/packages/'.$package->image) }}" alt="" /></td>
                <td>{{ $package->date_from }}</td>
                <td>{{ $package->fees }}</td>
                <td>
                    @if(!is_null($package->provider))
                    <a href="{{ route('admin.providers.show', $package->provider_id) }}" class="text-primary"> {{ $package->provider->name }}</a>
                    @endif
                </td>
                <td>
                    @if(!is_null($startingCity = $package->startingCity))
                    <a href="{{ route('admin.cities.show', $startingCity->id) }}">{{ $startingCity->name }}</a>
                    @endif
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
        $('#packages-table').DataTable({
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