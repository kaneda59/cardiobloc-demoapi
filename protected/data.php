<?php

$dataPoints = array(
	array("label"=> 1992, "y"=>105),
	array("label"=> 1993, "y"=>130),
	array("label"=> 1994, "y"=>158),
	array("label"=> 1995, "y"=>192),
	array("label"=> 1996, "y"=>309),
	array("label"=> 1997, "y"=>422),
	array("label"=> 1998, "y"=>566),
	array("label"=> 1999, "y"=>807),
	array("label"=> 2000, "y"=>1250),
	array("label"=> 2001, "y"=>1615),
	array("label"=> 2002, "y"=>2069),
	array("label"=> 2003, "y"=>2635),
	array("label"=> 2004, "y"=>3723),
	array("label"=> 2005, "y"=>5112),
	array("label"=> 2006, "y"=>6660),
	array("label"=> 2007, "y"=>9183),
	array("label"=> 2008, "y"=>15844),
	array("label"=> 2009, "y"=>23185),
	array("label"=> 2010, "y"=>40336),
	array("label"=> 2011, "y"=>70469),
	array("label"=> 2012, "y"=>100504),
	array("label"=> 2013, "y"=>138856),
	array("label"=> 2014, "y"=>178391),
	array("label"=> 2015, "y"=>229300),
	array("label"=> 2016, "y"=>302300),
	array("label"=> 2017, "y"=>368000)
);

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Vital signs of John Doe "
	},
	axisY:{
		title: "Energy (in megawatt)",
		logarithmic: true,
		titleFontColor: "#6D78AD",
		gridColor: "#6D78AD",
		includeZero: true,
		labelFormatter: addSymbols
	},
	axisY2:{
		title: "Energy (in megawatt)",
		titleFontColor: "#51CDA0",
		tickLength: 0,
		labelFormatter: addSymbols
	},
	legend: {
		cursor: "pointer",
		verticalAlign: "top",
		fontSize: 16,
		itemclick: toggleDataSeries
	},
	data: [{
		type: "line",
		markerSize: 0,
		showInLegend: true,
		name: "Log Scale",
		yValueFormatString: "#,##0 MW",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "line",
		markerSize: 0,
		axisYType: "secondary",
		showInLegend: true,
		name: "Linear Scale",
		yValueFormatString: "#,##0 MW",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

function addSymbols(e){
	var suffixes = ["", "K", "M", "B"];

	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
	if(order > suffixes.length - 1)
		order = suffixes.length - 1;

	var suffix = suffixes[order];
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
