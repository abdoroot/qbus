<div class="w-full md:w-1/3 p-4">
    <div class="w-full mx-auto border rounded-lg md:mx-4 text-xl p-6">
        <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/tripOrders.fields.count'):</label>
        <div class="block w-full items-center mt-1">
            {!! Form::open(['route' => 'tripOrders.store', 'id' => 'order-form']) !!}
                {!! Form::hidden('trip_id', $trip->id) !!}
                {!! Form::hidden('count', 1, ['id' => 'count-input']) !!}
                <button type="button" class="text-gray-500 focus:outline-none focus:text-gray-600 mt-2" id="increase-count">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </button>
                <span class="text-gray-700 text-lg mx-2 mt-2" id="count-span">1</span>
                <button type="button" class="text-gray-500 focus:outline-none focus:text-gray-600 mt-2" id="decrease-count">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </button>
                <div class="mt-4">
                    <div>
                        @foreach(['one-way', 'round', 'multi'] as $i => $type)
                        <div class="form-check">
                            {!! Form::radio('type', $type, is_null(old('type')) && $i == 0 ? true : null, [
                                'class' => 'form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer',
                                'id' => 'type-'.$type
                            ]) !!}
                            <label class="form-check-label inline-block text-gray-800" for="type-{{ $type }}">
                                @lang('models/TripOrders.types.'.$type)
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <label class="text-gray-700 dark:text-gray-200" for="comment">@lang('models/tripOrders.fields.user_notes')</label>
                    <textarea
                        value="{{ old('user_notes') }}"
                        name="user_notes"
                        class="{{ $errors->has('user_notes') ? 'border-red-500' : '' }} block w-full h-20 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"></textarea>
                    @error('user_notes')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="text-gray-700 dark:text-gray-200" for="name">@lang('models/coupons.fields.code')</label>
                    <input id="code" type="text"
                        value=""
                        name="code"
                        class="{{ $errors->has('code') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    @error('code')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="mt-5">
                    <strong>@lang('models/tripOrders.fields.fees') : </strong>
                    <span id="fees"
                        class="mx-2 text-gray-600">{{ $fees = $trip->fees }}</span>
                </div>
                <div class="mt-3">
                    <strong>@lang('models/tripOrders.fields.tax') : </strong>
                    <span id="tax"
                        class="mx-2 text-gray-600">{{ $tax_amount }}</span>
                </div>
                <div class="mt-2">
                    <strong>@lang('models/tripOrders.fields.total') : </strong>
                    <span id="total"
                        class="mx-2 text-gray-600">{{ $fees + $tax_amount }}</span>
                </div>
                <div class="flex mt-5">
                    <button
                        class="px-8 py-2 bg-indigo-600 text-white text-xl font-bold  font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">
                        @lang('msg.submit_orders')
                    </button>
                    <button type="button" title="@lang('msg.add_to_compare_list')"
                        class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>