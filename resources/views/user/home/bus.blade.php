<div class="full itemForm hidden">
    {!! Form::open(['route' => 'busOrders.create', 'method' => 'get']) !!}
    {!! Form::hidden('type', 'one-way') !!}
    <div
        class="main md:p-8 md:pt-0 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
        <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
        <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">@lang('msg.from') :</label>
            {!! Form::select(
                'from_city_id', 
                $cities, 
                null, 
                [
                    'class' => 'text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring',
                    'placeholder' => __('msg.select')
                ])
            !!}
        </div>
        <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
            <label class="text-gray-700 dark:text-gray-200 text-xl" for="">@lang('msg.to') :</label>
            {!! Form::select(
                'to_city_id', 
                $cities, 
                null, 
                [
                    'class' => 'text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring',
                    'placeholder' => __('msg.select')
                ])
            !!}
        </div>
        <div class="relative mb-4 text-left  w-full md:w-1/4 p-2">
            <label class="text-gray-700 dark:text-gray-200 text-xl" for="date_from">
                @lang('msg.departure_date') :
            </label>
            <input 
                datepicker 
                type="text" 
                name="date_from"
                id="date_from"
                datepicker-format="yyyy-mm-dd"
                class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" 
                placeholder="YYYY-MM-DD">
        </div>
        <div class="relative mb-4 w-full md:w-1/4 p-2">
            <button type="submit"
            class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                @lang('crud.submit')
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>