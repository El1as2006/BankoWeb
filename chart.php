<?php

 
$mysqli = include_once "conexion.php";
$result = $mysqli->query("select transaction_date AS 'date',COUNT(transaction_date) AS 'count' FROM transactions GROUP BY transaction_date ORDER BY transaction_date ASC LIMIT 15");
$datalist = $result->fetch_all(MYSQLI_ASSOC);
$test = array();

$dataPoints = array();
$i = 0;
foreach($datalist as $tr)
{
	$count = $tr["count"];
	$date = $tr["date"];
	$test = array("y" => $count,"label"=>$date);
	array_push($dataPoints,$test);
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Transactions"
	},
	axisY: {
		title: "Number of transactions",
		includeZero: true,
		
	},
	data: [{
		type: "bar",
		
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>          