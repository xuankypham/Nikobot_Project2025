<?php 
//date_default_timezone_set("Africa/Abidjan");
//date_default_timezone_set("Asia/Ho_Chi_Minh");
date_default_timezone_set("Pacific/Auckland");


include('connection.php');


//$datetime= date("Y-m-d H:i:s");

$dt0=date_create($datetime);
$dt0=date_format($dt0,"Y-m-d H:i:s");


$mqtt_status= $_POST["mqtt_status"];
$currentL_status=$_POST["currentL_status"];
$currentR_status=$_POST["currentR_status"];
$ctr_volt_status =$_POST["ctr_volt_status"];
$motor_volt_status=$_POST["motor_volt_status"];
$ps2_remote =$_POST["ps2_remote"];
$fwd_enb= $_POST["fwd_enb"];
$aft_enb = $_POST["aft_enb"];



$sql = "INSERT INTO `robot_data_status` (`datetime`,`mqtt_status`,`currentL_status`,`currentR_status`,`ctr_volt_status`,`motor_volt_status`,`ps2_remote`, `fwd_enb`,`aft_enb`) 
values ('$dt0', '$mqtt_status', '$currentL_status','$currentR_status', '$ctr_volt_status', '$motor_volt_status','$ps2_remote','$fwd_enb', '$aft_enb')";
$query= mysqli_query($con,$sql);



$con->close();
?>

