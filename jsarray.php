<?php

// CREATES THE JAVASCRIPT ARRAY FROM A DATABASE QUERY
require_once('connect.php');

$charge = isset($_POST['charge']) ? $_POST['charge'] : "";
$home = isset($_POST['home']) ? $_POST['home'] : "";
$beginDate = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
$endDate = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";

if ($home == "Unknown Address") $home = "unknown";


//charges in a date range
$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge = ' $charge ' AND arrest_date BETWEEN '$beginDate' AND '$endDate' AND arrests.address LIKE '%$home%' GROUP BY arrests.name") or die(mysql_error());

if ($charge == "All Charges")
{
	$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE arrests_id >571 AND arrest_date BETWEEN '$beginDate' AND '$endDate' AND arrests.address LIKE '%$home%' GROUP BY arrests.name");
}

mysql_close('$con');

// get the number of rows in the result
$numRows = mysql_num_rows($result);

$totalCharges = 0;

// start constructing the array
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

//if there are no results then remove the array
if($numRows == 0) 
{
	unset($places);
} else
{
	echo $places;
}


?>