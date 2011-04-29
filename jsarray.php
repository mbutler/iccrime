<?php

// Testing Git
// CREATES THE JAVASCRIPT ARRAY FROM A DATABASE QUERY
require_once('connect.php');

$charge = isset($_POST['charge']) ? $_POST['charge'] : "";
$beginDate = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
$endDate = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
$intervalLength = 1;
$intervalType = "WEEK";

//basic
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge = ' $charge ' GROUP BY arrests.name") or die(mysql_error());

//Sorts by charges and address
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge = ' $charge ' AND arrests.address LIKE '%chicago%' GROUP BY arrests.name") or die(mysql_error());

//Sorts on keywords, good for presets
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge LIKE '%Marijuana%' GROUP BY arrests.name") or die(mysql_error());

//Everyone from Chicago
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE address LIKE '%chicago%'");

//All arrests from Chicago and Cedar Rapids people
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE arrests_id >571 AND arrests.address LIKE '%chicago%' OR arrests.address LIKE '%cedar rapids%' GROUP BY arrests.name");

//Everything in the last week using variables
//$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge = ' $charge ' AND DATE_SUB(CURDATE(),INTERVAL $intervalLength $intervalType) <= arrest_date GROUP BY arrests.name") or die(mysql_error());

//charges in a date range
$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE charges.charge = ' $charge ' AND arrest_date BETWEEN '$beginDate' AND '$endDate' GROUP BY arrests.name") or die(mysql_error());

if ($charge == "All Charges")
{
	$result = mysql_query("SELECT * FROM arrests JOIN charges ON arrests.incident = charges.incident WHERE arrests_id >571 AND arrest_date BETWEEN '$beginDate' AND '$endDate' GROUP BY arrests.name");
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