@if(!is_null($userNotes = $tripOrder->user_notes))
<div class="w-full px-8 py-5">
    <h3 class="text-xl">@lang('models/tripOrders.fields.user_notes') :</h3>
    <ul class="text-xs list-disc list-inside">
        <li><p>{{ $userNotes }}</p></li>
    </ul>
</div>
@endif
@if(!is_null($providerNotes = $tripOrder->provider_notes))
<div class="w-full px-8 py-5">
    <h3 class="text-xl">@lang('models/tripOrders.fields.provider_notes') :</h3>
    <ul class="text-xs list-disc list-inside">
        <li><p>{{ $providerNotes }}</p></li>
    </ul>
</div>
@endif
@if(!is_null($userNotes) || !is_null($providerNotes))
<div class="w-full h-0.5 bg-indigo-500"></div>
@endif