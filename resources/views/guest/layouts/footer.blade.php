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
<footer class="bg-white dark:bg-gray-800">
    <div class="container px-6  mx-auto">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl">{{ $app_links_title }}</div>
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
                <div class="text-xs font-medium text-gray-400 uppercase text-xl">{{ $app_social_title }}</div>
                @foreach($socials as $i => $social)
                <a href="{{ $social->value }}"
                    class="block mt-{{ $i == 0 ? '5' : '3' }} text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ __('models/settings.keys.'.$social->key) }} </a>
                @endforeach
            </div>
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl">{{ $app_contact_title }}</div>
                <a href="#"
                    class="block mt-5 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_phone }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_email }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_location }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_email2 }} </a>
                <a href="#"
                    class="block mt-3 text-lg font-medium text-gray-500 duration-700 dark:text-gray-300 hover:text-gray-400 dark:hover:text-gray-200 hover:underline">
                    {{ $app_phone2 }} </a>
            </div>
            <div>
                <div class="text-xs font-medium text-gray-400 uppercase text-xl"> {{ $app_provider_title }} </div>
                <p class="text-xs font-small text-gray-600 text-sm"> {{ $app_provider_subtitle }} </p>
                
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
                <a href="http://acoad.net" class="block mx-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"
                    aria-label="Reddit">
                    <p class="text-lg text-gray-400 text-center md:text-left">
                        @if(App::isLocale('ar'))
                        تمت البرمجة بواسطة<strong> أكواد </strong>
                        @else
                        Developed By <strong> Acoad </strong>
                        @endif
                    </p>
                </a>
            </div>
        </div>
    </div>
</footer>