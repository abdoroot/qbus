<div class="multi itemForm hidden">
    {!! Form::open(['route' => 'trips.index', 'method' => 'get']) !!}
        {!! Form::hidden('type', 'multi') !!}
        <div
            class="destination-item main md:p-8 md:py-0 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
            <div class="relative mb-4 md:mb-0 text-left w-full md:w-1/5 p-2">
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">@lang('msg.from') :</label>
                {!! Form::select(
                    'destination[from_city_id][]', 
                    $cities, 
                    null, 
                    [
                        'class' => 'text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring',
                        'placeholder' => __('msg.select')
                    ])
                !!}
            </div>
            <div class="relative mb-4 md:mb-0 text-left w-full md:w-1/5 p-2">
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="">@lang('msg.to') :</label>
                {!! Form::select(
                    'destination[to_city_id][]', 
                    $cities, 
                    null, 
                    [
                        'class' => 'text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring',
                        'placeholder' => __('msg.select')
                    ])
                !!}
            </div>
            <div class="relative mb-4 md:mb-0 text-left w-full md:w-1/5 p-2">
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="">
                    @lang('msg.departure_date') :
                </label>
                <input 
                    datepicker 
                    type="text" 
                    name="destination[date_from][]"
                    datepicker-format="yyyy-mm-dd"
                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" 
                    placeholder="YYYY-MM-DD">
            </div>
            <div class="relative mb-4 text-left w-full md:w-1/5 p-2">
                <label class="text-gray-700 dark:text-gray-200 text-xl" for="">
                    @lang('models/coupons.singular') :
                </label>
                <input 
                    type="text" 
                    name="destination[code][]"
                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" 
                    placeholder="@lang('models/coupons.fields.code')">
            </div>
            <div class="relative mb-4 md:mb-0 text-left w-full md:w-1/5 p-2">2
                <label class="text-white" for=" "> .</label>
                <button type="button"
                    class="destination-remove block text-white text-center bg-red-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">
                    @lang('curd.remove')
                </button>
            </div>
        </div>
        <button class="destination-repeat mx-8 mt-5 block text-left text-gray-700">
            @lang('msg.add_another_destination')
        </button>
        <div class="relative mb-4 mx-8 md:mb-0 text-center w-full md:w-1/5 p-2">
            <label class="text-white" for=" "> .</label>
            <button type="submit"
                class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                @lang('curd.submit')
            </button>
        </div>
    {!! Form::close() !!}
</div>