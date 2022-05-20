@extends('auth.layout')

@section('title', __('auth.registration.title'))

@section('id', 'Sign')

@section('content')
    <div class="flex items-center min-h-screen bg-gray-50 mb-8">
        <div class="flex-1 h-full mx-auto bg-white rounded-lg">
            <div class="flex flex-col md:flex-row">
                <div class="hidden bg-cover lg:block lg:w-1/2"
                    style="background-image: url(public/design/assets/img/40.jpg)">
                    <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                        <div>
                            <h2 class="text-4xl font-bold text-white">@lang('msg.register_side_title')</h2>
                            <p class="max-w-xl mt-3 text-gray-300 text-xl">@lang('msg.register_side_text')</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 lg:w-1/2">
                    <div class="w-full">
                        <h6 class="mb-4 text-sm">@lang('msg.step') 1/3</h6>
                        <h3 class="mb-4 text-xl font-bold text-blue-600">@lang('auth.registration.title')</h3>
                        <div class="flex flex-wrap mx-auto">
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider text-indigo-500 bg-gray-100 border-b-2 border-indigo-500 rounded-t sm:px-6 sm:w-auto sm:justify-start">
                                @lang('auth.register')
                            </a>
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider border-b-2 border-gray-200 sm:px-6 sm:w-auto sm:justify-start hover:text-gray-900">
                                @lang('auth.verify')
                            </a>
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider border-b-2 border-gray-200 sm:px-6 sm:w-auto sm:justify-start hover:text-gray-900">
                                @lang('auth.login.title')
                            </a>
                        </div>
                        <div class="mt-8">
                            {!! Form::open(['route' => 'register', 'type' => 'post', 'id' => 'registerform']) !!}
                                <div>
                                    {!! Form::label('name', __('models/users.fields.name').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <input type="text"
                                        name="name"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('name') border-red-500 @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="@lang('models/users.fields.name')">

                                    @error('name')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    {!! Form::label('email', __('models/users.fields.email').'('.__('msg.optional').')', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <input type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('email') border-red-500 @enderror"
                                        placeholder="@lang('models/users.fields.email')">

                                    @error('email')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    {!! Form::label('phone', __('models/users.fields.phone').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <input type="tel"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('phone') border-red-500 @enderror"
                                        placeholder="@lang('models/users.fields.phone')">
                                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            @lang('msg.verification_code_will_be_sent_to_your_phone_number')
                                        </p>

                                    @error('phone')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    {!! Form::label('address', __('models/users.fields.address').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <input type="text"
                                        name="address"
                                        value="{{ old('address') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('address') border-red-500 @enderror"
                                        placeholder="@lang('models/users.fields.address')">

                                    @error('address')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    {!! Form::label('date_of_birth', __('models/users.fields.date_of_birth').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input 
                                            datepicker 
                                            type="text" 
                                            name="date_of_birth"
                                            data-date="{{ old('date_of_birth') }}"
                                            datepicker-format="yyyy-mm-dd"
                                            {{-- value="{{ old('date_of_birth') }}" --}}
                                            class="@error('date_of_birth') border-red-500 @enderror 
                                                bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                            placeholder="@lang('models/users.fields.date_of_birth')">
                                    </div>
                                    @error('date_of_birth')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    {!! Form::label('password', __('models/users.fields.password').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <input type="password"
                                        name="password"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('password') border-red-500 @enderror"
                                        placeholder="@lang('models/users.fields.password')">
                                
                                    @error('password')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    {!! Form::label('password_confirmation', __('auth.confirm_password').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                    <input type="password"
                                        name="password_confirmation"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base"
                                        placeholder="@lang('auth.confirm_password')">
                                </div>

                                <div class="mt-6">
                                        {!! Form::label('marital_status', __('models/users.fields.marital_status').'*', ['class' => 'text-base text-gray-600 dark:text-gray-200']) !!}
                                        @foreach(['single', 'married'] as $maritalStatus)
                                        <div class="custom-control custom-radio">
                                            {!! Form::radio('marital_status', $maritalStatus, $maritalStatus == 'primary' && !isset($user) ? true : null, ['id' => "marital-status-{$maritalStatus}", 'class' => 'custom-control-input']) !!}
                                            {!! Form::label("marital-status-{$maritalStatus}", __("models/users.marital_status.{$maritalStatus}"), ['class' => "custom-control-label text-{$maritalStatus}"]) !!}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button
                                        class="text-base w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                        @lang('auth.register')</button>
                                </div>
                            {!! Form::close() !!}
                            <p class="mt-6 text-base text-center text-gray-400"> @lang('auth.registration.have_membership')  
                                <a href="{{ route('login') }}"
                                class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.sign_in')</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <!-- Date Picker Plugin JavaScript -->
    <script src="https://unpkg.com/flowbite@1.4.5/dist/datepicker.js"></script>
@endsection
