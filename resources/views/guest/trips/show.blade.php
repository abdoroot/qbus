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
                {{ Session::get('trip') }}
            </span>
            @endif

            @include('guest.layouts.flash')
            
            @include('guest.trips.show_details')
            
            @include('guest.trips.order', ['tax_amount' => $tax_amount = ($fees = $trip->fees) * $tax / 100])
        </div>
        
        {{-- @include('guest.trips.reviews') --}} 
        


        {{-- @if($moreTrips->count() > 0)
        <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">@lang('msg.more_trips')</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach($moreTrips as $mTrip)
                {!! $mTrip->viewDiv('max-w-sm mx-auto lg:w-full overflow-hidden bg-white') !!}
                @endforeach
            </div>
        </div>
        @endif --}}

    </div>
</main>
@endsection

@push('page_scripts')
<script>

    $(document).ready(function(){
        updateFees(getTicketCount());
    });

   function getTicketCount(){
        let TicketCount = 0;
        TicketCount = parseInt($('#count-input').val());
        return TicketCount;
    };

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
    });
    $(document).on('click', '.increase-additional', function() {
        var id = $(this).data('additional-id');
        var input = '#count-' + id;
        var value = parseInt($(input).val()) + 1;
        $('#count-'+id).val(value);
        $('#span-'+id).text(value);
        updateFees(getTicketCount());
    })
    $(document).on('click', '.decrease-additional', function() {
        var id = $(this).data('additional-id');
        var input = '#count-' + id;
        var value = parseInt($(input).val()) - 1;
        if(value > 0) {
            $('#count-'+id).val(value);
            $('#span-'+id).text(value);
            updateFees(getTicketCount());
        }
    })

    $(document).on('change', '.additional', function() {
        updateFees(getTicketCount());
    });

    function additionalsFees() {
        let totalFees = 0;
        $(".additional").each(function() { 
            if(this.checked) {
                totalFees += parseFloat($(this).attr("fees")) * parseInt($('#count-'+$(this).val()).val());
            }
        });
        return totalFees;
    }

    function updateFees(count) {

        var fees = {{ $fees }} * count;
        var additionalFees = additionalsFees();
        var tax = {{ $tax_amount }} * count;
        $('#fees').text(fees);
        $('#additional').text(additionalFees);
        $('#tax').text(tax);
        $('#total').text(fees + tax + additionalFees);

    }
</script>
@endpush