<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full bg-white printableArea">
        @include('user.package_orders.show_header')
        
        @include('user.package_orders.show_details')

        @include('user.package_orders.show_tickets')
        
        @include('user.package_orders.show_total')

        @include('user.package_orders.show_footer')
        <div class="p-4">
            <div class="flex items-center justify-center">
                @lang('msg.thank_you_for_doing_business_with_us')
            </div>
        </div>
    </div>
</div>

<div class="flex items-end justify-end space-x-3 mt-5">
    <button class="px-4 py-2 text-sm text-white bg-purple-600" id="print">@lang('crud.print')</button>
    @if(in_array($packageOrder->status, ['pending', 'approved']))
    <a href="#" class="px-4 py-2 text-sm text-white bg-red-600 toggle-view">@lang('crud.cancel')</a>
    @endif
    <a href="{{ route('packageOrders.index') }}" class="px-4 py-2 text-sm text-white bg-gray-600">@lang('crud.back')</a>
</div>