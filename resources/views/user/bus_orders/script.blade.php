<script>
    var triggerUpdateProviders = "{{ is_null(old('provider_id')) }}" ? true : false;

    $(document).on('change', '.destination', function () {
        triggerUpdateProviders = true;
    })

    $(document).on('click', '#destination .repeater-add-btn, #destination .remove-btn', function() {
        triggerUpdateProviders = true;
    })

    $(document).on('change', '#date_from', function () {
        if(!$('#date_to').val()) {
            // $('#date_to').val($(this).val());
            $('#date_to').datepicker('setDate', new Date($(this).val()));
        }
    })

    $(document).ready(function() {
        if(!triggerUpdateProviders) {
            updateProviders("{{ old('provider_id') }}");
            updateBuses("{{ old('provider_id') }}", "{{ old('bus_id') }}");
        }

        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "@lang('crud.submit')",
                next: "@lang('pagination.next')",
                previous: "@lang('pagination.previous')",
            },
            onFinished: function (event, currentIndex) {
                $('#bus-order-form').submit();
            },
            onStepChanged: function (event, currentIndex, priorIndex) { 
                if(currentIndex == 3 && triggerUpdateProviders) {
                    updateProviders();
                }
            }, 
        });

        /* Create Repeater */
        @if(!is_null(old('destination')))
        values = {!! json_encode(array_map(function($city_id, $index) {
            return ['destination['.$index.']' => $city_id];
        }, old('destination'), array_keys(old('destination')))) !!};
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

        $(document).on('ifClicked', 'input[name=provider_id]', function() {
            var provider_id = $(this).val();
            $('#buses').empty();
            updateBuses(provider_id);
        });

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
                    var buses = res.data;
                    $.each(buses, function(index, bus) {
                        $('#buses').append(`
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="{{ asset('images/buses') }}/${bus.image}" alt="" style="height: 250px;">
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="javascript:;">${bus.plate}</a></h4>
                                        <p class="card-text"><i class="icon-people"></i> ${bus.passengers}</p>
                                        <input name="bus_id" type="radio" class="check" data-radio="iradio_line-red" data-label="@lang('crud.select')"
                                            value="${bus.id}" ${bus_id == bus.id ? 'checked' : ''}> </li>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                    icheckfirstinit();
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
                        $('#providers').append(`
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="${img}" alt="" style="height: 250px;">
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="javascript:;">${provider.name}</a></h4>
                                        <span class="card-subtitle"><i class="icon-star"></i> ${ provider.rate == null ? '-' : provider.rate}</span>
                                        <p class="card-text"><i class="icon-location-pin"></i> ${ provider.address.substring(0, 20) }</p>
                                        <input name="provider_id" type="radio" class="check" data-radio="iradio_line-red" data-label="@lang('crud.select')"
                                            value="${provider.id}" ${provider_id == provider.id ? 'checked' : ''} > </li>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                    icheckfirstinit();
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
    });
</script>