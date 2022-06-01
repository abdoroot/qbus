@extends('guest.layouts.app')

@section('content')

    <div class="row">
        <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
            <div class="w-full md:w-1/4 min-h-screen py-8 border-r">
                @php $page = "profile.complaint"; @endphp
                @include('user.profile.menu')

            </div>


            <div class="w-full md:w-3/4 p-4 md:p-8">
                <div class="profileTap">
                    <h2 class="font-bold">@lang('msg.my_complain')</h2><div class="mt-6 ">
                        @include('flash::message')
                        <table>
                            <!-- Name Field -->
                            <tr>
                                <th>@lang('models/contacts.fields.name')</th>
                                <td>{{ $contact->name }}</td>
                            </tr>

                            <!-- Email Field -->
                            <tr>
                                <th>@lang('models/contacts.fields.email')</th>
                                <td>{{ $contact->email }}</td>
                            </tr>

                            <!-- Type Field -->
                            <tr>
                                <th>@lang('models/contacts.fields.type')</th>
                                <td>{{ __('models/contacts.types.'.$contact->type) }}</td>
                            </tr>

                            <!-- Subject Field -->
                            <tr>
                                <th>@lang('models/contacts.fields.subject')</th>
                                <td>{{ $contact->subject }}</td>
                            </tr>

                            <!-- Message Field -->
                            <tr>
                                <th>@lang('models/contacts.fields.message')</th>
                                <td>{{ $contact->message }}</td>
                            </tr>

                            <!-- Reply Message Field -->
                            <tr>
                                <th>@lang('models/contacts.fields.reply_message')</th>
                                <td>{{ $contact->reply_message }}</td>
                            </tr>

                            <!-- Created At Field -->
                            <tr>
                                <th>@lang('msg.created_at')</th>
                                <td>{{ $contact->created_at }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Column -->
    </div>
    <!-- Row -->

 <style>
     .alert-success {
         color: #3c763d;
         background-color: #dff0d8;
         border-color: #d6e9c6;
     }
     .alert {
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid transparent;
         border-top-color: transparent;
         border-right-color: transparent;
         border-bottom-color: transparent;
         border-left-color: transparent;
         border-radius: 4px;
     }
 </style>
@endsection


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
            //border: 1px solid grey;
            font-size: 12pt;
            //border-collapse: collapse;
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
            //border: 1px solid lightgrey;
            text-align: right;
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
