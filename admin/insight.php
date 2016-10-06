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
    <h4 class="text-center">Daily Income by Product</h4>
    <div id="chartdiv-product2" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
  <div class="col-md-6">
    <h4 class="text-center">Daily Income by Product (Stacked)</h4>
    <div id="chartdiv-product3" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
  <div class="col-md-6">
    <h4 class="text-center">Monthly Income by Product (Pie)</h4>
    <div id="chartdiv-product4" style="width: auto; height: 400px; margin: 10px auto;"></div>
	<div id="clock" class="text-center"><span class="btn btn-sm btn-warning">stop running</span></div>
  </div>
  <div class="col-md-6">
    <h4 class="text-center">Daily Income by All Products (Stacked)</h4>
    <div id="chartdiv-product5" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
<script>
//var chartData = [{"txn_date":"2016-07-05 00:27:18","grand_total":"126"},{"txn_date":"2016-07-05 21:11:01","grand_total":"84"},{"txn_date":"2016-07-05 21:16:50","grand_total":"84"},{"txn_date":"2016-07-05 21:22:03","grand_total":"42"},{"txn_date":"2016-07-06 00:16:42","grand_total":"42"},{"txn_date":"2016-07-06 00:18:07","grand_total":"41"},{"txn_date":"2016-07-06 00:23:34","grand_total":"21"}];
  AmCharts.ready(function(){
  //-- Daily Income ----------------------------------
  var chart = new AmCharts.AmSerialChart();
  chart.dataProvider = [];
  chart.dataLoader = { 
    "url": "parsers/dataDailyTotal.php",
	"complete": function(chart) {
       //console.log(chart.dataProvider.length);
    }	
  };
  //chart.addClassNames = true;
  chart.categoryField = "txn_date";
  chart.dataDateFormat = "YYYY-MM-DD";
  chart.balloon.showBullet = false;
  //chart.handDrawScatter = 2;
  //chart.handDrawn = true;
  chart.startDuration = 1;
  
  var valueAxis = new AmCharts.ValueAxis();
  valueAxis.title = "($)";
  //valueAxis.gridAlpha = 0;
  //valueAxis.axisAlpha = 0;
  chart.addValueAxis(valueAxis);
  
  var categoryAxis = chart.categoryAxis;
  //categoryAxis.autoGridCount = false;
  //categoryAxis.gridCount = 10;
  categoryAxis.gridPosition = "start";
  categoryAxis.labelRotation = 45;
  
  var graph = new AmCharts.AmGraph();
  graph.valueField = "grand_total";
  graph.id = "g0";
  graph.type = "column";
  //graph.valueAxis = valueAxis;
  //graph.type = "line";
  graph.fillAlphas = 0.8;
  //chart.angle = 30;
  //chart.depth3D = 15;
  graph.balloonText = "[[category]]: <b>[[value]]</b>";
  //graph.bullet = "round";
  //graph.bulletAlpha = 0.5;
  graph.lineColor = "#8d1cc6";
  graph.title = "Dollars";
  graph.legendValueText = "[[category]]/[[value]]";
  chart.addGraph(graph);
  
  // LEGEND
  var legend = new AmCharts.AmLegend();
  legend.equalWidths = false;
  legend.valueWidth = 120;
  legend.useGraphSettings = true;
  legend.borderAlpha = 0.2;
  legend.horizontalGap = 10;
  chart.addLegend(legend);
  
  // WRITE CHART
  chart.write('chartdiv'); 
  
  //--- Daily Income by Product ---------------------------
  var chart2 = new AmCharts.AmSerialChart();
  //chart.dataProvider = chartData;
  chart2.dataLoader = { "url": "parsers/dataDailyProduct.php" };
  //console.log(chart.dataLoader.chart.chartData);
  chart2.categoryField = "date";
  chart2.dataDateFormat = "YYYY-MM-DD";
  chart2.balloon.showBullet = false;
  //chart2.handDrawScatter = 2;
  //chart2.handDrawn = true;
  chart2.startDuration = 1;
  chart2.sequencedAnimation = false;
  //chart2.addClassNames = true;
  //chart2.addListener("dataUpdated", zoomChart);
  //chart2.addListener('zoomed', handleZoom);
  chart2.mouseWheelZoomEnabled = true;
  
  //AXIS
  // value AXIS
  var monAxis = new AmCharts.ValueAxis();
  monAxis.title = "($)";
  //monAxis.offset = 83;
  monAxis.titleOffset = 10;
  monAxis.position = "right";
  monAxis.dashLength = 3;
  //monAxis.gridAlpha = 0;
  //monAxis.axisAlpha = 0;
  //monAxis.autoGridCount = false;
  //monAxis.gridCount = 50;
  // since we increased the number of grid lines dramatically, let's make the label display only on each 10th of them
  //monAxis.labelFrequency = 10;
  chart2.addValueAxis(monAxis); 
  
  // category AXIS
  var categoryAxis2 = chart2.categoryAxis;
  //categoryAxis2.autoGridCount = false;
  //categoryAxis2.gridCount = chartData.length;
  categoryAxis2.gridPosition = "start";
  categoryAxis2.labelRotation = 45;
  categoryAxis2.dateFormats = [{
    period: 'fff',
    format: 'JJ:NN:SS'
}, {
    period: 'ss',
    format: 'JJ:NN:SS'
}, {
    period: 'mm',
    format: 'JJ:NN'
}, {
    period: 'hh',
    format: 'JJ:NN'
}, {
    period: 'DD',
    format: 'MMM DD'
}, {
    period: 'WW',
    format: 'MMM DD'
}, {
    period: 'MM',
    format: 'MMM YYYY'
}, {
    period: 'YYYY',
    format: 'MMM YYYY'
}];
  categoryAxis2.parseDates = true;
  categoryAxis2.minPeriod = "DD";
  
  // GRAPH
  // Graph 1 (Levi's Jeans)
  var graph2 = new AmCharts.AmGraph();
  graph2.valueField = "Levi's Jeans";
  graph2.id = "g1";
  graph2.valueAxis = monAxis;
  //graphmon.type = "line";
  graph2.type = "column";
  graph2.fillAlphas = 0.8;
  //chart2.angle = 30;
  //chart2.depth3D = 15;
  graph2.balloonText = "<b>[[value]]</b>";
  //graphmon.balloonText = "[[category]]: <b>[[value]]</b>";
  graph2.showBalloon = true;
  //graphmon.bullet = "round";
  //graphmon.bulletSizeField  = "Levi's Jeans";
  //graphmon.bulletBorderColor = "#ff5755";
  //graphmon.bulletBorderAlpha = 1;
  //graphmon.bulletBorderThickness = 1;
  //graphmon.bulletColor = "#000000";
  //graphmon.bulletAlpha = 1;
  //graphmon.labelText = "[[title2]]"; // not all data points has title2 specified, that's why labels are displayed only near some of the bullet
  //graphmon.labelPosition = "right";
  graph2.title = "Levi's Jeans";
  graph2.legendValueText = "[[category]]/[[value]]";
  //graphmon.descriptionField = "title";
  //graphmon.lineColor = "#ff5755";
  //graphmon.lineThickness = 1;
  //graphmon.lineAlpha = 1;
  //graphmon.fillAlphas = 1;
  //graphmon.animationPlayed = true;
  //graphmon.connect = false;
  //graphmoon.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
  chart2.addGraph(graph2);
  
  // Graph 2 (Beautiful Shirts)
  var graph2 = new AmCharts.AmGraph();
  graph2.valueField = "Beautiful Shirts";
  graph2.id = "g2";	
  //graph2.type = "line";
  graph2.type = "column";
  graph2.fillAlphas = 0.8;
  graph2.valueAxis = monAxis;
  graph2.balloonText = "<b>[[value]]</b>";
  graph2.showBalloon = true;
  //graph2.bullet = "round";
  //graph2.bulletSizeField  = "Beautiful Shirts";
  //graph2.bulletBorderColor = "#ff5755";
  //graph2.bulletBorderAlpha = 1;
  //graph2.bulletBorderThickness = 1;
  //graphmon.bulletColor = "#000000";
  //graph2.bulletAlpha = 1;
  //graphmon.labelPosition = "right";
  graph2.title = "Beautiful Shirts";
  graph2.legendValueText = "[[category]]/[[value]]";
  chart2.addGraph(graph2);
  
  // LEGEND
  var legend2 = new AmCharts.AmLegend();
  legend2.equalWidths = false;
  legend2.valueWidth = 120;
  legend2.useGraphSettings = true;
  legend2.borderAlpha = 0.2;
  legend2.horizontalGap = 10;
  chart2.addLegend(legend2);
  
  // CURSOR
  var chartCursor = new AmCharts.ChartCursor();
  chartCursor.bulletSize = 0;
  chartCursor.zoomable = false;
  chartCursor.categoryBalloonDateFormat = "YYYY MMM DD"; //or undefined;
  chartCursor.cursorAlpha = 0;
  //chartCursor.valueBalloonsEnabled = false;
  //chartCursor.valueLineBalloonEnabled = true;
  //chartCursor.valueLineEnabled = true;
  //chartCursor.valueLineAlpha = 0.5;
  chart2.addChartCursor(chartCursor);
  
  // SCROLLBAR
  var chartScrollbar = new AmCharts.ChartScrollbar();
  chartScrollbar.scrollbarHeight = 20;
  //chartScrollbar.graphFillColor = "#FFFFFF";
  //chartScrollbar.graphFillAlpha = 0;
  chartScrollbar.graph = graph2; // as we want graph to be displayed in the scrollbar, we set graph here
  chartScrollbar.graphType = "line"; // we don't want candlesticks to be displayed in the scrollbar                
  chartScrollbar.gridCount = 8;
  //chartScrollbar.autoGridCount = true;
  //chartScrollbar.usePeriod = "DD";
  chartScrollbar.color = "#EB593C";
  //chart2.chartScrollbarSettings = chartScrollbar;
  chart2.addChartScrollbar(chartScrollbar);

  chart2.write('chartdiv-product2');
  /*
  // this method is called when chart is first inited as we listen for "dataUpdated" event
  function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart2.zoomToIndexes(20, 25);
	//chart2.zoomToDates(startDate, endDate);
  } */
  
  //--- Daily Income by Product 2 (Stacked) ---------------------------
  var chart3 = new AmCharts.AmSerialChart();
  //chart.dataProvider = chartData;
  chart3.dataLoader = { "url": "parsers/dataDailyProduct.php" };
  //console.log(chart.dataLoader.chart.chartData);
  chart3.categoryField = "date";
  chart3.dataDateFormat = "YYYY-MM-DD";
  //chart3.balloon.showBullet = false;
  //chart2.handDrawScatter = 2;
  //chart2.handDrawn = true;
  chart3.startDuration = 1;
  chart3.sequencedAnimation = false;
  //chart2.addClassNames = true;
  //chart2.addListener("dataUpdated", zoomChart);
  //chart2.addListener('zoomed', handleZoom);
  chart3.mouseWheelZoomEnabled = true;
  
  //AXIS
  // value AXIS
  var dollarAxis = new AmCharts.ValueAxis();
  dollarAxis.title = "($)";
  //monAxis.offset = 83;
  dollarAxis.titleOffset = 10;
  //dollarAxis.position = "right";
  dollarAxis.dashLength = 3;
  dollarAxis.stackType = "regular";
  //monAxis.gridAlpha = 0;
  //monAxis.axisAlpha = 0;
  //monAxis.autoGridCount = false;
  //monAxis.gridCount = 50;
  // since we increased the number of grid lines dramatically, let's make the label display only on each 10th of them
  //monAxis.labelFrequency = 10;
  chart3.addValueAxis(dollarAxis); 
  
  // category AXIS
  var categoryAxis3 = chart3.categoryAxis;
  //categoryAxis2.autoGridCount = false;
  //categoryAxis2.gridCount = chartData.length;
  categoryAxis3.gridPosition = "start";
  categoryAxis3.labelRotation = 45;
  categoryAxis3.dateFormats = [{
    period: 'fff',
    format: 'JJ:NN:SS'
}, {
    period: 'ss',
    format: 'JJ:NN:SS'
}, {
    period: 'mm',
    format: 'JJ:NN'
}, {
    period: 'hh',
    format: 'JJ:NN'
}, {
    period: 'DD',
    format: 'MMM DD'
}, {
    period: 'WW',
    format: 'MMM DD'
}, {
    period: 'MM',
    format: 'MMM YYYY'
}, {
    period: 'YYYY',
    format: 'MMM YYYY'
}];
  categoryAxis3.parseDates = true;
  categoryAxis3.minPeriod = "DD";
  
  // GRAPH
  // Graph 1 (Levi's Jeans)
  var graph3 = new AmCharts.AmGraph();
  graph3.valueField = "Levi's Jeans";
  graph3.id = "g1";
  graph3.valueAxis = dollarAxis;
  //graphmon.type = "line";
  graph3.type = "column";
  graph3.fillAlphas = 0.8;
  //chart2.angle = 30;
  //chart2.depth3D = 15;
  graph3.title = "Levi's Jeans";
  graph3.balloonText = "<b>[[title]] : [[value]]</b>";
  //graphmon.balloonText = "[[category]]: <b>[[value]]</b>";
  graph3.showBalloon = true;
  //graphmon.bullet = "round";
  //graphmon.bulletSizeField  = "Levi's Jeans";
  //graphmon.bulletBorderColor = "#ff5755";
  //graphmon.bulletBorderAlpha = 1;
  //graphmon.bulletBorderThickness = 1;
  //graphmon.bulletColor = "#000000";
  //graphmon.bulletAlpha = 1;
  //graphmon.labelText = "[[title2]]"; // not all data points has title2 specified, that's why labels are displayed only near some of the bullet
  //graphmon.labelPosition = "right";
  graph3.legendValueText = "[[category]]/[[value]]";
  //graphmon.descriptionField = "title";
  //graphmon.lineColor = "#ff5755";
  //graphmon.lineThickness = 1;
  //graphmon.lineAlpha = 1;
  //graphmon.fillAlphas = 1;
  //graphmon.animationPlayed = true;
  //graphmon.connect = false;
  //graphmoon.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
  chart3.addGraph(graph3);
  
  // Graph 2 (Beautiful Shirts)
  var graph3 = new AmCharts.AmGraph();
  graph3.valueField = "Beautiful Shirts";
  graph3.id = "g2";	
  //graph3.type = "line";
  graph3.type = "column";
  graph3.fillAlphas = 0.8;
  graph3.valueAxis = dollarAxis;
  graph3.title = "Beautiful Shirts";
  graph3.balloonText = "<b>[[title]] : [[value]]</b>";
  graph3.showBalloon = true;
  //graph3.bullet = "round";
  //graph3.bulletSizeField  = "Beautiful Shirts";
  //graph3.bulletBorderColor = "#ff5755";
  //graph3.bulletBorderAlpha = 1;
  //graph3.bulletBorderThickness = 1;
  //graph3.bulletColor = "#000000";
  //graph3.bulletAlpha = 1;
  //graph3.labelPosition = "right";
  //graph3.newStack = true; // this line starts new stack
  graph3.legendValueText = "[[category]]/[[value]]";
  chart3.addGraph(graph3);
  
  // LEGEND
  var legend3 = new AmCharts.AmLegend();
  legend3.equalWidths = false;
  legend3.valueWidth = 120;
  legend3.useGraphSettings = true;
  legend3.borderAlpha = 0.2;
  legend3.horizontalGap = 10;
  chart3.addLegend(legend3);
  
  // CURSOR
  var chartCursor3 = new AmCharts.ChartCursor();
  chartCursor3.bulletSize = 0;
  chartCursor3.zoomable = false;
  chartCursor3.categoryBalloonDateFormat = "YYYY MMM DD"; //or undefined;
  chartCursor3.cursorAlpha = 0;
  //chartCursor.valueBalloonsEnabled = false;
  //chartCursor.valueLineBalloonEnabled = true;
  //chartCursor.valueLineEnabled = true;
  //chartCursor.valueLineAlpha = 0.5;
  chart3.addChartCursor(chartCursor3);
  
  // SCROLLBAR
  var chartScrollbar3 = new AmCharts.ChartScrollbar();
  chartScrollbar3.scrollbarHeight = 20;
  //chartScrollbar.graphFillColor = "#FFFFFF";
  //chartScrollbar.graphFillAlpha = 0;
  chartScrollbar3.graph = graph3; // as we want graph to be displayed in the scrollbar, we set graph here
  chartScrollbar3.graphType = "line"; // we don't want candlesticks to be displayed in the scrollbar                
  //chartScrollbar3.gridCount = 8;
  chartScrollbar3.autoGridCount = true;
  //chartScrollbar.usePeriod = "DD";
  chartScrollbar3.color = "#EB593C";
  //chart2.chartScrollbarSettings = chartScrollbar;
  chart3.addChartScrollbar(chartScrollbar3);

  chart3.write('chartdiv-product3'); 
  
  //--- Monthly Income by Product (Pie) ---------------------------
  var currentMonth = 6;
  //var chartData = {"6":[{"title":"Levi's Jeans","money":399.9},{"title":"Beautiful Shirts","money":39.98},{"title":"Nice Purse","money":39}],"7":[{"title":"Levi's Jeans","money":319.92},{"title":"Beautiful Shirts","money":79.96},{"title":"Test Multiple File","money":12},{"title":"Nice Purse","money":39},{"title":"Princess Dress","money":15.49}]};
  //chart4.dataProvider = chartData;
  var chart = AmCharts.makeChart( "chartdiv-product4", {
  "type": "pie",
  "theme": "light",
  "dataLoader": {
	"url": "parsers/dataMonthlyProduct.php",
	"complete": function(chart){
		chartData = chart.dataProvider;
		
		function getCurrentData() {		  
          var data = chartData[currentMonth];
          currentMonth++;
          if (currentMonth > 7)
            currentMonth = 6;
          return data;
        }
      
        function loop() {
          chart.allLabels[0].text = currentMonth;
          var data = getCurrentData();
          chart.animateData( data, {
          duration: 1000,
          complete: function() {
            timer = setTimeout( loop, 3000 );
          }
        } );
      }
      loop();
	  
	  // Control running button
	  $('#clock').on('click', function(){
		$but = $(this).find('.btn');
		if ($but.is('.btn-warning')){
		  $but.toggleClass('btn-warning btn-info');	
		  $but.text('start running');
		  clearTimeout(timer);
		} else {
			$but.toggleClass('btn-warning btn-info');	
		    $but.text('stop running');
			timer = setTimeout( loop, 3000 );
		}
	  });
	}
  },
  //"dataProvider": chartData,
  "valueField": "money",
  "titleField": "title",
  "startDuration": 0,
  "innerRadius": 80,
  "pullOutRadius": 20,
  "marginTop": 30,
  /*"titles": [{
    "text": "Monthly Income by Product"
  }],*/
  "allLabels": [{
    "y": "54%",
    "align": "center",
    "size": 25,
    "bold": true,
    "text": "6",
    "color": "#555"
  }, {
    "y": "49%",
    "align": "center",
    "size": 15,
    "text": "Month'16",
    "color": "#555"
  }],
  "listeners": [ {
    "event": "init",
    "method": function( e ) {
      var chart = e.chart;
    }
  } ],
   "export": {
     "enabled": true
  }
}); 
  /*
  var chart4 = new AmCharts.AmPieChart();
  var chartData = [{"title":"Levi's Jeans","money":399.9},{"title":"Beautiful Shirts","money":39.98},{"title":"Nice Purse","money":39}];
  chart4.dataProvider = chartData;
  //chart4.dataLoader = { "url": "parsers/dataMonthlyProduct.php" };
  chart4.titleField = "title";
  chart4.valueField = "money";
  chart4.sequencedAnimation = true;
  chart4.startEffect = "elastic";
  chart4.innerRadius = "30%";
  chart4.startDuration = 1;
  chart4.labelRadius = 15;
  chart4.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
  // the following two lines makes the chart 3D
  //chart.depth3D = 10;
  //chart.angle = 15;

  // WRITE
  chart4.write("chartdiv-product4");*/
  
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
        for ( var key in chart.dataProvider[0] ) {
          if ( chart.dataProvider[0].hasOwnProperty( key ) && key != chart.categoryField ) {
            var graph = new AmCharts.AmGraph();
            graph.valueField = key;
            graph.type = "column";
			graph.fillAlphas = 0.8;
            graph.title = key,
            //graph.lineThickness = 2;
            chart.addGraph(graph);
            }
          }
        }
      },
    "rotate": false,
    "marginTop": 10,
    "categoryField": "date",
    "categoryAxis": {
      "gridAlpha": 0.07,
      "axisColor": "#DADADA",
	  "labelRotation": 45,
      "startOnAxis": true,
      "title": "Date",
      "guides": [{
        "category": "2016-06-05",
        "lineColor": "#CC0000",
        "lineAlpha": 1,
        "dashLength": 2,
        "inside": true,
        "labelRotation": 90,
        "label": "holiday"
       }, {
        "category": "2016-07-05",
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
      "periodValueText": ", total: [[value.sum]]"
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
