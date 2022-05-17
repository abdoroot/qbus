<script>
    $(function () {
        "use strict";
        Morris.Area({
            element: 'morris-area-chart',
            data: {!! json_encode($chart) !!},
            lineColors: ['#fb9678', '#01c0c8', '#ab8ce4'],
            xkey: 'day',
            ykeys: ['busOrders', 'tripOrders', 'backageOrders'],
            labels: [
                "@lang('models/busOrders.plural')", 
                "@lang('models/tripOrders.plural')", 
                "@lang('models/packageOrders.plural')"
            ],
            pointSize: 2,
            lineWidth: 0,
            resize:true,
            fillOpacity: 0.8,
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            hideHover: 'auto',
            xLabels: "day",
            parseTime: false        
        });

        // Datepicker 
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        
        // select2
        $('.select2').select2();
    });
</script>