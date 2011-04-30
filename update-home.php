<html>
<head>
<meta http-equiv="refresh" content="1"
</head>
<body>
</body>
</html>

<?php 

require_once('connect.php');

$api ="998ed1d22c4d13e5c17de899c7ad397b7280b926";
//41.657825 -91.526534 is the default coord it returns when it can't parse the address
//41.647156	-91.536301 is another default coord it returns when it can't parse the address
//1.000000 lat and lng are for special cases to examine
// 41.657833	91.522858 900 E Burlington

$result = mysql_query("SELECT * FROM arrests WHERE address = 'UNK' LIMIT 1") or die(mysql_error()); 
//$result = mysql_query("SELECT * FROM arrests WHERE arrest_date LIKE '%2010-04%' LIMIT 1") or die(mysql_error()); 

while ($rows = mysql_fetch_array($result))
{
		//$id = $rows['arrests_id'];
		//$date = $rows['arrest_date'];
		//$date = str_replace("2010", "2011", $date);
		
		//construct URI
		$id = $rows['arrests_id'];
		$addy = $rows['address'];
		$addy = str_replace("UNK", "UNKNOWN", $addy);
		$addy = str_replace("unk", "UNKNOWN", $addy);
			
				
		/*
		$addy = str_replace("", "", $addy);
		
		*/	
				
		$update = mysql_query("UPDATE arrests SET address = '$addy' WHERE arrests_id = $id") or die(mysql_error());
		//$update = mysql_query("UPDATE arrests SET arrest_date = '$date' WHERE arrests_id = $id") or die(mysql_error());
		mysql_query($update);
		
		mysql_close('$con');
		
		
		echo $id;
		echo "<br />";
		echo "address: " . $addy;
				
	
} //end while

?>


