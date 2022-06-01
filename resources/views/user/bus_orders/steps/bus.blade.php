<div class="step-item hidden" id="step-5">
    <h1
        class="text-2xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-2xl dark:text-white">
        @lang('models/busOrders.bus_title') </h1>
    <div class="row flex items-center justify-center flex-wrap max-h-screen overflow-y-scroll" id="buses">
        

    </div>
    <div class="buttons flex items-center justify-center text-center">
        <a
            class="back mt-8  cursor-pointer bg-gray-700 float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">
            @lang('pagination.previous')
        </a>
        <button type="submit"
            class="mt-8 btn cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">
            @lang('crud.submit')
        </button>
    </div>
</div>