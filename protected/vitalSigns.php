<?php
session_start();
include '../webapi-cardiobloc.php';

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

     <title>Cardiobloc web-api Sample</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
     <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
     <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
     <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
     <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
     <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
     <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
     <link rel="stylesheet" type="text/css" href="../css/util.css">
     <link rel="stylesheet" type="text/css" href="../css/main.css">
     <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Vital signs of John Doe "
	},
	axisY:{
		title: "SPO2",
		logarithmic: true,
		titleFontColor: "#6D78AD",
		gridColor: "#6D78AD",
		includeZero: true,
		labelFormatter: addSymbols
	},
	axisY2:{
		title: "HR",
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
		name: "saturation",
		yValueFormatString: "## %",
		dataPoints: <?php
                      $values = getParamValues($_SESSION['email'], $_SESSION['token']);

                      $data = array();
                      $i = 0;
                      foreach($values as $value){
                        if ($value['idparam'] == 5) { // 5 = SPO2
                          $data[$i] = array("label"=> substr($value['timestamp'],12,7), "y"=>$value['value']/100);
                          $i=$i+1;
                        }
                      }
                      echo json_encode($data, JSON_NUMERIC_CHECK);
                ?>
	},
	{
		type: "line",
		markerSize: 0,
		axisYType: "secondary",
		showInLegend: true,
		name: "heart rate",
		yValueFormatString: "#,##0 b/min",
		dataPoints: <?php
                       $values = getParamValues($_SESSION['email'], $_SESSION['token']);

                       $data = array();
                       $i = 0;
                       foreach($values as $value){
                           if ($value['idparam'] == 2) { // 2 = HR
                             $data[$i] = array("label"=> substr($value['timestamp'],12,7), "y"=>$value['value']);
                             $i=$i+1;
                           }
                       }
                       echo json_encode($data, JSON_NUMERIC_CHECK);
                       //echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
                  ?>
	}]
});
chart.render();

function addSymbols(e){
	var suffixes = ["", "%", "M", "B"];

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
<body style="background-color: #666666;">
  <div class="jumbotron">
    <?php
          if (isset($_SESSION['email'])) {
            echo '   <h1 class="display-4">Hello, '.$_SESSION['name'].'</h1>';
            echo '   <hr class="my-4">';
          }
    ?>
  </div>

  <?php
                     $values = getParamValues($_SESSION['email'], $_SESSION['token']);
                ?>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<hr class="my-4">
<?php include("./footer.php"); ?>
</body>
</html>
