<!-- Map Section-->
<section class="text-gray-600 body-font relative md:mt-32 text-lg">
    <div class="absolute inset-0 bg-gray-300">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map"
            scrolling="no"
            src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=%C4%B0zmir+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
            style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
    </div>
    <div class="container px-5 py-24 mx-auto flex">
        <div
            class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ $app_feedback_title }}</h2>
            <p class="leading-relaxed mb-5 text-gray-600">{{ $app_feedback_subtitle }}</p>
            {!! Form::open(['route' => 'contacts.store', 'method' => 'POST']) !!}
            {!! Form::hidden('type', 'feedback') !!}
            {!! Form::hidden('name', 'unkown') !!}
            {!! Form::hidden('subject', 'Feedback') !!}
            @if(Session::has('feedback'))
            <span class="flex items-center text-lg tracking-wide text-green-500 text-xs mt-1 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ Session::get('feedback') }}
            </span>
            @endif
            <div class="relative mb-4">
                <label for="email" class="leading-7 text-lg text-gray-600">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="{{ $errors->has('email') ? 'border-red-500' : '' }} w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                @error('email')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="relative mb-4">
                <label for="message" class="leading-7 text-lg text-gray-600">Message</label>
                <textarea id="message" name="message" value="{{ old('email') }}"
                    class="{{ $errors->has('email') ? 'border-red-500' : '' }} w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                @error('email')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button
                class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">@lang('msg.send_your_feedback')</button>
            <p class="text-xs text-gray-500 mt-3">{{ $app_feedback_footer }}</p>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<!-- end Map -->
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