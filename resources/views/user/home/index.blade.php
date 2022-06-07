@extends('guest.layouts.app')

@section('title', __('msg.home'))

@section('id', 'Home')

@section('content')
    <!-- Banner Section-->
    <div class="Banner">
        <div class="min-h-screen relative overflow-hidden">
            <div class="min-h-screen relative overflow-hidden"><img class="w-full h-full absolute left-0 top-0"
                    src="{{ $header_image }}" alt="">
                <div class="container mx-auto min-h-screen relative">
                    <div
                        class="item absolute text-white flex items-center justify-center flex-wrap text-center text-xl top-1/2 left-1/2 w-full">
                        <div class="mx-auto rounded-lg flex bg-white w-full flex flex-col py-4 shadow-md">
                            <h2 class="w-full mt-4 text-gray-900 text-lg mb-1 font-medium title-font">@lang('msg.header_form_title')</h2>
                            <div
                                class="md:px-8 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
                                @foreach(['one-way', 'round', 'multi', 'full'] as $type)
                                <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                                    <input id="{{ $type }}" type="radio" name="type"
                                        value="{{ $type }}"
                                        class="item-input px-4 py-2  mt-2 text-gray-700 bg-white border border-gray-200 rounded-md"
                                        @if($type == 'one-way') checked @endif>
                                    <label class="text-gray-700 dark:text-gray-200 ml-4" for="{{ $type }}">
                                      @lang('models/trips.types.'.$type)
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @include('user.home.one_way')
                            @include('user.home.multi')
                            @include('user.home.round')
                            @include('user.home.bus')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="container mx-auto text-center my-32">--}}
{{--        <h2 class="text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">{!! $section_title !!}</h2>--}}
{{--        <p class="mt-4 text-gray-600 dark:text-gray-400 text-lg">{{ $section_text }}</p>--}}
{{--        <div class="mt-8">--}}
{{--            <a href="{{ $section_link }}"--}}
{{--                class="px-5 py-2 font-semibold text-gray-100 transition-colors duration-200 transform bg-gray-900 rounded-md hover:bg-gray-700 text-2xl">--}}
{{--                @lang('msg.click_here')--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @include('guest.layouts.map')--}}

@endsection

@push('page_scripts')

<!-- Date Picker Plugin JavaScript -->
<script src="https://unpkg.com/flowbite@1.4.5/dist/datepicker.js"></script>
<script>

 $(function () {
   $(".item-input").on('click', function () {
        $(".itemForm").addClass('hidden')
        $(".itemForm."+$(this).attr('id')).removeClass('hidden');
   });

    $(".destination-repeat").on('click', function (e) {
        e.preventDefault(); // to prevent form submit
        var $self = $(this);
        $self.before($self.prev('.destination-item').clone()); // use prev() not parent()
    });

    $(document).on('click', ".destination-remove", function (e) {
        e.preventDefault(); // to prevent form submit
        $(this).closest('.destination-item').remove();
    });
 });
</script>
@endpush
