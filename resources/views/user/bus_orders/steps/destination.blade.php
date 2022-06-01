<div class="step-item hidden" id="step-3">
    <h1
        class="text-2xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-2xl dark:text-white">
        @lang('models/busOrders.destination_title')
     </h1>
    <div class="triple">
        <div class="col-sm-12 mb-3" id="destination">
            <!-- Repeater Heading -->
            <div class="repeater-heading mb-3">
                <h5 class="float-left text-lg text-left text-gray-800 capitalize lg:text-lg dark:text-white">
                    @lang('models/busOrders.fields.destination'):</h5>
                <button type="button" class="repeater-add-btn mb-3 mt-8 cursor-pointer float-right w-full px-3 py-2 m-1 text-base font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">
                    @lang('crud.add_new')
                </button>
            </div>
            <div class="clear-both"></div>
            <!-- Repeater Items -->
            <div class="items" data-group="destination">
                <!-- Repeater Content -->
                <div class="item-content">
                    <div class="mb-2 w-full">
                        {!! Form::select('destination', $cities, null, [
                            'class' => 'select2 destination' . ($errors->has('destination') ? ' border-red-500' : ''), 
                            'data-skip-name' => 'on']) !!}
                    </div>
                </div>
                <!-- Repeater Remove Btn -->
                <div class="float-right repeater-remove-btn">
                    <button  type="button" class="remove-btn cursor-pointer bg-red-700 float-right w-full px-3 py-2 m-1 text-sm font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-red-600 dark:bg-red-700 lg:w-auto hover:bg-red-700">
                        @lang('crud.remove')
                    </button>
                </div>
                <div class="clear-both"></div>
            </div>
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