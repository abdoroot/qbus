<div class="tab-pane {{ $active == 'settings' ? 'active' : '' }}" id="settings" role="tabpanel">
    <h2 class="font-bold">Settings</h2><div class="mt-6 ">
    <div class="card-body">
        {!! Form::model($user, ['route' => 'profile.settings', 'files' => 'on']) !!}
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
                        <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="phone">@lang('msg.phone') *</label>
                        {!! Form::text('phone', null, ['class'  => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
                        @error('phone')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="w-full mx-2">
                        <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="date_of_birth">@lang('msg.date_of_birth') *</label>
                        {!! Form::date('date_of_birth', null, ['class' => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('date_of_birth') ? ' is-invalid' : '')]) !!}
                        @error('date_of_birth')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="items-center -mx-2 md:flex mb-6">
                    <div class="w-full mx-2">
                        <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="address">@lang('msg.address') *</label>
                        {!! Form::text('address', null, ['class'  => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('address') ? ' is-invalid' : '')]) !!}
                        @error('address')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="w-full mx-2">
                        <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200" for="image">@lang('msg.image') </label>
                        <div class="custom-file">
                            {!! Form::file('image', ['id' => 'image', 'class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
                            <label class="custom-file-label" data-browse="@lang('msg.browse')" for="image">
                                @if(!is_null($user->image)) {{ $user->image }} @else @lang('msg.upload_file') @endif
                            </label>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('image') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('text', __('models/users.fields.marital_status').'*', ['class' => 'control-label']) !!}
                        @foreach(['single', 'married'] as $maritalStatus)
                        <div class="custom-control custom-radio">
                            {!! Form::radio('marital_status', $maritalStatus, $maritalStatus == 'primary' && !isset($user) ? true : null, ['id' => "marital-status-{$maritalStatus}", 'class' => 'custom-control-input']) !!}
                            {!! Form::label("marital-status-{$maritalStatus}", __("models/users.marital_status.{$maritalStatus}"), ['class' => "custom-control-label text-{$maritalStatus}"]) !!}
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex mt-16">
                    <input type="submit" value="@lang('msg.submit')" class="px-4 text-lg py-2 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

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
