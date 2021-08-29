<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gsm_robi";
	$con = new mysqli($servername, $username, $password, $dbname);

	if ($con->connect_error) {
	    die("Connection failed: " . $con->connect_error);
	}
	else{
	}

	$query ="SELECT * FROM zones WHERE parent_id = '".$_POST["id"]."'";
	$sub_zone_name =   $con->query($query);
?>

<option value="">Select Subzone</option>
<?php
	foreach ($sub_zone_name as $key => $value) {?>
		<option value="<?php echo $value["id"];?>"><?php echo $value['name'];?></option><?php 
	}
?>


