<div class="table-responsive m-t-30 m-b-20">
    <table id="contacts-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/contacts.fields.message')</th>
                <th>@lang('models/contacts.fields.email')</th>
                <th>@lang('models/contacts.fields.name')</th>
                <th>@lang('models/contacts.fields.read')</th>
                <th>@lang('models/contacts.fields.reply')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>
                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-3">
                                <b>{{ $contact->subject }}</b>
                                <small class="d-block font-light">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($contact->created_at))->diffForHumans() }}</small>
                            </h5>
                        </div>
                        <p class="mb-1"
                            style="width: 100%; white-space: normal;">
                            {!! substr($contact->message, 0, 80) . (Str::length($contact->message) > 80 ? ' ..' : '') !!}
                        </p>
                    </a>
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->name }}</td>
                <td>
                    @if(!is_null($contact->read_at))
                    <span class="badge badge-success">@lang('models/contacts.read')</span>
                    @else
                    <span class="badge badge-warning">@lang('models/contacts.unread')</span>
                    @endif
                </td>
                <td>
                    @if(!is_null($contact->reply_message))
                    <span class="badge badge-success">@lang('models/contacts.replied')</span>
                    @else
                    <span class="badge badge-primary">@lang('models/contacts.unreplied')</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.contacts.edit', [$contact->id]) }}"
                        class='btn btn-info btn-sm'>
                        <i class="fa fa-reply-all"></i>
                        </a>
                    {!! Form::open(['route' => ['admin.contacts.destroy', $contact->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
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
        $('#contacts-table').DataTable({
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
