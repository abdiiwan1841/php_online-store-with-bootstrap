<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once '../core/init.php';
  if(!is_logged_in()){
	header('Location: login.php');
  }
  include 'includes/head.php';
  include 'includes/navigation.php';
?>
<!-- Chart -->
<div class="row">
  <div class="col-md-6">
    <h4 class="text-center">Daily Income</h4>
    <div id="chartdiv" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
  <div class="col-md-6">
    <h4 class="text-center">Daily Income by Product (Stacked)</h4>
    <div id="chartdiv-product5" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
<script>
//var chartData = [{"txn_date":"2016-07-05 00:27:18","grand_total":"126"},{"txn_date":"2016-07-05 21:11:01","grand_total":"84"},{"txn_date":"2016-07-05 21:16:50","grand_total":"84"},{"txn_date":"2016-07-05 21:22:03","grand_total":"42"},{"txn_date":"2016-07-06 00:16:42","grand_total":"42"},{"txn_date":"2016-07-06 00:18:07","grand_total":"41"},{"txn_date":"2016-07-06 00:23:34","grand_total":"21"}];
  AmCharts.ready(function(){
  
  // --- Daily Income by All Products -------------------------
  var chart = AmCharts.makeChart("chartdiv-product5", {
     "type": "serial",
	 "dataDateFormat": "YYYY-MM-DD",
	 //"dataProvider": chartData,
      "dataLoader": {
        "url": "parsers/dataDailyProduct.php",
		//"format": "json",
        "showErrors": true,
        "noStyles": true,
        "async": true,
        "load": function( options, chart ) {
          // Here the data is already loaded and set to the chart.
          // We can iterate through it and add proper graphs
		  //for (var i = 0; i < chart.dataProvider.length; i++){
            for ( var key in chart.dataProvider[0] ) {
              if ( chart.dataProvider[0].hasOwnProperty( key ) && key != chart.categoryField ) {
                var graph = new AmCharts.AmGraph();
                graph.valueField = key;
                graph.type = "column";
				graph.fillAlphas = 0.8,
                graph.title = key,
                //graph.lineThickness = 2;
                chart.addGraph( graph );
              }
            }
		  //}
        }
      },
     "rotate": false,
     "marginTop": 10,
     "categoryField": "date",
     "categoryAxis": {
	   //"parseDates": true,
	   //"minPeriod": "DD",
       "gridAlpha": 0.07,
       "axisColor": "#DADADA",
	   "labelRotation": 45,
       "startOnAxis": true,
       "title": "Date",
       "guides": [{
         "category": "2016-06-06",
         "lineColor": "#CC0000",
         "lineAlpha": 1,
         "dashLength": 2,
         "inside": true,
         "labelRotation": 90,
         "label": "holiday"
       }, {
         "category": "2016-07-06",
         "lineColor": "#CC0000",
         "lineAlpha": 1,
         "dashLength": 2,
         "inside": true,
         "labelRotation": 90,
         "label": "holiday"
       }]
     },
     "valueAxes": [{
       "stackType": "regular",
       "gridAlpha": 0.07,
       "title": "($)"
     }],
     "graphs": [],
     "legend": {
       "position": "bottom",
       "valueText": "[[value]]",
       "valueWidth": 150,
       "valueAlign": "left",
       "equalWidths": true,
       "periodValueText": "total: [[value.sum]]"
     },
     "chartCursor": {
       "cursorAlpha": 0
     },
     "chartScrollbar": {
       "color": "FFFFFF"
     }

    });
});
  /*	
  // this method is called each time the selected period of the chart is changed
  function handleZoom(event) {
    var startDate = event.startDate;
    var endDate = event.endDate;
    //document.getElementById("startDate").value = AmCharts.formatDate(startDate, "DD/MM/YYYY");
    //document.getElementById("endDate").value = AmCharts.formatDate(endDate, "DD/MM/YYYY");

    // as we also want to change graph type depending on the selected period, we call this method
    changeGraphType(event);
  } */
</script>
