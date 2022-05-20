@extends('guest.layouts.app')

@section('title', $trip->name)

@section('id', 'triple')

@section('content')
<main class="my-8">
    <div class="container mx-auto px-6">

        @include('guest.trips.show_header', [
            'destination' => $destination = $trip->destination,
            'provider' => $provider = $trip->provider,
        ])

        <div class="row flex items-start justify-center mt-16 flex-wrap">
            @if(Session::has('trip'))
            <span class="w-full items-center text-base tracking-wide bg-green-500 mt-1 mb-3 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ Session::get('trip') }}
            </span>
            @endif
            
            @include('guest.trips.show_details')
            
            @include('guest.trips.order', ['tax_amount' => $tax_amount = ($fees = $trip->fees) * $tax / 100])
        </div>
        
        @include('guest.trips.reviews')
        
        @if($moreTrips->count() > 0)
        <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">@lang('msg.more_trips')</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach($moreTrips as $mTrip)
                {!! $mTrip->viewDiv('max-w-sm mx-auto lg:w-full overflow-hidden bg-white') !!}
                @endforeach
            </div>
        </div>
        @endif
    </div>
</main>
@endsection

@push('page_scripts')
<script>
    $(document).on('click', '#increase-count', function() {
        var value = parseInt($('#count-input').val()) + 1;
        $('#count-input').val(value);
        $('#count-span').text(value);
        updateFees(value);
    })
    $(document).on('click', '#decrease-count', function() {
        var value = parseInt($('#count-input').val()) - 1;
        if(value > 0) {
            $('#count-input').val(value);
            $('#count-span').text(value);
            updateFees(value);
        }
    })
    function updateFees(count) {
        var fees = {{ $fees }} * count;
        var tax = {{ $tax_amount }} * count;
        $('#fees').text(fees);
        $('#tax').text(tax);
        $('#total').text(fees + tax);
    }
</script>
@endpush