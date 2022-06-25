<div class="my-5">
    <a href="{{ route('tripOrders.index') }}"
    class="{{ Request::is('tripOrders*') ? 'bg-blue-700 text-white' : 'bg-white text-blue-700' }} border-2 border-blue-700 px-4 mx-2 text-lg py-2 transition-colors duration-200 transform rounded-md hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-500">
        @lang('models/tripOrders.plural')
    </a>
    <a href="{{ route('packageOrders.index') }}"
    class="{{ Request::is('packageOrders*') ? 'bg-blue-700 text-white' : 'bg-white text-blue-700' }} border-2 border-blue-700 px-4 mx-2 text-lg py-2 transition-colors duration-200 transform rounded-md hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-500">
        @lang('models/packageOrders.plural')
    </a>
    <a href="{{ route('busOrders.index') }}"
    class="{{ Request::is('busOrders*') ? 'bg-blue-700 text-white' : 'bg-white text-blue-700' }} border-2 border-blue-700 px-4 mx-2 text-lg py-2 transition-colors duration-200 transform rounded-md hover:bg-blue-700 hover:text-white focus:outline-none focus:bg-blue-500">
        @lang('models/busOrders.plural')
    </a>
</div>