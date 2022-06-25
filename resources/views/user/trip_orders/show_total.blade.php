<div class="w-full">
    <div class="border-b border-gray-200 shadow">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-xs text-gray-500 text-left">
                        @lang('msg.item')
                    </th>
                    <th class="px-4 py-2 text-xs text-gray-500 text-left">
                        @lang('models/tripOrders.fields.count')
                    </th>
                    <th class="px-4 py-2 text-xs text-gray-500 text-left">
                        @lang('models/trips.fields.fees')
                    </th>
                    <th class="px-4 py-2 text-xs text-gray-500 text-left">
                        @lang('models/tripOrders.fields.fees')
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="border-b-2">
                    <td class="px-6 py-2">@lang('models/tickets.plural')</td>
                    <td>{{ $tripOrder->count }}</td>
                    <td>{{ !is_null($trip = $tripOrder->trip) ? $trip->fees : '-' }}</td>
                    <td>{{ $tripOrder->fees }}</td>
                </tr>
                @if(!empty($additionals = $tripOrder->additionals()))
                <tr>
                    <th class="text-left px-6 py-3" colspan="4">+ @lang('models/trips.fields.additional') :</th>
                </tr>
                    @foreach($additionals as $additional)
                    <tr class="">
                        <td class="px-6 py-2">
                            @if(!is_null($addition = $additional['additional'])) {{ $addition->name }} @else {{ $additional['id'] }} @endif
                        </td>
                        <td>{{ $additional['count'] }}</td>
                        <td>{{ $additional['fees'] }}</td>
                        <td>{{ $additional['count'] * $additional['fees'] }}</td>
                    </tr>
                    @endforeach
                @endif
                <tr class="border-t-2 whitespace-nowrap">
                    <td colspan="2"></td>
                    <td class="text-sm font-bold px-8 pt-5">@lang('models/tripOrders.fields.fees')</td>
                    <td class="text-sm font-bold tracking-wider"><b>{{ $tripOrder->fees }}</b></td>
                </tr>
                <!--end tr-->
                @if(!is_null($tripOrder->additionalFees))
                <tr>
                    <td colspan="2"></td>
                    <td class="text-sm font-bold px-8">@lang('models/tripOrders.fields.additional')</td>
                    <td class="text-sm font-bold"><b>{{ $tripOrder->additionalFees }}</b></td>
                </tr>
                @endif
                @if(!is_null($coupon = $tripOrder->coupon))
                <tr>
                    <td colspan="2"></td>
                    <td class="text-sm font-bold px-8">@lang('models/tripOrders.fields.coupon_id')</td>
                    <td class="text-sm font-bold">{{ $coupon->name }} <b>( {{ $tripOrder->discount }} )</b></td>
                </tr>
                @endif
                <tr>
                    <td colspan="2"></td>
                    <td class="text-sm font-bold pb-5 px-8">@lang('models/tripOrders.fields.tax')</td>
                    <td class="text-sm font-bold"><b>{{ $tripOrder->tax }}</b></td>
                </tr>
                <!--end tr-->
                <tr class="text-white bg-gray-800">
                    <td colspan="2"></td>
                    <td class="text-sm font-bold py-5 px-8">@lang('models/tripOrders.fields.total')</td>
                    <td class="text-sm font-bold"><b>{{ $tripOrder->total }}</b></td>
                </tr>
                <!--end tr-->

            </tbody>
        </table>
    </div>
</div>