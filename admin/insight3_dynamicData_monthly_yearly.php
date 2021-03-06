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
	<div class="selector">
  <select onchange="setData(this.options[this.selectedIndex].value);">
  <option value="monthly" selected="selected">Show monthly data</option>
  <option value="yearly">Show yearly data</option>
</select>
</div>
    <div id="chartdiv" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
  <div class="col-md-6">
    <h4 class="text-center">Daily Income by Product (Stacked)</h4>
    <div id="chartdiv-product5" style="width: auto; height: 400px; margin: 10px auto;"></div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
<script>
/**
 * Define monthly data
 */
var chartData = [ {
  "month": "1986-02",
  "value": 33
}, {
  "month": "1986-03",
  "value": 20
}, {
  "month": "1986-04",
  "value": 24
}, {
  "month": "1986-05",
  "value": 42
}, {
  "month": "1986-06",
  "value": 27
}, {
  "month": "1986-07",
  "value": 20
}, {
  "month": "1986-08",
  "value": 7
}, {
  "month": "1986-09",
  "value": 95
}, {
  "month": "1986-10",
  "value": 28
}, {
  "month": "1986-11",
  "value": 82
}, {
  "month": "1986-12",
  "value": 83
}, {
  "month": "1987-01",
  "value": 61
}, {
  "month": "1987-02",
  "value": 75
}, {
  "month": "1987-03",
  "value": 73
}, {
  "month": "1987-04",
  "value": 63
}, {
  "month": "1987-05",
  "value": 75
}, {
  "month": "1987-06",
  "value": 7
}, {
  "month": "1987-07",
  "value": 19
}, {
  "month": "1987-08",
  "value": 69
}, {
  "month": "1987-09",
  "value": 90
}, {
  "month": "1987-10",
  "value": 91
}, {
  "month": "1987-11",
  "value": 4
}, {
  "month": "1987-12",
  "value": 76
}, {
  "month": "1988-01",
  "value": 6
}, {
  "month": "1988-02",
  "value": 75
}, {
  "month": "1988-03",
  "value": 56
}, {
  "month": "1988-04",
  "value": 86
}, {
  "month": "1988-05",
  "value": 18
}, {
  "month": "1988-06",
  "value": 93
}, {
  "month": "1988-07",
  "value": 72
}, {
  "month": "1988-08",
  "value": 32
}, {
  "month": "1988-09",
  "value": 1
}, {
  "month": "1988-10",
  "value": 45
}, {
  "month": "1988-11",
  "value": 40
}, {
  "month": "1988-12",
  "value": 14
}, {
  "month": "1989-01",
  "value": 23
}, {
  "month": "1989-02",
  "value": 49
}, {
  "month": "1989-03",
  "value": 98
}, {
  "month": "1989-04",
  "value": 28
}, {
  "month": "1989-05",
  "value": 94
}, {
  "month": "1989-06",
  "value": 27
}, {
  "month": "1989-07",
  "value": 84
}, {
  "month": "1989-08",
  "value": 25
}, {
  "month": "1989-09",
  "value": 35
}, {
  "month": "1989-10",
  "value": 30
}, {
  "month": "1989-11",
  "value": 67
}, {
  "month": "1989-12",
  "value": 86
}, {
  "month": "1990-01",
  "value": 73
}, {
  "month": "1990-02",
  "value": 3
}, {
  "month": "1990-03",
  "value": 42
}, {
  "month": "1990-04",
  "value": 23
}, {
  "month": "1990-05",
  "value": 94
}, {
  "month": "1990-06",
  "value": 77
}, {
  "month": "1990-07",
  "value": 35
}, {
  "month": "1990-08",
  "value": 3
}, {
  "month": "1990-09",
  "value": 73
}, {
  "month": "1990-10",
  "value": 7
}, {
  "month": "1990-11",
  "value": 58
}, {
  "month": "1990-12",
  "value": 15
}, {
  "month": "1991-01",
  "value": 29
}, {
  "month": "1991-02",
  "value": 97
}, {
  "month": "1991-03",
  "value": 80
}, {
  "month": "1991-04",
  "value": 20
}, {
  "month": "1991-05",
  "value": 69
}, {
  "month": "1991-06",
  "value": 28
}, {
  "month": "1991-07",
  "value": 32
}, {
  "month": "1991-08",
  "value": 90
}, {
  "month": "1991-09",
  "value": 38
}, {
  "month": "1991-10",
  "value": 98
}, {
  "month": "1991-11",
  "value": 62
}, {
  "month": "1991-12",
  "value": 97
}, {
  "month": "1992-01",
  "value": 15
}, {
  "month": "1992-02",
  "value": 10
}, {
  "month": "1992-03",
  "value": 7
}, {
  "month": "1992-04",
  "value": 19
}, {
  "month": "1992-05",
  "value": 8
}, {
  "month": "1992-06",
  "value": 80
}, {
  "month": "1992-07",
  "value": 79
}, {
  "month": "1992-08",
  "value": 81
}, {
  "month": "1992-09",
  "value": 77
}, {
  "month": "1992-10",
  "value": 2
}, {
  "month": "1992-11",
  "value": 33
}, {
  "month": "1992-12",
  "value": 77
}, {
  "month": "1993-01",
  "value": 20
}, {
  "month": "1993-02",
  "value": 30
}, {
  "month": "1993-03",
  "value": 95
}, {
  "month": "1993-04",
  "value": 34
}, {
  "month": "1993-05",
  "value": 34
}, {
  "month": "1993-06",
  "value": 84
}, {
  "month": "1993-07",
  "value": 10
}, {
  "month": "1993-08",
  "value": 93
}, {
  "month": "1993-09",
  "value": 35
}, {
  "month": "1993-10",
  "value": 5
}, {
  "month": "1993-11",
  "value": 44
}, {
  "month": "1993-12",
  "value": 18
}, {
  "month": "1994-01",
  "value": 39
}, {
  "month": "1994-02",
  "value": 74
}, {
  "month": "1994-03",
  "value": 71
}, {
  "month": "1994-04",
  "value": 69
}, {
  "month": "1994-05",
  "value": 33
}, {
  "month": "1994-06",
  "value": 53
}, {
  "month": "1994-07",
  "value": 59
}, {
  "month": "1994-08",
  "value": 92
}, {
  "month": "1994-09",
  "value": 14
}, {
  "month": "1994-10",
  "value": 99
}, {
  "month": "1994-11",
  "value": 72
}, {
  "month": "1994-12",
  "value": 19
}, {
  "month": "1995-01",
  "value": 94
}, {
  "month": "1995-02",
  "value": 34
}, {
  "month": "1995-03",
  "value": 28
}, {
  "month": "1995-04",
  "value": 74
}, {
  "month": "1995-05",
  "value": 47
}, {
  "month": "1995-06",
  "value": 21
}, {
  "month": "1995-07",
  "value": 20
}, {
  "month": "1995-08",
  "value": 87
}, {
  "month": "1995-09",
  "value": 12
}, {
  "month": "1995-10",
  "value": 29
}, {
  "month": "1995-11",
  "value": 90
}, {
  "month": "1995-12",
  "value": 66
}, {
  "month": "1996-01",
  "value": 64
}, {
  "month": "1996-02",
  "value": 26
}, {
  "month": "1996-03",
  "value": 6
}, {
  "month": "1996-04",
  "value": 70
}, {
  "month": "1996-05",
  "value": 73
}, {
  "month": "1996-06",
  "value": 49
}, {
  "month": "1996-07",
  "value": 89
}, {
  "month": "1996-08",
  "value": 54
}, {
  "month": "1996-09",
  "value": 23
}, {
  "month": "1996-10",
  "value": 49
}, {
  "month": "1996-11",
  "value": 59
}, {
  "month": "1996-12",
  "value": 65
}, {
  "month": "1997-01",
  "value": 42
}, {
  "month": "1997-02",
  "value": 59
}, {
  "month": "1997-03",
  "value": 34
}, {
  "month": "1997-04",
  "value": 63
}, {
  "month": "1997-05",
  "value": 79
}, {
  "month": "1997-06",
  "value": 21
}, {
  "month": "1997-07",
  "value": 61
}, {
  "month": "1997-08",
  "value": 25
}, {
  "month": "1997-09",
  "value": 22
}, {
  "month": "1997-10",
  "value": 49
}, {
  "month": "1997-11",
  "value": 45
}, {
  "month": "1997-12",
  "value": 34
}, {
  "month": "1998-01",
  "value": 66
}, {
  "month": "1998-02",
  "value": 42
}, {
  "month": "1998-03",
  "value": 38
}, {
  "month": "1998-04",
  "value": 14
}, {
  "month": "1998-05",
  "value": 49
}, {
  "month": "1998-06",
  "value": 32
}, {
  "month": "1998-07",
  "value": 65
}, {
  "month": "1998-08",
  "value": 73
}, {
  "month": "1998-09",
  "value": 33
}, {
  "month": "1998-10",
  "value": 99
}, {
  "month": "1998-11",
  "value": 57
}, {
  "month": "1998-12",
  "value": 57
}, {
  "month": "1999-01",
  "value": 66
}, {
  "month": "1999-02",
  "value": 78
}, {
  "month": "1999-03",
  "value": 93
}, {
  "month": "1999-04",
  "value": 52
}, {
  "month": "1999-05",
  "value": 74
}, {
  "month": "1999-06",
  "value": 57
}, {
  "month": "1999-07",
  "value": 82
}, {
  "month": "1999-08",
  "value": 64
}, {
  "month": "1999-09",
  "value": 27
}, {
  "month": "1999-10",
  "value": 60
}, {
  "month": "1999-11",
  "value": 98
}, {
  "month": "1999-12",
  "value": 61
}, {
  "month": "2000-01",
  "value": 10
}, {
  "month": "2000-02",
  "value": 5
}, {
  "month": "2000-03",
  "value": 65
}, {
  "month": "2000-04",
  "value": 64
}, {
  "month": "2000-05",
  "value": 21
}, {
  "month": "2000-06",
  "value": 50
}, {
  "month": "2000-07",
  "value": 99
}, {
  "month": "2000-08",
  "value": 98
}, {
  "month": "2000-09",
  "value": 4
}, {
  "month": "2000-10",
  "value": 29
}, {
  "month": "2000-11",
  "value": 21
}, {
  "month": "2000-12",
  "value": 54
}, {
  "month": "2001-01",
  "value": 74
}, {
  "month": "2001-02",
  "value": 74
}, {
  "month": "2001-03",
  "value": 96
}, {
  "month": "2001-04",
  "value": 3
}, {
  "month": "2001-05",
  "value": 58
}, {
  "month": "2001-06",
  "value": 8
}, {
  "month": "2001-07",
  "value": 100
}, {
  "month": "2001-08",
  "value": 44
}, {
  "month": "2001-09",
  "value": 88
}, {
  "month": "2001-10",
  "value": 17
}, {
  "month": "2001-11",
  "value": 37
}, {
  "month": "2001-12",
  "value": 42
}, {
  "month": "2002-01",
  "value": 51
}, {
  "month": "2002-02",
  "value": 36
}, {
  "month": "2002-03",
  "value": 26
}, {
  "month": "2002-04",
  "value": 42
}, {
  "month": "2002-05",
  "value": 73
}, {
  "month": "2002-06",
  "value": 7
}, {
  "month": "2002-07",
  "value": 94
}, {
  "month": "2002-08",
  "value": 36
}, {
  "month": "2002-09",
  "value": 56
}, {
  "month": "2002-10",
  "value": 31
}, {
  "month": "2002-11",
  "value": 95
}, {
  "month": "2002-12",
  "value": 12
}, {
  "month": "2003-01",
  "value": 83
}, {
  "month": "2003-02",
  "value": 97
}, {
  "month": "2003-03",
  "value": 92
}, {
  "month": "2003-04",
  "value": 80
}, {
  "month": "2003-05",
  "value": 74
}, {
  "month": "2003-06",
  "value": 12
}, {
  "month": "2003-07",
  "value": 46
}, {
  "month": "2003-08",
  "value": 75
}, {
  "month": "2003-09",
  "value": 84
}, {
  "month": "2003-10",
  "value": 50
}, {
  "month": "2003-11",
  "value": 49
}, {
  "month": "2003-12",
  "value": 46
}, {
  "month": "2004-01",
  "value": 11
}, {
  "month": "2004-02",
  "value": 82
}, {
  "month": "2004-03",
  "value": 77
}, {
  "month": "2004-04",
  "value": 19
}, {
  "month": "2004-05",
  "value": 31
}, {
  "month": "2004-06",
  "value": 100
}, {
  "month": "2004-07",
  "value": 94
}, {
  "month": "2004-08",
  "value": 35
}, {
  "month": "2004-09",
  "value": 83
}, {
  "month": "2004-10",
  "value": 50
}, {
  "month": "2004-11",
  "value": 87
}, {
  "month": "2004-12",
  "value": 84
}, {
  "month": "2005-01",
  "value": 82
}, {
  "month": "2005-02",
  "value": 18
}, {
  "month": "2005-03",
  "value": 92
}, {
  "month": "2005-04",
  "value": 29
}, {
  "month": "2005-05",
  "value": 33
}, {
  "month": "2005-06",
  "value": 95
}, {
  "month": "2005-07",
  "value": 78
}, {
  "month": "2005-08",
  "value": 42
}, {
  "month": "2005-09",
  "value": 99
}, {
  "month": "2005-10",
  "value": 30
}, {
  "month": "2005-11",
  "value": 19
}, {
  "month": "2005-12",
  "value": 51
}, {
  "month": "2006-01",
  "value": 95
}, {
  "month": "2006-02",
  "value": 31
}, {
  "month": "2006-03",
  "value": 63
}, {
  "month": "2006-04",
  "value": 56
}, {
  "month": "2006-05",
  "value": 70
}, {
  "month": "2006-06",
  "value": 44
}, {
  "month": "2006-07",
  "value": 80
}, {
  "month": "2006-08",
  "value": 48
}, {
  "month": "2006-09",
  "value": 69
}, {
  "month": "2006-10",
  "value": 95
}, {
  "month": "2006-11",
  "value": 63
}, {
  "month": "2006-12",
  "value": 5
}, {
  "month": "2007-01",
  "value": 27
}, {
  "month": "2007-02",
  "value": 13
}, {
  "month": "2007-03",
  "value": 33
}, {
  "month": "2007-04",
  "value": 91
}, {
  "month": "2007-05",
  "value": 84
}, {
  "month": "2007-06",
  "value": 55
}, {
  "month": "2007-07",
  "value": 22
}, {
  "month": "2007-08",
  "value": 100
}, {
  "month": "2007-09",
  "value": 45
}, {
  "month": "2007-10",
  "value": 58
}, {
  "month": "2007-11",
  "value": 4
}, {
  "month": "2007-12",
  "value": 97
}, {
  "month": "2008-01",
  "value": 73
}, {
  "month": "2008-02",
  "value": 38
}, {
  "month": "2008-03",
  "value": 64
}, {
  "month": "2008-04",
  "value": 15
}, {
  "month": "2008-05",
  "value": 77
}, {
  "month": "2008-06",
  "value": 26
}, {
  "month": "2008-07",
  "value": 60
}, {
  "month": "2008-08",
  "value": 69
}, {
  "month": "2008-09",
  "value": 17
}, {
  "month": "2008-10",
  "value": 88
}, {
  "month": "2008-11",
  "value": 60
}, {
  "month": "2008-12",
  "value": 68
}, {
  "month": "2009-01",
  "value": 58
}, {
  "month": "2009-02",
  "value": 98
}, {
  "month": "2009-03",
  "value": 53
}, {
  "month": "2009-04",
  "value": 84
}, {
  "month": "2009-05",
  "value": 28
}, {
  "month": "2009-06",
  "value": 67
}, {
  "month": "2009-07",
  "value": 12
}, {
  "month": "2009-08",
  "value": 11
}, {
  "month": "2009-09",
  "value": 23
}, {
  "month": "2009-10",
  "value": 94
}, {
  "month": "2009-11",
  "value": 12
}, {
  "month": "2009-12",
  "value": 5
}, {
  "month": "2010-01",
  "value": 76
}, {
  "month": "2010-02",
  "value": 2
}, {
  "month": "2010-03",
  "value": 4
}, {
  "month": "2010-04",
  "value": 66
}, {
  "month": "2010-05",
  "value": 42
}, {
  "month": "2010-06",
  "value": 52
}, {
  "month": "2010-07",
  "value": 21
}, {
  "month": "2010-08",
  "value": 35
}, {
  "month": "2010-09",
  "value": 5
}, {
  "month": "2010-10",
  "value": 88
}, {
  "month": "2010-11",
  "value": 19
}, {
  "month": "2010-12",
  "value": 81
}, {
  "month": "2011-01",
  "value": 9
}, {
  "month": "2011-02",
  "value": 32
}, {
  "month": "2011-03",
  "value": 60
}, {
  "month": "2011-04",
  "value": 49
}, {
  "month": "2011-05",
  "value": 88
}, {
  "month": "2011-06",
  "value": 35
}, {
  "month": "2011-07",
  "value": 84
}, {
  "month": "2011-08",
  "value": 61
}, {
  "month": "2011-09",
  "value": 24
}, {
  "month": "2011-10",
  "value": 6
}, {
  "month": "2011-11",
  "value": 92
}, {
  "month": "2011-12",
  "value": 44
}, {
  "month": "2012-01",
  "value": 68
}, {
  "month": "2012-02",
  "value": 5
}, {
  "month": "2012-03",
  "value": 100
}, {
  "month": "2012-04",
  "value": 81
}, {
  "month": "2012-05",
  "value": 65
}, {
  "month": "2012-06",
  "value": 86
}, {
  "month": "2012-07",
  "value": 33
}, {
  "month": "2012-08",
  "value": 100
}, {
  "month": "2012-09",
  "value": 12
}, {
  "month": "2012-10",
  "value": 49
}, {
  "month": "2012-11",
  "value": 53
}, {
  "month": "2012-12",
  "value": 89
}, {
  "month": "2013-01",
  "value": 3
}, {
  "month": "2013-02",
  "value": 44
}, {
  "month": "2013-03",
  "value": 16
}, {
  "month": "2013-04",
  "value": 96
}, {
  "month": "2013-05",
  "value": 97
}, {
  "month": "2013-06",
  "value": 78
}, {
  "month": "2013-07",
  "value": 71
}, {
  "month": "2013-08",
  "value": 100
}, {
  "month": "2013-09",
  "value": 97
}, {
  "month": "2013-10",
  "value": 21
}, {
  "month": "2013-11",
  "value": 36
}, {
  "month": "2013-12",
  "value": 73
}, {
  "month": "2014-01",
  "value": 9
}, {
  "month": "2014-02",
  "value": 67
}, {
  "month": "2014-03",
  "value": 74
}, {
  "month": "2014-04",
  "value": 4
}, {
  "month": "2014-05",
  "value": 62
}, {
  "month": "2014-06",
  "value": 58
}, {
  "month": "2014-07",
  "value": 19
}, {
  "month": "2014-08",
  "value": 26
}, {
  "month": "2014-09",
  "value": 24
}, {
  "month": "2014-10",
  "value": 6
}, {
  "month": "2014-11",
  "value": 57
}, {
  "month": "2014-12",
  "value": 44
}, {
  "month": "2015-01",
  "value": 26
}, {
  "month": "2015-02",
  "value": 30
}, {
  "month": "2015-03",
  "value": 30
}, {
  "month": "2015-04",
  "value": 96
}, {
  "month": "2015-05",
  "value": 63
}, {
  "month": "2015-06",
  "value": 2
}, {
  "month": "2015-07",
  "value": 25
}, {
  "month": "2015-08",
  "value": 42
}, {
  "month": "2015-09",
  "value": 38
}, {
  "month": "2015-10",
  "value": 61
}, {
  "month": "2015-11",
  "value": 49
}, {
  "month": "2015-12",
  "value": 26
}, {
  "month": "2016-01",
  "value": 80
} ];

