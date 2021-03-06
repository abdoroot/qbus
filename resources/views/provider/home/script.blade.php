<script>
    $(function () {
    "use strict";
    Morris.Area({
        element: 'morris-area-chart',
        data: {!! json_encode($orders) !!},
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
});
    var sparklineLogin = function() { 
        $('#sparklinedash').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#4caf50'
        });
         $('#sparklinedash2').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#9675ce'
        });
          $('#sparklinedash3').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#03a9f3'
        });
           $('#sparklinedash4').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#f96262'
        });
        $('#sales1').sparkline({!! json_encode($orderTotals) !!}, {
            type: 'pie',
            height: '200',
            resize: true,
            sliceColors: ['#01c0c8', '#fecd36', '#fb9678']
        });
        
   }
    var sparkResize;
 
    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 500);
    });
    sparklineLogin();

</script>