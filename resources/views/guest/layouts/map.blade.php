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