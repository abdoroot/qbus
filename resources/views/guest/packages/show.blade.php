@extends('guest.layouts.app')

@section('title', $package->name)

@section('id', 'packagele')

@section('content')
<main class="my-8">
    <div class="container mx-auto px-6">

        @include('guest.packages.show_header', [
            'provider' => $provider = $package->provider,
        ])

        <div class="row flex items-start justify-center mt-16 flex-wrap">
            @if(Session::has('package'))
            <span class="w-full items-center text-base tracking-wide bg-green-500 mt-1 mb-3 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ Session::get('package') }}
            </span>
            @endif
            
            @include('guest.packages.show_details')
            
            @include('guest.packages.order', ['tax_amount' => $tax_amount = ($fees = $package->fees) * $tax / 100])
        </div>

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