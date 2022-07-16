
@if($notifications->count() > 0)
<div class="table-responsive">
    <table id="notifications-table" class="table display table-bordered table-striped no-wrap">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('models/notifications.fields.icon')</th>
            <th>@lang('models/notifications.fields.to')</th>
            <th>@lang('models/notifications.fields.title')</th>
            {{-- <th>@lang('models/notifications.fields.text')</th> --}}
            <th>@lang('crud.created_at')</th>
            <th>@lang('msg.status')</th>
            <th>@lang('msg.view')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notifications as $i => $notification)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><img src="{{ asset('images/notifications/'.$notification->icon) }}" style="max-height: 70px; max-width: 100%;"></td>
                <td>
                    @if(is_null($notification->user_id))
                        <span class="badge badge-info">@lang('msg.global')</span>
                    @else
                        <span class="badge badge-warning">@lang('msg.private')</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('notifications.show', $notification->id) }}">
                        {{ $notification->title }}
                    </a>
                </td>
                {{-- <td>{!! substr($notification->text, 0, 50) . (Str::length($notification->text) > 50 ? ' ..' : '') !!}</td> --}}
                <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans() }}</td>
                <td>
                    @if(!is_null($notification->read_at) && !is_null($notification->reply_message))
                        <span class="badge badge-success">@lang('models/notifications.replied')</span>
                    @elseif(!is_null($notification->read_at))
                        <span class="badge badge-info">@lang('models/notifications.read')</span>
                    @else
                        <span class="badge badge-dark">@lang('models/notifications.unread')</span>
                    @endif
                </td>

                <td>
                    <a class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" href="{{ route('notifications.show', $notification->id) }}">
                        @lang('msg.open')
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="my-2">
    {!! $notifications->links('vendor.pagination.tailwind') !!}
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
