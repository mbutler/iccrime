<?php

$usr = "";
$pwd = "";
$db = "";
$host = "";

$con = mysql_connect($host, $usr, $pwd);

if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db($db, $con);

?>