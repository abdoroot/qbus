<div class="table-responsive m-t-30 m-b-20">
    <table id="chats-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/chats.singular')</th>
                <th>@lang('models/chats.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chats as $chat)
            <tr>
                <td>{{ $chat->id }}</td>
                <td>
                    <a href="{{ route('provider.chats.show', $chat->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                @if(!is_null($chat->icon)) <i class="{{ $chat->icon }} text-{{ $chat->type }}"></i> @endif
                                {{ $chat->title }}
                            </h5>
                            <small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($chat->created_at))->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1" 
                            style="width: 100%; white-space: normal;">
                            {!! substr($chat->text, 0, 80) . (Str::length($chat->text) > 80 ? ' ..' : '') !!}
                        </p>
                    </a>
                </td>
                <td>
                    @if(!is_null($chat->read_at))
                    <span class="badge badge-success">@lang('models/chats.read')</span>
                    @else
                    <span class="badge badge-danger">@lang('models/chats.unread')</span>
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['provider.chats.update', $chat->id], 'method' => 'patch', 'class' => 'd-inline']) !!}
                        {!! Form::button('<i class="ti-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm btn-confirm', 'data-title' => __('msg.confirm'), 'data-text' => $chat->read_at ? __('msg.mark_as_unread') : __('msg.mark_as_read')]) !!}
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['provider.chats.destroy', $chat->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
@endpush

@push('page_scripts')
<script>
    $(function () {
        // responsive table
        $('#chats-table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
                // , 'pdf'
            ],
            "order": [[ 0, "desc" ]]
        });
        $('.buttons-copy, .buttons-print, .buttons-excel').addClass('btn btn-primary mr-1'); 
    });
</script>
@endpush