/*
 * Define a function that produces a subset of data (yearly)
 */

function getYearlyData( monthly ) {
  var yearly = [], yValue = 0, newY = {};
  
  for ( var i = 0; i < monthly.length; i++ ) {	  
    var dp = monthly[ i ],
      next = monthly[ i + 1 ];
    if ( next === undefined || dp.month.split('-')[0] != next.month.split('-')[0] ){
	  yValue += dp.value;
	  newY = { "month": dp.month.split('-')[0],
		"value": yValue};
      yearly.push( newY );
	  yValue = 0;
	  newY = {};
  } else {
	  yValue += dp.value;  }
  }
  console.log(yearly);
  return yearly;
}

/**
 * Create the chart itself
 */
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataDateFormat": "YYYY-MM",
  "valueAxes": [ {
    "id": "v1",
    "position": "left"
  } ],
  "graphs": [ {
    "id": "g1",
    "bullet": "round",
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "useLineColorForBulletBorder": true,
    "valueField": "value"
  } ],
  "chartScrollbar": {
    "graph": "g1",
    "oppositeAxis": false,
    "offset": 30,
    "scrollbarHeight": 50,
    "backgroundAlpha": 0,
    "selectedBackgroundAlpha": 0.1,
    "selectedBackgroundColor": "#888888",
    "graphFillAlpha": 0,
    "graphLineAlpha": 0.5,
    "selectedGraphFillAlpha": 0,
    "selectedGraphLineAlpha": 1,
    "autoGridCount": true,
    "color": "#AAAAAA"
  },
  "chartCursor": {
    "valueLineEnabled": true,
    "valueLineBalloonEnabled": true,
    "cursorAlpha": 1,
    "cursorColor": "#258cbb",
    "valueLineAlpha": 0.2,
    "categoryBalloonDateFormat": "YYYY-MM"
  },
  "categoryField": "month",
  "categoryAxis": {
    "parseDates": true,
    "minPeriod": "MM",
    "dashLength": 1,
    "minorGridEnabled": true
  },
  "dataProvider": chartData,
  "zoomOutOnDataUpdate": false
} );

/**
 * Sets proper data set
 */
function setData(type) {
  if ( type == "monthly" ) {
    chart.dataProvider = chartData;
    chart.categoryAxis.minPeriod = "MM";
    chart.chartCursor.categoryBalloonDateFormat = "YYYY-MM";
  }
  else if( type == "yearly" ) {
    chart.dataProvider = getYearlyData( chartData );
    chart.categoryAxis.minPeriod = "YYYY";
    chart.chartCursor.categoryBalloonDateFormat = "YYYY";
  }
  chart.validateData();
}

</script>
