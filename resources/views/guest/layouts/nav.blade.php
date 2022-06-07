<nav class="bg-white shadow overflow-hidden md:overflow-visible">
    <div class="container px-6 py-4 mx-auto">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <div class="text-xl font-semibold text-gray-700">
                    <a class="text-2xl font-bold text-gray-800 transition-colors duration-200 transform dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300"
                        href="{{ route('home') }}">
                        <img src="{{ $app_logo }}" alt="@lang('msg.app_name')" style="max-height: 23px;" />
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button"
                        class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400 text-2xl mr-4">AR</button>
                    <button type="button"
                        class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                        aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div class="flex-1 md:flex md:items-center md:justify-between relative ">
                <div class="flex flex-col -mx-4 md:flex-row md:items-center md:mx-8">
                    <a href="{{ route('home') }}"
                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 homeLink">
                        @lang('msg.home')
                    </a>
                    <a href="{{ route('about') }}"
                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 aboutLink">
                        @lang('msg.about')
                    </a>
                    <a href="{{ route('trips.index') }}"
                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 triplesLink">
                        @lang('models/trips.plural')
                    </a>
                    <a href="{{ route('packages.index') }}"
                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 packagesLink">
                        @lang('models/packages.plural')
                    </a>
                    <a href="{{ route('code') }}"
                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 codeLink">
                        @lang('msg.code')</a>

{{--                    <a href="{{ route('services') }}"--}}
{{--                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 servicesLink">--}}
{{--                        @lang('models/services.plural')</a>--}}

                    <a href="{{ route('contact') }}"
                        class="px-2 py-1 mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700 contactLink">
                        @lang('msg.contact')
                    </a>
                </div>
                <div class="flex md:items-center mt-4 md:mt-0 flex-col md:flex-row md:flex-nowrap items-start">
                    @if(!Auth::check())
                    <a href="{{ route('login') }}"
                        class="loginLink px-2 py-1 md:mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700">
                        @lang('auth.sign_in')
                    </a>
                    <a href="{{ route('register') }}"
                        class="signLink px-2 py-1 md:mx-2 mt-2 text-lg font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:text-blue-700 dark:hover:bg-gray-700">
                        @lang('auth.sign_up')
                    </a>
                    @endif
                    <div class="relative hidden md:inline-block text-2xl overflow-hidden language">
                        <!-- Dropdown toggle button -->
                        <button class="relative z-10 flex items-center p-2 text-lg text-gray-600">
                            <span class="px-2 py-1 mt-2 text-lg font-medium text-gray-700  md:mt-0  hover:text-blue-700">{{ strtoupper(App::getLocale()) }}</span>
                            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="absolute right-0 z-20 w-56 py-2 overflow-hidden bg-white rounded-md shadow-xl ">
                            @foreach($locales as $locale)
                            <a href="{{ route('localization', ['locale' => $locale]) }}" class="block px-4 py-3 text-lg text-gray-600 hover:bg-gray-100"> {{ strtoupper($locale) }} </a>
                            @endforeach
                        </div>
                    </div>
                    @if(Auth::check())
                    <button type="button" class="flex items-center focus:outline-none mt-4 md:mt-0"
                        aria-label="toggle profile dropdown">
                        <div class="w-8 h-8 overflow-hidden border-2 border-gray-400 rounded-full">
                            <a href="{{ route('profile.index') }}">
                                <img src="{{ file_exists(public_path('images/users/' . Auth::user()->image)) ? asset('images/users/' . Auth::user()->image):asset('images/users/default-user-image.png') }}"class="object-cover w-full h-full" alt="avatar">
                            </a>
                        </div>
                        <h3 class="mx-2 text-lg font-medium text-gray-700 dark:text-gray-200 md:hidden">{{ Auth::user()->name }}</h3>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
