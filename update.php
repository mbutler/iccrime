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

$result = mysql_query("SELECT * FROM arrests WHERE lat = 0.000000 LIMIT 1") or die(mysql_error()); 
//$result = mysql_query("SELECT * FROM arrests WHERE arrest_date LIKE '%2010-04%' LIMIT 1") or die(mysql_error()); 

while ($rows = mysql_fetch_array($result))
{
		//$id = $rows['arrests_id'];
		//$date = $rows['arrest_date'];
		//$date = str_replace("2010", "2011", $date);
		
		//construct URI
		$id = $rows['arrests_id'];
		$addy = $rows['location'] . ", Iowa City, IA";
		
		$addy = str_replace("#", "", $addy);
		$addy = str_replace("&", "AND", $addy);
		$addy = str_replace("/", " AND ", $addy);
		$addy = str_replace("@", "", $addy);
		$addy = str_replace("BLK OF", "", $addy);
		$addy = str_replace("BLK", "", $addy);
		$addy = str_replace("OUTSIDE", "", $addy);
		$addy = str_replace("IN FRONT OF", "", $addy);
		$addy = str_replace("BEHIND", "", $addy);
		$addy = str_replace("ALLEY", "", $addy);
		
		$addy = str_replace("TCB", "114 E COLLEGE St", $addy);
		
		$addy = str_replace("BROTHERS BAR", "125 S DUBUQUE ST", $addy);
		$addy = str_replace("BROTHERS", "125 S DUBUQUE ST", $addy);
		$addy = str_replace("brothers", "125 S DUBUQUE ST", $addy);
		
		$addy = str_replace("VITOS", "118 E College St", $addy);
		$addy = str_replace("VON MAUR", "1668 SYCAMORE ST", $addy);
		$addy = str_replace("AIRLINER", "22 S CLINTON ST", $addy);
		$addy = str_replace("SPORTS COLUMN", "12 S DUBUQUE ST", $addy);
		$addy = str_replace("FIREWATER", "347 S GILBERT ST", $addy);
		
		$addy = str_replace("THE VINE", "330 E PRENTISS ST", $addy);
		$addy = str_replace("VINE", "330 E PRENTISS ST", $addy);
		
		$addy = str_replace("THIRD BASE BAR", "111 E COLLEGE ST", $addy);
		$addy = str_replace("3RD BASE BAR", "111 E COLLEGE ST", $addy);
		$addy = str_replace("THIRD BASE", "113 E COLLEGE ST", $addy);
		
		$addy = str_replace("STAR LOUNGE", "509 S GILBERT ST", $addy);
		
		//$addy = str_replace("IOWA CITY", "410 E WASHINGTON ST", $addy);
		
		$addy = str_replace("FIELD HOUSE", "113 E COLLEGE ST", $addy);
		
		$addy = str_replace("OLD CAPITOL MALL", "201 S CLINTON ST", $addy);
		$addy = str_replace("ACE AUTO RECYCLERS", "2752 S RIVERSIDE DR", $addy);
		$addy = str_replace("SOUTHEAST JR HIGH", "2502 BRADFORD DR", $addy);
		$addy = str_replace("SE JUNIOR HIGH", "2502 BRADFORD DR", $addy);
		
		$addy = str_replace("SAMS PIZZA", "441 S GILBERT ST", $addy);
		$addy = str_replace("CAPITOL ST RAMP", "CAPITOL ST", $addy);
		$addy = str_replace("LIQUOR HOUSE", "425 S GILBERT ST", $addy);	
		
		$addy = str_replace("THE SUMMIT BAR", "10 S CLINTON ST", $addy);
		$addy = str_replace("SUMMIT BAR", "10 S CLINTON ST", $addy);
		
		$addy = str_replace("THE UNION BAR", "121 E COLLEGE ST", $addy);
		$addy = str_replace("UNION BAR", "121 E COLLEGE ST", $addy);
		$addy = str_replace("UNION", "121 E COLLEGE ST", $addy);
		
		$addy = str_replace("YACHT CLUB", "13 S LINN ST", $addy);
		$addy = str_replace("TATE HIGH SCHOOL", "1528 MALL DR", $addy);		
		$addy = str_replace("PINTS", "118 S CLINTON", $addy);
		$addy = str_replace("GABES", "330 E WASHINGTON ST", $addy);
		$addy = str_replace("PIANO LOUNGE", "217 IOWA AVE", $addy);
		$addy = str_replace("IOWA CITY PUBLIC LIBRARY", "123 S LINN ST", $addy);
		$addy = str_replace("CHAUNCEY SWAN RAMP", "460 E WASHINGTON ST", $addy);
		$addy = str_replace("MARTINIS", "127 E COLLEGE ST", $addy);		
		$addy = str_replace("PED MALL", "111 S DUBUQUE ST", $addy);		
		$addy = str_replace("SYCAMORE MALL", "1660 SYCAMORE ST", $addy);
		
		$addy = str_replace("CITY HIGH SCHOOL", "1900 MORNINGSIDE DR", $addy);
		$addy = str_replace("CITY HIGH", "1900 MORNINGSIDE DR", $addy);
		$addy = str_replace("WEST HIGH SCHOOL", "2901 MELROSE AVE", $addy);
		$addy = str_replace("WEST HIGH", "2901 MELROSE AVE", $addy);
		
		$addy = str_replace("MENARDS", "2605 NAPLES AVE", $addy);
		$addy = str_replace("GROOVY KATZ SALON", "1565 S 1ST AVE", $addy);
		$addy = str_replace("KMART", "901 HOLLYWOOD BLVD", $addy);
		$addy = str_replace("MILIOS", "20 S CLINTON ST", $addy);
		$addy = str_replace("SLIPPERY PETES", "118 S DUBUQUE ST", $addy);
		$addy = str_replace("DCS", "124 S DUBUQUE ST", $addy);
		$addy = str_replace("DUBUQUE ST RAMP", "DUBUQUE ST", $addy);
		$addy = str_replace("FIRESTONE", "231 E BURLINGTON", $addy);
		$addy = str_replace("UNK", "410 E WASHINGTON ST", $addy);		
		$addy = str_replace("WALMART", "1001 HWY 1 WEST", $addy);
		$addy = str_replace("PAULS", "424 HWY 1 WEST", $addy);
		$addy = str_replace("JOHNSON COUNTY JAIL", "511 S CAPITOL ST", $addy);
		$addy = str_replace("SHERATON HOTEL", "210 S DUBUQUE ST", $addy);
		$addy = str_replace("PANCHEROS", "32 S CLINTON ST", $addy);
				
		/*
		$addy = str_replace("", "", $addy);
		
		*/	
				
		//build Yahoo URI query
		$addySerial = str_replace(" ", "+", $addy);		
		$uri = "http://where.yahooapis.com/geocode?location=";
		$uri .= $addySerial;
		$uri .= "&flags=P&appid=";
		$uri .= $api;
		echo $id . "<br />";
		echo $addy;				
		
		//initialize cURL session
		$ch = curl_init();
		//set the URL of the page or file to download
		curl_setopt($ch, CURLOPT_URL, $uri);
		//return the contents in a variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//execute the cURL session
		$response = curl_exec ($ch);
		//print_r($response);
		//close cURL session
		curl_close ($ch);
		
		//create an array from serialized response
		$contents = unserialize($response);
		
		//print_r($contents);		
		
		//loop through contents array
		foreach ($contents as $resultset)
		{
			foreach ($resultset as $set)
			{
				foreach ($set as $data)
				{
					$lat = $data['latitude'];
					$lng = $data['longitude'];						
									
				}
				
			}
		}

		if ($lat == 41.647156)
		{
			$lat = 0.000000;
			$lng = 0.000000;
		}
		
		$update = mysql_query("UPDATE arrests SET lat = '$lat', lng = '$lng' WHERE arrests_id = $id") or die(mysql_error());
		//$update = mysql_query("UPDATE arrests SET arrest_date = '$date' WHERE arrests_id = $id") or die(mysql_error());
		mysql_query($update);
		
		mysql_close('$con');
		
		/*
		echo $id;
		echo "<br />";
		echo "latitude: " . $lat;
		echo "<br />";
		echo "longitude: " . $lng;	
		echo "<br /><br />";
		*/		
	
} //end while

?>


