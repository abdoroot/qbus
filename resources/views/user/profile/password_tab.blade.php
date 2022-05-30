<div class="tab-pane {{ $active == 'password' ? 'active' : '' }}" id="password" role="tabpanel">
    <div class="card-body">
        {!! Form::model($user, ['route' => 'profile.password']) !!}
            <div class="row">
                <!-- Current Password Field -->
                <div class="items-center -mx-2 md:flex mb-6">
                <div class="w-full mx-2">
                    {!! Form::label('current_password', __('msg.current_password') . ':',["class" => "block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200"]) !!}
                    {!! Form::password('current_password', ['id' => 'current_password', 'class' => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('current_password') ? ' is-invalid' : '')]) !!}
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><div class="w-full mx-2"></div>
                </div>

                <div class="items-center -mx-2 md:flex mb-6">
                <!-- New Password Field -->
                <div class="w-full mx-2">
                    {!! Form::label('password', __('msg.new_password') . ':',["class" => "block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200"]) !!}
                    {!! Form::password('password', ['id' => 'password', 'class' => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('password') ? ' is-invalid' : '')]) !!}
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <div class="w-full mx-2"></div>
                </div>
                <!-- Password Confirmation Field -->
                <div class="items-center -mx-2 md:flex mb-6">
                <div class="w-full mx-2">
                    {!! Form::label('password_confirmation', __('msg.confirm_password') . ':',["class" => "block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200"]) !!}
                    {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40' . ($errors->has('password_confirmation') ? ' is-invalid' : '')]) !!}
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><div class="w-full mx-2"></div>
                </div>
                <div class="flex mt-16">
                    <input type="submit" value="@lang('msg.submit')" class="px-4 text-lg py-2 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>


