<div class="table-responsive">
    <table id="contacts-table" class="table display table-bordered table-striped no-wrap">
        <thead>
            <tr>
                <th>@lang('crud.id')</th>
                <th>@lang('models/contacts.fields.type')</th>
                <th>@lang('models/contacts.fields.subject')</th>
                <th>@lang('models/contacts.fields.message')</th>
                <th>@lang('models/contacts.fields.created_at')</th>
                <th>@lang('models/contacts.fields.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>
                    @if($contact->type == 'contact')
                    <span class="badge badge-info">@lang('models/contacts.types.contact')</span>
                    @elseif($contact->type == 'complaint')
                    <span class="badge badge-warning">@lang('models/contacts.types.complaint')</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('contacts.show', $contact->id) }}">
                        {{ $contact->subject }}
                    </a>
                </td>
                <td>{!! substr($contact->message, 0, 50) . (Str::length($contact->message) > 50 ? ' ..' : '') !!}</td>
                <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($contact->created_at))->diffForHumans() }}</td>
                <td>
                    @if(!is_null($contact->read_at) && !is_null($contact->reply_message))
                    <span class="badge badge-success">@lang('models/contacts.replied')</span>
                    @elseif(!is_null($contact->read_at))
                    <span class="badge badge-info">@lang('models/contacts.read')</span>
                    @else
                    <span class="badge badge-dark">@lang('models/contacts.unread')</span>
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