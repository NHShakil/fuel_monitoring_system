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

	$query ="SELECT * FROM card_managements WHERE SiteModuleId = '".$_POST["SiteModuleId"]."'";
	$site_name =   $con->query($query);
?>

<option value="">Select Site</option>
<?php
	foreach ($site_name as $key => $value) {?>
		<option value="<?php echo $value["card_number"];?>"><?php echo $value['card_number'];?></option><?php 
	}
?>