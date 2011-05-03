
<?php 

if(isset($_POST['start-age'])) 
{
	$AgeDesc = $_POST['start-age'];
	
} else
{
	$AgeDesc = 10;
}
echo "<option value='$AgeDesc'>$AgeDesc</option>";

for ($age=10; $age<=85; $age++)
{
	
	echo "<option value='$age'>$age</option>";
	
}
?>