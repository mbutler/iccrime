<?php 

	require_once('calendar/classes/tc_calendar.php');
	$todayDate = date("Ymd"); 
	
	//sets the default dates to current date unless they've been posted
	if (isset($_POST['date3']))
	{
		$date3_default = $_POST['date3'];
	} else
	{
		$date3_default = $todayDate;
	}
	
	if (isset($_POST['date4']))
	{
		$date4_default = $_POST['date4'];
	} else
	{
		$date4_default = $todayDate;
	}	
		
	$myCalendar = new tc_calendar("date3", true, false);
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate(date('d', strtotime($date3_default))
		, date('m', strtotime($date3_default))
		, date('Y', strtotime($date3_default)));
	$myCalendar->setPath("calendar/");
	$myCalendar->setYearInterval(1970, 2020);
	$myCalendar->setDatePair('date3', 'date4', $date4_default);
	$myCalendar->writeScript();	  
	
	$myCalendar = new tc_calendar("date4", true, false);
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate(date('d', strtotime($date4_default))
	   , date('m', strtotime($date4_default))
	   , date('Y', strtotime($date4_default)));
	$myCalendar->setPath("calendar/");
	$myCalendar->setYearInterval(1970, 2020);
	$myCalendar->setAlignment('left', 'bottom');
	$myCalendar->setDatePair('date3', 'date4', $date3_default);
	$myCalendar->writeScript();	  

?>