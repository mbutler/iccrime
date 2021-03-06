<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map-canvas { width:100%; height:80%; margin-left:auto; margin-right:auto }  
  #twitter {float:right; margin-top:0px; margin-right:5px; } 
  #options {width: 200px; margin: 10px;}
  #options-label {width: auto;}
</style>

<link rel="stylesheet" type="text/css" href="styles/calendar.css" />

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;key=YOURGOOGLEKEY">
</script>

<script language="javascript" src="calendar/calendar.js"></script>

<script type="text/javascript">
	var infowwindow = null;
	
	function initialize()
	{
	  var mapCenter = new google.maps.LatLng(41.655, -91.53);
	  var mapOptions = {zoom: 13, center: mapCenter, mapTypeId: google.maps.MapTypeId.ROADMAP};
	  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);  
	  var infowindow = new google.maps.InfoWindow({content: arrestDate+"\n"+charge});
	  
	 <?php 
	 
	 if(isset($_POST['charge'])) include_once('jsarray.php'); ?>	 
	 
	 for (var i in places)
	 {
		  var loc = places[i];
		  var latString = loc.substring(0, 9);
		  var lngString = loc.substring(10, 20);
		  var arrestDate = loc.substring(21, 31);
		  var charge = loc.substring(33);
		  var lat = parseFloat(latString);
		  var lng = parseFloat(lngString);
			
		  var coords = new google.maps.LatLng(lat,lng)
		  var marker = new google.maps.Marker({position: coords, map: map, title: arrestDate+"\n"+charge, html: arrestDate+"<br />"+charge, icon: "marker.png" }); 
		    
		  google.maps.event.addListener(marker, 'click', function() {infowindow.setContent(this.html); infowindow.open(map, this);});
																	   
	 }  
	  
	}
</script>

</head>

<body onLoad="initialize()">
<div id="map-canvas"></div>

<!--
<div id="twitter">
	<script src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script src="twitter.js">
    </script>
</div>
-->
  


<div id="options">
    <form method="POST" action="<?php echo $PHP_SELF; ?>">
<table border="0">
  <tr>
    <td colspan="4"><strong>&nbsp;Charge Type:</strong></td>
  </tr>
  <tr>
    <td colspan="4"><?php include_once('charges-select.php'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>&nbsp;Date Range:</strong></td>
  </tr>
  <tr>
    <td width="15%" height="15">&nbsp;Begin:</td>
    <td width="45%" rowspan="2"><?php include_once('datepicker.php'); ?></td>
    <td width="25%"><strong>Home:</strong></td>
    <td width="15%"><?php include_once('city-select.php'); ?></td>
  </tr>
  <tr>
    <td height="15">&nbsp;End:</td>
    <td><strong>Age Range:</strong></td>
    <td><select name="start-age"><?php include('age-select-begin.php'); ?> </select>&nbsp;to&nbsp;<select name="end-age"><?php include('age-select-end.php'); ?> </select></td>
  </tr>
  <tr>
    <td colspan="4"><input type="submit" /></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;<?php echo "Total charges: $totalCharges"; ?></td>
  </tr>
</table>

    </form>
</div>


</body>
</html>