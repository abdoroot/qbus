<!-- end Map -->
{{-- email subscription
<footer class="flex justify-center px-4 text-gray-800 bg-white dark:text-white dark:bg-gray-800">
    <div class="container py-6">



        <h1 class="text-lg font-bold text-center lg:text-2xl"> {{ $app_email_title }} <br> </h1>
        @if(Session::has('email'))
        <span class="w-full flex justify-center items-center text-lg tracking-wide text-green-500 text-xs mt-1 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ Session::get('email') }}
        </span>
        @endif


        <div class="flex justify-center mt-6">
            <div
                class="bg-white border rounded-md focus-within:ring dark:bg-gray-800 dark:border-gray-600 focus-within:border-blue-400 focus-within:ring-blue-300 focus-within:ring-opacity-40 dark:focus-within:border-blue-300">
                {!! Form::open(['route' => 'email', 'method' => 'POST']) !!}
                    <div class="flex flex-wrap justify-between md:flex-row">
                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('name') ? 'border-red-500' : '' }} p-2 m-1 text-lg text-gray-700 bg-transparent appearance-none focus:outline-none focus:placeholder-transparent"
                            placeholder="@lang('msg.enter_your_email')" aria-label="@lang('msg.enter_your_email')">
                        @error('email')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            {{ $message }}
                        </span>
                        @enderror
                        <button
                            class="w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">
                            @lang('crud.subscribe')
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</footer>
--}}
<footer class="bg-white dark:bg-gray-800 mt-20">
    <div class="container px-6  mx-auto">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl">@lang('msg.links')</div>
                <a href="{{ route('home') }}"
                    class="block mt-5 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    @lang('msg.home') </a>
                <a href="{{ route('about') }}"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    @lang('msg.about') </a>
                <a href="{{ route('services') }}"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    @lang('msg.services') </a>
                <a href="{{ route('contact') }}"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    @lang('msg.contact') </a>
            </div>
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl">@lang('msg.app_links')</div>
                <a href="{{ $app_store }}"
                    class="block mt-5">
                    <img src="{{ asset('images/settings/app_store.png') }}" class="h-14 w-2/3" />
                </a>
                <a href="{{ $google_play }}"
                    class="block mt-5">
                    <img src="{{ asset('images/settings/google_play.png') }}" class="h-14 w-2/3" />
                </a>
            </div>
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl">@lang('msg.contact')</div>
                <a href="#"
                    class="block mt-5 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_location }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_phone }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_email }} </a>
                {{-- <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_email2 }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_phone2 }} </a> --}}
                <div class="mt-3">
                    @foreach($socials as $i => $social)
                    <a href="{{ $social->value }}"
                        class="inline-block px-1 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                        @if($social->key == 'facebook')
                        <svg
                            class="w-6 h-6 text-blue-600 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                            />
                        </svg>
                        @elseif($social->key == 'twitter')
                        <svg
                            class="w-6 h-6 text-blue-300 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"
                            />
                        </svg>
                        @elseif($social->key == 'instagram')
                        <img src="{{ asset('images/settings/instagram.svg') }}" class="w-6 h-6"  />
                        @elseif($social->key == 'youtube')
                        <svg
                            class="w-6 h-6 text-red-600 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16">
                            <path
                                d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                        </svg>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl"> @lang('msg.links')</div>
{{--                <p class="text-xs font-small text-gray-600 text-sm"> {{ $app_provider_subtitle }} </p>--}}

                <a href="{{ route('provider.login') }}"
                    class="block mt-5 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    @lang('auth.login.provider') </a>
                <a href="{{ route('provider.register') }}"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    @lang('auth.registration.title') </a>
            </div>
        </div>
        <hr class="my-4 border-gray-200 dark:border-gray-700">
        <div class="sm:flex sm:items-center sm:justify-between py-6">
            <p class="text-lg text-gray-400 text-center md:text-left">{{ $app_copyright }}
            </p>
            <div class="flex mt-3 -mx-2 sm:mt-0 justify-center md:justify-start">

            </div>
        </div>
    </div>
</footer>
