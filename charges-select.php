<?php

require_once('connect.php');

if(isset($_POST['charge'])) 
{
	$chargeDesc = $_POST['charge'];
} else
{
	$chargeDesc = "--Select a Charge--";
}

$result = mysql_query("SELECT charge FROM charges") or die(mysql_error()); 

mysql_close('$con');

$arrestList = array();

while ($rows = mysql_fetch_array($result))
{
	
		//trim white space from string and add to array
		$chargesTrimmed = trim($rows['charge']);
		array_push($arrestList, $chargesTrimmed);
			
}

// take out all duplicate charges
$charges = array_unique($arrestList);

// alphabatize the list
sort($charges);

// take off the empty
array_shift($charges);

?>


        <select name="charge" />
        <option selected  value="<?php echo $chargeDesc; ?>"><?php echo $chargeDesc; ?></option>
        <option value='All Charges'>All Charges</option>
        <?php
        foreach ($charges as $charge)
        {
            echo "<option value='$charge'>$charge</option>";
        }
        ?>
        
        <input type="submit" />
        

