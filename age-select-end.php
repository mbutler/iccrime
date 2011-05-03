
<?php 

if(isset($_POST['end-age'])) 
{
	$AgeDesc = $_POST['end-age'];
	
} else
{
	$AgeDesc = 85;
}

echo "<option value='$AgeDesc'>$AgeDesc</option>";

for ($age=85; $age>=10; $age--)
{
	echo "<option value='$age'>$age</option>";
}
?>