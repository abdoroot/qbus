<div class="mb-2 mt-16 row flex flex-wrap justify-start overflow-hidden">
    <h1 class="text-3xl w-full font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">
        @lang('models/reviews.plural')
    </h1>
    @foreach($reviews as $review)
    <div
        class="my-2 shadow-lg rounded-t-8xl rounded-b-5xl w-full md:w-10/12 px-4 py-8 bg-white bg-opacity-40">
        <div class="flex flex-wrap items-center">
            <img class="mr-6 w-8 h-8 rounded-full object-cover" src="{{ !is_null($user = $review->user) ? asset('images/users/'.$user->image) : '' }}" alt="">
            <h4 class="w-full md:w-auto text-xl font-heading font-medium">{{ $review->name }}</h4>
            <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
            <span class="mr-4 text-xl font-heading font-medium">{{ $review->rate }}</span>
            <div class="inline-flex">
                @for($i = 1; $i <= 5; $i++)
                <a class="inline-block mr-1" href="javascript:;">
                    <svg class="w-5 h-5 text-gray-{{ $check = $i <= $review->rate ? '700' : '500' }} fill-current {{ $check ? 'dark:text-gray-300' : null }}"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                    </svg>
                </a>
                @endfor
            </div>
            <div class="flex items-center mt-1">
                <p class="text-lg text-gray-500">{{ $review->review }}</p>
            </div>
        </div>
    </div>
    @endforeach
    <div class="w-full md:w-1/2 p-6 text-lg">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">@lang('msg.add_review')</h2>
        {!! Form::open(['route' => 'packages.review']) !!}
            {!! Form::hidden('package_id', $package->id) !!}
            @if(Session::has('review'))
            <span class="flex items-center text-lg tracking-wide text-green-500 text-xs mt-1 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ Session::get('review') }}
            </span>
            @endif
            <div class="mt-4">
                <label class="text-gray-700 dark:text-gray-200" for="name">@lang('models/reviews.fields.name')</label>
                <input id="name" type="text"
                    value="{{ old('name') }}"
                    name="name"
                    class="{{ $errors->has('name') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('name')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mt-4">
                <label class="text-gray-700 dark:text-gray-200" for="emailAddress">@lang('models/reviews.fields.email')</label>
                <input id="emailAddress" type="email"
                    value="{{ old('email') }}"
                    name="email"
                    class="{{ $errors->has('email') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('email')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mt-4">
                <label class="text-gray-700 dark:text-gray-200" for="rate">@lang('models/reviews.fields.rate')</label>
                <select id="rate"
                    name="rate"
                    class="{{ $errors->has('rate') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @if(old('rate') == $i) selected @endif> {{ $i }} @if($i == 1) (@lang('msg.lowest')) @elseif($i == 5) (@lang('msg.heighest')) @endif</option>
                    @endfor
                </select>
                @error('rate')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mt-4">
                <label class="text-gray-700 dark:text-gray-200" for="comment">@lang('models/reviews.fields.review')</label>
                <textarea
                    value="{{ old('review') }}"
                    name="review"
                    class="{{ $errors->has('review') ? 'border-red-500' : '' }} block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"></textarea>
                @error('review')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="flex justify-end mt-6">
                <button
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                    @lang('crud.save')
                </button>
            </div>
        {!! Form::close() !!}
    </div>
</div>