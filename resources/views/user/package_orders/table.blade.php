
@if($packageOrders->count() > 0)
<div class="table-responsive">
    <table id="packageOrders-table" class="table display table-bordered table-spackageed no-wrap">
        <thead>
        <tr>
            <th>@lang('crud.id')</th>
            <th>@lang('models/packageOrders.fields.package_id')</th>
            <th>@lang('models/packageOrders.fields.count')</th>
            <th>@lang('models/packages.fields.from_date')</th>
            <th>@lang('models/packageOrders.fields.total')</th>
            <th>@lang('crud.created_at')</th>
            <th>@lang('msg.status')</th>
            <th>@lang('msg.view')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($packageOrders as $i => $packageOrder)
            <tr>
                <td>
                    #<a href="{{ route('packageOrders.show', $packageOrder->id) }}" class="text-blue-500">
                        {{ $packageOrder->id }}</a>
                </td>
                <td>
                    @if(!is_null($package = $packageOrder->package))
                    <a href="{{ route('packages.show', $package->id) }}" class="text-blue-500">
                        {{ $package->name }}</a>
                    @endif
                </td>
                <td>{{ $packageOrder->count ?? '-' }}</td>
                <td>{{ !is_null($package) ? $package->date_from : '-' }}</td>
                <td>{{ $packageOrder->total ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($packageOrder->created_at))->diffForHumans() }}</td>
                <td><span class="ribbon ribbon-{{ $packageOrder->status_color }}">{{ __('models/packageOrders.status.'.$packageOrder->status) }}</span>
                </td>

                <td>
                    <a class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" href="{{ route('packageOrders.show', $packageOrder->id) }}">
                        @lang('msg.open')
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('third_party_stylesheets')
    <style>
        /* Center tables for demo */
        table {
            margin: 0 auto;
        }

        /* Default Table Style */
        table {
            color: #333;
            background: white;
            border: 1px solid grey;
            font-size: 12pt;
            border-collapse: collapse;
            width: 100%;
        }
        table thead th,
        table tfoot th {
            color: rgba(75,85,99);
            background: rgb(229, 231, 235);
        }
        table caption {
            padding:.5em;
        }
        table th,
        table td {
            padding: .5em;
            border: 1px solid lightgrey;
        }
        /* Zebra Table Style */
        [data-table-theme*=zebra] tbody tr:nth-of-type(odd) {
            background: rgba(0,0,0,.05);
        }
        [data-table-theme*=zebra][data-table-theme*=dark] tbody tr:nth-of-type(odd) {
            background: rgba(255,255,255,.05);
        }
        /* Dark Style */
        [data-table-theme*=dark] {
            color: #ddd;
            background: #333;
            font-size: 12pt;
            border-collapse: collapse;
        }
        [data-table-theme*=dark] thead th,
        [data-table-theme*=dark] tfoot th {
            color: #aaa;
            background: rgba(0255,255,255,.15);
        }
        [data-table-theme*=dark] caption {
            padding:.5em;
        }
        [data-table-theme*=dark] th,
        [data-table-theme*=dark] td {
            padding: .5em;
            border: 1px solid grey;
        }
    </style>
@endpush

@endif
