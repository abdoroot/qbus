<script>
    $(document).ready(function() {
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
                $('#trip-form').submit();
            }
        });

        /* Create Repeater */
        @if(!is_null(old('program')))
        values = {!! json_encode(array_map(function($program, $index) {
            return ['program['.$index.'][city_id]' => $program['city_id'], 'program['.$index.'][description]' => $program['description']];
        }, old('program'), array_keys(old('program')))) !!};
        @elseif(isset($trip))
        values = {!! json_encode(array_map(function($program, $index) {
            return ['program['.$index.'][city_id]' => $program['city_id'], 'program['.$index.'][description]' => $program['description']];
        }, $tripCities = $trip->tripCities->toArray(), array_keys($tripCities))) !!};
        @else
        values = [
            {'program[0][city_id]': null, 'program[0][description]': null},
            {'program[1][city_id]': null, 'program[0][description]': null},
        ];
        @endif
        var repeater = $("#program").createRepeater({
            showFirstItemToDefault: true,
            disableFirstItemRemoveButton: true,
            values: values
        });

        function updateBuses(bus_id = null) {
            $.ajax({
                url: "{{ route('api.buses.index') }}",
                type: "GET",
                data: {
                    provider_id: "{{ Auth::guard('provider')->user()->provider_id }}",
                    date_from: $('#date_from').val(),
                    date_to: $('#date_to').val(),
                    time_from: $('#time_from').val(),
                    time_to: $('#time_to').val(),
                    trip_id: "{{ isset($trip) ? $trip->id : null }}"
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
                        var options = [];
                        $.each(buses, function (key, bus) {
                            options.push({
                                text: bus.plate,
                                id: bus.id
                            });
                        })
                        $("#bus_id").empty().select2({
                            data: options
                        });
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

        $(document).on('change', '#date_from, #date_to, #time_from, #time_to', function () {
            $('#bus_id').empty().select2();
            console.log($('#time_from').val());
            if($('#date_from').val() && $('#date_to').val() && $('#time_from').val() && $('#time_to').val()) {
                updateBuses();
            }
        })

        function updateFees() {
            destination = $($('.program-city-id')).map(function(idx, elem) {
                return $(elem).val();
            }).get();
            $.ajax({
                url: "{{ url('api/v1/providers/fees/'.Auth::guard('provider')->user()->provider_id) }}/"+destination,
                type: "GET",
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
                    var data = res.data;
                    $('input[name=fees]').val(data.passenger_fees);
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

        $(document).on('change', '.program-city-id', function () {
            updateFees();
        })

        $(document).on('click', '#program .repeater-add-btn, #program .remove-btn', function() {
            updateFees();
        })

        function updateMaxSeats() {
            $.ajax({
                url: "{{ url('api/v1/buses') }}/"+$('#bus_id').val(),
                type: "GET",
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
                    var data = res.data;
                    $('input[name=max]').val(data.passengers);
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

        $(document).on('change', '#bus_id', function() {
            updateMaxSeats();
        })

        $(document).on('change', '#date_from', function () {
            if(!$('#date_to').val()) {
                $('#date_to').datepicker('setDate', new Date($(this).val()));
            }
        })

        @if(!is_null(old('date_from')) && !is_null(old('date_to')) && !is_null(old('time_from')) && !is_null(old('time_to')))
        updateBuses("{{ old('bus_id') }}");
        @endif
    });
</script>