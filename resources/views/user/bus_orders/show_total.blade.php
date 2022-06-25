<div class="w-full">
    <div class="border-b border-gray-200 shadow">
        <table class="w-full">
            <tbody class="bg-white">
                <tr class="border-t-2 whitespace-nowrap">
                    <td class="text-sm font-bold px-8 pt-5">@lang('models/busOrders.fields.fees')</td>
                    <td class="text-sm font-bold tracking-wider"><b>{{ $busOrder->fees }}</b></td>
                </tr>
                <!--end tr-->
                <tr>
                    <td class="text-sm font-bold pb-5 px-8">@lang('models/busOrders.fields.tax')</td>
                    <td class="text-sm font-bold"><b>{{ $busOrder->tax }}</b></td>
                </tr>
                <!--end tr-->
                <tr class="text-white bg-gray-800">
                    <td class="text-sm font-bold py-5 px-8">@lang('models/busOrders.fields.total')</td>
                    <td class="text-sm font-bold"><b>{{ $busOrder->total }}</b></td>
                </tr>
                <!--end tr-->

            </tbody>
        </table>
    </div>
</div>