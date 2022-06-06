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

                    <div class="tab-pane " id="settings" role="tabpanel">

                        <h2 class="font-bold">@lang('msg.new')</h2><div class="mt-6 ">

                            @if(Session::has('message'))
                                <div class="alert alert-success success-publish" >
                                    @Session::get('message')
                                </div>
                            @endif
                            <div class="card-body">
                                {!! Form::model($user, ['route' => 'contacts.store', 'files' => 'on']) !!}
                                {!! Form::hidden('user', $user->id) !!}
                                <div class="row">
                                    <div class="items-center -mx-2 md:flex mb-6">
                                        <div class="w-full mx-2">
                                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="name">@lang('msg.name') *</label>
                                            {!! Form::text('name', null, ['class'  => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                                            @error('name')
                                            <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                                            @enderror
                                        </div>
                                        <div class="w-full mx-2">
                                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="email">@lang('msg.email')</label>
                                            {!! Form::email('email', null, ['class'  => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                                            @error('email')
                                            <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="items-center -mx-2 md:flex mb-6">
                                        <div class="w-full mx-2">
                                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="phone">@lang('models/contacts.fields.subject') *</label>
                                            {!! Form::text('subject', null, ['class'  => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
                                            @error('subject')
                                            <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                                            @enderror
                                        </div>
                                        <div class="w-full mx-2">

                                        </div>
                                    </div>

                                    <div class="items-center -mx-2 md:flex mb-6">
                                        <div class="w-full mx-2">
                                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="email">@lang('models/contacts.fields.message')</label>

                                            {!! Form::textarea('message', null, ['class' => 'block w-full text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('message') ? ' is-invalid' : ''), 'rows' => 5]) !!}
                                            @error('message')
                                            <span class="invalid-feedback"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                        <div class="w-full mx-2">
                                        </div>
                                    </div>


                                    <div class="flex mt-16">
                                        <input type="submit" value="@lang('msg.submit')" class="px-4 text-lg py-2 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
            </div>
        </div></div>
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
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush
