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

	$query ="SELECT * FROM sites WHERE zone_id = '".$_POST["id"]."'";
	$site_name =   $con->query($query);
?>

<option value="">Select Site</option>
<?php
	foreach ($site_name as $key => $value) {?>
		<option value="<?php echo $value["SiteModuleId"];?>"><?php echo $value['site_name'];?></option><?php 
	}
?>