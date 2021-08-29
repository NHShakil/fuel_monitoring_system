<?php
set_time_limit(300);

$servername = "localhost";
$username = "root";
$password = "Massive@2020#!";
$dbname = "gsm_robi";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="SELECT SUM(`used_fuel_perday`) AS fuelConsumed FROM `used_fuels` WHERE `site_id`='1234' AND `todays_date_time` BETWEEN '2020-02-01 00:00:00' AND '2020-02-29 23:59:58'";
$tmp = $conn->query($sql);
$InsertDate = $tmp->fetch_assoc();

print_r($InsertDate['fuelConsumed']);


$sql="UPDATE `monthly_reports` SET `fuel_consumed`='".$InsertDate['fuelConsumed']."' ,`modified`= CURRENT_TIMESTAMP WHERE `site_id`='1234' AND `month_name`='February'";
$tmp = $conn->query($sql);

?> 






