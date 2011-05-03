<html>
<head>
<!-- <meta http-equiv="refresh" content="1" -->
</head>
<body>
</body>
</html>

<?php

require_once('connect.php');

$result = mysql_query("SELECT * FROM arrests WHERE age = 0") or die(mysql_error());

while ($rows = mysql_fetch_array($result))
{
	$id = $rows['arrests_id'];
	$dob = $rows['dob'];
	$dob = strtotime($dob);
	$arrestDate = $rows['arrest_date'];
	$arrestDate = strtotime($arrestDate);
	$thisAge = getAge($dob, $arrestDate);
	//echo $id . "<br />";
	//echo $dob . "<br />";
	//echo $arrestDate . "<br />";
	//echo $thisAge;
	
	
	$update = mysql_query("UPDATE arrests SET age = '$thisAge' WHERE arrests_id = $id") or die(mysql_error());
	mysql_query($update);
	
	
}

/*** make sure this is set ***/
date_default_timezone_set('America/Chicago');

function getAge( $dob, $tdate )
{
        $age = 0;
        while( $tdate > $dob = strtotime('+1 year', $dob))
        {
                ++$age;
        }
        return $age;
}

?>