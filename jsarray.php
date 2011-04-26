<?php

// CREATES THE JAVASCRIPT ARRAY FROM A DATABASE QUERY
require_once('connect.php');

if(isset($_POST['charge'])) $charge = $_POST['charge'];

$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge = ' $charge ' GROUP BY arrests.name") or die(mysql_error());

//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge LIKE '%Marijuana%' GROUP BY arrests.name") or die(mysql_error());
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident GROUP BY arrests.name") or die(mysql_error());
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE address LIKE '%chicago%'");
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE arrests_id >571");

mysql_close('$con');

$totalCharges = 0;

$places = "var places = new Array(";

while ($rows = mysql_fetch_array($result))
{
		$places .= '"';
		$places .= $rows['lat'];
		$places .= ',';
		$places .= $rows['lng'];
		$places .= ',';
		$places .= $rows['arrest_date'];
		$places .= ',';
		$places .= $rows['charge'];
		$places .= $rows['arrests_id'];
		$places .= '"';
		$places .= ',';
		
		$totalCharges++;		 	
	
}


$places = substr($places, 0, -1);
$places .= ");\n";

echo $places;

//echo "Total charges: $totalCharges";

?>