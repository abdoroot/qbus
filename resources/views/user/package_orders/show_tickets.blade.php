<div class="w-full sm:w-1/2">
    <div class="px-6">
        <span class="font-bold"> @lang('models/tickets.plural') : </span>
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-xs text-gray-500 text-left">
                        @lang('models/tickets.singular')
                    </th>
                    <th class="px-4 py-2 text-xs text-gray-500 text-left">
                        @lang('models/tickets.fields.seat_num')
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($packageOrder->tickets ?? [] as $ticket)
                <tr class="whitespace-nowrap">
                    <td class="px-4 py-2 text-sm text-gray-500">
                        {{ '#'.$ticket->id }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $ticket->seat_num }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
