<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gsm_robi";

	$date = new DateTime();
	$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
	$get_datetime = $date->format('d.m.Y');

	$con = new mysqli($servername, $username, $password, $dbname);
	if ($con->connect_error) {
	    die("Connection failed: " . $con->connect_error);
	}
	else{
	} 

	$DB_TBLName = "testing_log_devices"; 
	$filename = "$SiteId.'_'.$get_datetime";
	$file_ending = "xls";
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	$sep = "\t";

	$sql="SELECT $implode_val FROM $DB_TBLName WHERE SiteModuleId='$SiteId'"; 
	$resultt = $con->query($sql);
	while ($property = mysqli_fetch_field($resultt)) {
	    echo $property->name."\t";
	}

	print("\n");    
	while($row = mysqli_fetch_row($resultt)){
	    $schema_insert = "";
	    for($j=0; $j< mysqli_num_fields($resultt);$j++){
	        if(!isset($row[$j]))
	            $schema_insert .= "NULL".$sep;
	        elseif ($row[$j] != "")
	            $schema_insert .= "$row[$j]".$sep;
	        else
	            $schema_insert .= "".$sep;
	    }
	    $schema_insert = str_replace($sep."$", "", $schema_insert);
	    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	    $schema_insert .= "\t";
	    print(trim($schema_insert));
	    print "\n";
	}
?>