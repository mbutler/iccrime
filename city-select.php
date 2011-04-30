<?php

if(isset($_POST['home'])) 
{
	$homeDesc = $_POST['home'];	
	
	if ($homeDesc == "")
	{
		$homeDesc = "All Locations";
		$homeValue = "";
		
	}
} else
{
	$homeDesc = "All Locations";
	$homeValue = "";
	
}

?>

<select name="home">
<option selected  value="<?php echo $homeValue; ?>"><?php echo $homeDesc; ?></option>
<optgroup label="Default">
	<option value="">All Locations</option>
</optgroup>

<optgroup label="Cities">
    <option value="Cedar Rapids">Cedar Rapids</option>
    <option value="Coralville">Coralville</option>
    <option value="Chicago">Chicago</option>
    <option value="North Liberty">North Liberty</option>
</optgroup>

<optgroup label="Dorms">
    <option value="Burge">Burge</option>
    <option value="Currier">Currier</option>
    <option value="Daum">Daum</option>
    <option value="Hillcrest">Hillcrest</option>
    <option value="Mayflower">Mayflower</option>
    <option value="Quadrangle">Quadrangle</option>
    <option value="Rienow">Rienow</option>
    <option value="Slater">Slater</option>
    <option value="Stanley">Stanley</option>
</optgroup>

<optgroup label="Transient">
	<option value="Unknown Address">Unknown Address</option>
</optgroup>
</select>