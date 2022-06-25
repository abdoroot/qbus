@extends('guest.layouts.app')

@section('content')
    <div class="row">
        <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
            <div class="w-full md:w-1/4 min-h-screen py-8 border-r">
                @php $page = "profile.orders"; @endphp
                @include('user.profile.menu', ['user' => Auth::user()])
            </div>

            <div class="w-full md:w-3/4 p-4 md:p-8">
                @include('guest.layouts.flash')
                <div class="profileTap">
                    <h2 class="font-bold mt-5">@lang('models/packageOrders.singular') {{ '#'.$packageOrder->id }}</h2>
                    <div class="order-view mt-5">
                        @include('user.package_orders.show_fields')
                    </div>
                    <div class="order-view hidden">
                        @include('user.package_orders.edit')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
@endsection

@push('page_scripts')
<script src="{{ asset('elite/dist/js/pages/jquery.PrintArea.js') }}" type="text/JavaScript"></script>
<script>
$(document).ready(function() {
    $("#print").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });

    $(document).on('click', '.toggle-view', function() {
        $('.order-view').toggleClass('hidden');
    })
});
</script>
@endpush