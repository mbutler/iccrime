<?


$usr = "mbutler";
$pwd = "pr1nc355";
$db = "blotter";
$host = "localhost";

$con = mysql_connect($host, $usr, $pwd);

if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db, $con);


$url = "http://www.iowa-city.org/icgov/apps/police/blotter.asp";
$raw = file_get_contents($url);
$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
$content = str_replace($newlines, "", html_entity_decode($raw));
$start = strpos($content,'<table cellpadding="3" cellspacing="1" style="background-color: #333;" class="full">"');
$end = strpos($content,'</table>',$start) + 8;
$table = substr($content,$start,$end-$start);

preg_match_all("|<tr(.*)</tr>|U",$table,$rows);


foreach ($rows[0] as $row){

    if ((strpos($row,'<th')===false)){
    
        preg_match_all("|<td(.*)</td>|U",$row,$cells);
		
		preg_match_all("|<strong(.*)</strong>|U",$row,$names);
		
		preg_match_all("|<br(.*)</td>|U",$row,$addy);
		
		preg_match_all("|<strong(.*)</strong>|U",$row,$arrest_date);
		
		preg_match_all("|<strong(.*)</strong>|U",$row,$cop);
		
		preg_match_all("|<br />(.*)</td>|U",$row,$dob);
		
		$name = strip_tags($names[0][0]);
		
		$home_addy = strip_tags($addy[0][0]);
        
        $offense_date = strip_tags($arrest_date[0][1]);
		
		$offense_time = substr($offense_date, -5);
		
		$offense_date = substr($offense_date, 0, -7);
		
		$offense_date = dateconvert($offense_date);
		
		$birthday = strip_tags($dob[0][1]);
		
		$birthday = substr($birthday, 6);
		
		$birthday = dateconvert($birthday);
        
        $arrest_loc = strip_tags($cells[0][2]);
		
		$officer = strip_tags($cop[0][2]);
		
		$incident_num = strip_tags($cells[0][3]);
		
		$ca = strip_tags($cells[0][4]);
		
		$arrest_type = strip_tags($cells[0][5]);
		
		$charges = preg_split("/[0-9]\)/", $arrest_type);
		
		$show_charges = '';
		
		$addy = $arrest_loc . ", Iowa City, IA";
		$addy = str_replace("#", "", $addy);
		$addy = str_replace("&", "and", $addy);
		$addy = str_replace("/", " and ", $addy);
		$addy = str_replace("@", "", $addy);
		$addy = str_replace("BLK", "", $addy);
		$addy = str_replace("TCB", "114 E COLLEGE St", $addy);
		$addy = str_replace("BROTHERS", "125 S DUBUQUE ST", $addy);
		$addy = str_replace("VITOS", "118 E College St", $addy);
		$addy = str_replace("VON MAUR", "1668 SYCAMORE ST", $addy);
		$addy = str_replace("AIRLINER", "22 S CLINTON ST", $addy);
		$addy = str_replace("SPORTS COLUMN", "12 S DUBUQUE ST", $addy);
		$addy = str_replace("FIREWATER", "347 S GILBERT ST", $addy);
		$addy = str_replace("THE VINE", "330 E PRENTISS ST", $addy);
		$addy = str_replace("VINE", "330 E PRENTISS ST", $addy);
		$addy = str_replace("3RD BASE BAR", "111 E COLLEGE ST", $addy);
		$addy = str_replace("Behind Star Lounge", "509 S GILBERT ST", $addy);
		$addy = str_replace("BEHIND", "", $addy);
		$addy = str_replace("ALLEY", "", $addy);
		//$addy = str_replace("IOWA CITY", "410 E WASHINGTON ST", $addy);
		$addy = str_replace("THIRD BASE BAR", "111 E COLLEGE ST", $addy);
		$addy = str_replace("FIELD HOUSE", "113 E COLLEGE ST", $addy);
		$addy = str_replace("THIRD BASE", "113 E COLLEGE ST", $addy);
		$addy = str_replace("OLD CAPITOL MALL", "201 S CLINTON ST", $addy);
		$addy = str_replace("ACE AUTO RECYCLERS", "2752 S RIVERSIDE DR", $addy);
		$addy = str_replace("SOUTHEAST JR HIGH", "2502 BRADFORD DR", $addy);
		$addy = str_replace("SAMS PIZZA", "441 S GILBERT ST", $addy);
		$addy = str_replace("CAPITOL ST RAMP", "CAPITOL ST", $addy);
		$addy = str_replace("LIQUOR HOUSE", "425 S GILBERT ST", $addy);
		$addy = str_replace("BROTHERS BAR", "125 S DUBUQUE ST", $addy);
		$addy = str_replace("SUMMIT BAR", "10 S CLINTON ST", $addy);
		$addy = str_replace("UNION BAR", "121 E COLLEGE ST", $addy);
		$addy = str_replace("UNION", "121 E COLLEGE ST", $addy);
		$addy = str_replace("YACHT CLUB", "13 S LINN ST", $addy);
		$addy = str_replace("TATE HIGH SCHOOL", "1528 MALL DR", $addy);
		$addy = str_replace("THE SUMMIT BAR", "10 S CLINTON ST", $addy);
		$addy = str_replace("PINTS", "118 S CLINTON", $addy);
		$addy = str_replace("GABES", "330 E WASHINGTON ST", $addy);
		$addy = str_replace("PIANO LOUNGE", "217 IOWA AVE", $addy);
		$addy = str_replace("IOWA CITY PUBLIC LIBRARY", "123 S LINN ST", $addy);
		$addy = str_replace("CHAUNCEY SWAN RAMP", "460 E WASHINGTON ST", $addy);
		$addy = str_replace("MARTINIS", "127 E COLLEGE ST", $addy);
		$addy = str_replace("PED MALL ALLEY", "111 S DUBUQUE ST", $addy);
		$addy = str_replace("OUTSIDE", "", $addy);
		$addy = str_replace("IN FRONT OF", "", $addy);
		$addy = str_replace("SE JUNIOR HIGH", "2502 BRADFORD DR", $addy);
		$addy = str_replace("PED MALL", "111 S DUBUQUE ST", $addy);
		$addy = str_replace("SYCAMORE MALL", "1660 SYCAMORE ST", $addy);
		$addy = str_replace("CITY HIGH", "1900 MORNINGSIDE DR", $addy);
		$addy = str_replace("WEST HIGH", "2901 MELROSE AVE", $addy);
		$addy = str_replace("brothers", "125 S DUBUQUE ST", $addy);
		$addy = str_replace("MENARDS", "2605 NAPLES AVE", $addy);
		$addy = str_replace("GROOVY KATZ SALON", "1565 S 1ST AVE", $addy);
		$addy = str_replace("KMART", "901 HOLLYWOOD BLVD", $addy);
		$addy = str_replace("MILIOS", "20 S CLINTON ST", $addy);
		$addy = str_replace("SLIPPERY PETES", "118 S DUBUQUE ST", $addy);
		$addy = str_replace("DCS", "124 S DUBUQUE ST", $addy);
		$addy = str_replace("DUBUQUE ST RAMP", "DUBUQUE ST", $addy);
		$addy = str_replace("FIRESTONE", "231 E BURLINGTON", $addy);
		$addy = str_replace("UNK", "410 E WASHINGTON ST", $addy);
				
		/*
		$addy = str_replace("", "", $addy);
		
		*/
		
		
		$addy_serial = str_replace(" ", "+", $addy);		
		$uri = "http://where.yahooapis.com/geocode?location=";
		$uri .= $addy_serial;
		$uri .= "&flags=P&appid=";
		$uri .= $api;
		//echo $id . "<br />";
		//echo $addy;
				
		
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

if ($lat == 41.657825)
{
	$lat = 0.000000;
	$lng = 0.000000;
}
		
						
		$sql="INSERT INTO arrests (name, address, dob, location, lat, lng, arrest_date, arrest_time, officers, ca, incident ) VALUES('$name', '$home_addy', '$birthday', '$arrest_loc', '$lat', '$lng', '$offense_date', '$offense_time', '$officer', '$ca', '$incident_num')";
		$result = mysql_query($sql);
		unset($charges[0]);
		
		
			
		foreach ($charges as $charge)
		{
			
			$show_charges .= $charge;
			//$show_charges .= "<br />";
			$sql3="INSERT INTO charges (charge, incident) VALUES('$show_charges', '$incident_num')";
			$result3 = mysql_query($sql3);
			$show_charges = '';
			
		}
		


        //echo "<strong>Name:</strong> " . $name . "<br /> " . "<strong>Birth date:</strong> " . $birthday . "<br />" . "<strong>Home address:</strong> " . $home_addy . "<br />" . "<strong>Arrest location:</strong> " . $arrest_loc . "<br />" . "<strong>Arrest date:</strong> " . $offense_date . "<br />" . "<strong>Arrest time:</strong> " . $offense_time . "<br />" .  "<strong>Officer(s): </strong>" . $officer . "<br />" . "<strong>Charges:</strong> " . $show_charges . "<br /><br />";
		
    
    }

}

//echo "Congratulations!  The ICPD arrest blotter for today has been added to your private database, sir.";

function dateconvert($olddate) 
{
 	$newdate = explode("/", $olddate);
	
	$year = $newdate[2];
	$month = $newdate[0];
	$day = $newdate[1];
	$zero = "0";
	
	if (strlen($month) == 1)
	{
		$month = $zero . $month;
	}
	
	if (strlen($day) == 1)
	{
		$day = $zero . $day;
	}
	
	$isodate = $year . "-" . $month . "-" . $day;
	
		
	return $isodate;	
	     
		 
}

