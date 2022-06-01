<div class="step-item hidden" id="step-2">
    <h1
        class="text-2xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-3xl dark:text-white">
        @lang('models/busOrders.datetime_title')
     </h1>
    <div class="triple">
        <div class="grid grid-cols-1 gap-6 my-16 sm:grid-cols-2">
            <div>
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="date_from">
                    @lang('models/busOrders.fields.date_from') :
                </label>
                <input id="date_from" type="date"
                    name="date_from"
                    value="{{ !is_null(old('date_from')) ? old('date_from') : Request::get('date_from') }}"
                    class="{{ $errors->has('date_from') ? 'border-red-500' : '' }} text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('date_from')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div>
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="date_to">
                    @lang('models/busOrders.fields.date_to') :
                </label>
                <input id="date_to" type="date"
                    name="date_to"
                    value="{{ !is_null(old('date_to')) ? old('date_to') : Request::get('date_from') }}"
                    class="{{ $errors->has('date_to') ? 'border-red-500' : '' }} text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('date_to')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div>
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="time_from">
                    @lang('models/busOrders.fields.time_from') :
                </label>
                <input id="time_from" type="time"
                    name="time_from"
                    value="{{ old('time_from') }}"
                    class="{{ $errors->has('time_from') ? 'border-red-500' : '' }} text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('time_from')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div>
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="time_to">
                    @lang('models/busOrders.fields.time_to') :
                </label>
                <input id="time_to" type="time"
                    value="{{ old('time_to') }}"
                    name="time_to"
                    class="{{ $errors->has('time_to') ? 'border-red-500' : '' }} text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('time_to')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="w-full">
            <label class="text-gray-700 dark:text-gray-200 text-xl mb-2" for="user_notes">
                @lang('models/busOrders.fields.user_notes') :
            </label>
            <textarea id="user_notes"
                name="user_notes"
                class="{{ $errors->has('user_notes') ? 'border-red-500' : '' }} w-full border-gray-700 border-2 text-lg p-4"
                cols="30" rows="5"
                placeholder="@lang('msg.do_you_have_any_notes?')">{{ old('user_notes') }}</textarea>
            @error('user_notes')
            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="buttons flex items-center justify-center text-center">
            <a
                class="back mt-8  cursor-pointer bg-gray-700 float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">
                @lang('pagination.previous')
            </a>
            <a
                class="mt-8 btn next cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
                href="#!">
                @lang('pagination.next')
            </a>
        </div>
    </div>
</div>