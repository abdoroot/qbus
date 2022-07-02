@push('page_scripts')
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Import repeater js  -->
<script src="{{ asset('js/repeater.js') }}" type="text/javascript"></script>
<!-- Toast -->
<script src="{{ asset('elite/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>

@include('user.components.map')

<script>
    var triggerUpdateProviders = "{{ is_null(old('provider_id')) }}" ? true : false;

    $(document).on('change', '.destination', function () {
        triggerUpdateProviders = true;
    })

    $(document).on('click', '#destination .repeater-add-btn, #destination .remove-btn', function() {
        triggerUpdateProviders = true;
    })
    
    $(document).ready(function() {
console.log(triggerUpdateProviders);
        if(!triggerUpdateProviders) {
            updateProviders("{{ old('provider_id') }}");
            updateBuses("{{ old('provider_id') }}", "{{ old('bus_id') }}");
        }

        /* Create Repeater */
        @if(!is_null(old('destination')))
        values = {!! json_encode(array_map(function($city_id, $index) {
            return ['destination['.$index.']' => $city_id];
        }, old('destination'), array_keys(old('destination')))) !!};
        @elseif(!is_null($from_city_id = Request::get('from_city_id')) || !is_null(Request::get('to_city_id')))
        values = [
            {'destination[0]': {{ $from_city_id }}},
            {'destination[1]': {{ Request::get('to_city_id') }}},
        ];
        @elseif(isset($busOrder))
        values = {!! json_encode(array_map(function($city_id, $index) {
            return ['destination['.$index.']' => $city_id];
        }, $busOrder->destination, array_keys($busOrder->destination))) !!};
        @else
        values = [
            {'destination[0]': null},
            {'destination[1]': null},
        ];
        @endif

        $("#destination").createRepeater({
            showFirstItemToDefault: true,
            disableFirstItemRemoveButton: true,
            values: values
        });

        $('.step-item .next').click(function () {
            var item = $(this).closest('.step-item'); 
            var id = item.attr('id');
            var i = id.substring(id.indexOf('-') + 1);
            $(`li.i-${i}`).addClass('done')
            item.addClass('hidden')
            $(`.step-item#step-${parseInt(i)+1}`).removeClass('hidden');

            if(i == 4 && triggerUpdateProviders) {
                updateProviders();
            }
        })

        $('ul.step-list li').on('click', function() {
            var i = parseInt($(this).text());
            $(this).prevAll().addClass('done');
            $(`.step-item`).addClass('hidden')
            $(`.step-item#step-${i}`).removeClass('hidden');
            if(i == 4 && triggerUpdateProviders) {
                updateProviders();
            }
        })

        $('.step-item .back').click(function () {
            var item = $(this).closest('.step-item');
            var id = item.attr('id');
            var i = id.substring(id.indexOf('-') + 1);
            $(`li.i-${i}`).addClass('done')
            item.addClass('hidden')
            $(`.step-item#step-${i-1}`).removeClass('hidden');
            if(i == 4 && triggerUpdateProviders) {
                updateProviders();
            }
        })

        $(document).on('click', '.busItem', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var bus_id = $(this).data('id');
            $('#bus_id').val(bus_id);
        })
        $(document).on('click', '.companyItem', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var provider_id = $(this).data('id'); console.log(provider_id);
            $('#provider_id').val(provider_id);
            $('#buses').empty();
            updateBuses(provider_id);
        })
        $("#Book .btn").on("click", function () {
            $("html").scrollTop(0);
        });

        function updateProviders(provider_id = null) {
            $('#providers').empty();
            destination = $($('.destination')).map(function(idx, elem) {
                return $(elem).val();
            }).get();

            $.ajax({
                url: "{{ route('api.providers.index') }}",
                type: "GET",
                data: {
                    destination: destination,
                    block: 0,
                    approve: 1
                },
                success: function(res) {
                    if(!res.success) {
                        $.toast({
                            heading: "{{ __('msg.error') }}",
                            text: res.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3000, 
                            stack: 6
                        });
                        return;
                    }
                    var providers = res.data;
                    $.each(providers, function(index, provider) {
                        var img = "";
                        if(provider.image) img = `{{ asset('images/providers') }}/${provider.image}`;
                        var rate = "";
                        var check = false;
                        for($i = 1; $i <= 5; $i++) {
                            rate += `
                                <svg class='w-5 h-5 text-gray-${(check = $i <= provider.rate) ? '700' : '500'}
                                    fill-current ${check ? 'dark:text-gray-300' : null}' viewBox='0 0 24 24'>
                                <path
                                    d='M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z' />
                            </svg>`;
                        }

                        $('#providers').append(`
                        <div
                            data-id="${provider.id}"
                            class="${provider_id == provider.id ? 'active' : null} companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden">
                                <img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="${img}" alt="avatar"></div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                                    ${provider.name}</h1>
                                <div class="flex mt-2 item-center">
                                    ${rate}
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">${provider.phone}</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">${provider.address.substring(0,30)}</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">${provider.email}</h1>
                                </div>
                            </div>
                        </div>
                        `);
                    });

                    triggerUpdateProviders = false;
                },
                error: function(error) {
                    $.toast({
                        heading: "500",
                        text: error.message,
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3000, 
                        stack: 6
                    });
                }
            })
        }

        function updateBuses(provider_id, bus_id = null) {
            $.ajax({
                url: "{{ route('api.buses.index') }}",
                type: "GET",
                data: {
                    provider_id: provider_id,
                    active: '1',
                    date_from: $('#date_from').val(),
                    date_to: $('#date_to').val(),
                    time_from: $('#time_from').val(),
                    time_to: $('#time_to').val(),
                },
                success: function(res) { console.log(res);
                    if(!res.success) {
                        $.toast({
                            heading: "{{ __('msg.error') }}",
                            text: res.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3000, 
                            stack: 6
                        });
                        return;
                    }
                    var buses = res.data;
                    $.each(buses, function(index, bus) {
                        var img = "";
                        if(bus.image) img = `{{ asset('images/buses') }}/${bus.image}`;
                        var rate = "";
                        var check = false;
                        for($i = 1; $i <= 5; $i++) {
                            rate += `
                                <svg class='w-5 h-5 text-gray-${(check = $i <= bus.rate) ? '700' : '500'}
                                    fill-current ${check ? 'dark:text-gray-300' : null}' viewBox='0 0 24 24'>
                                <path
                                    d='M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z' />
                            </svg>`;
                        }

                        $('#buses').append(`
                        <div
                            data-id="${bus.id}"
                            class="${bus_id == bus.id ? 'active' : null} busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden">
                                <img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="${img}" alt="avatar"></div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                                    ${bus.plate}</h1>
                                <div class="flex mt-2 item-center">
                                    ${rate}
                                </div>
                            </div>
                        </div>
                        `);
                    });
                },
                error: function(error) {
                    $.toast({
                        heading: "500",
                        text: error.message,
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3000, 
                        stack: 6
                    });
                }
            })
        }
    });
</script>

@endpush

@push('page_css')
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .select2.select2-container.select2-container--default {
        width: 100%!important;
    }
</style>
<!-- Toast -->
<link rel="stylesheet" href="{{ asset('elite/assets/node_modules/toast-master/css/jquery.toast.css') }}">
@endpush