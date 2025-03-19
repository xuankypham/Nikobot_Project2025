<?php 
//date_default_timezone_set("Africa/Abidjan");
//date_default_timezone_set("Asia/Ho_Chi_Minh");
date_default_timezone_set("Pacific/Auckland");


include('connection.php');


//$datetime= date("Y-m-d H:i:s");

$dt0=date_create($datetime);
$dt0=date_format($dt0,"Y-m-d H:i:s");


$robot_state= $_POST["robot_state"];
$robot_mode=$_POST["robot_mode"];
$speedL=$_POST["speedL"];
$speedR =$_POST["datetime"];
$posL=$_POST["posL"];
$posR =$_POST["posR"];
$currentL=$_POST["currentL"];
$currentR= $_POST["currentR"];
$robot_status= $_POST["robot_status"];
$ctrl_volt = $_POST["ctrl_volt"];
$motor_volt = $_POST["motor_volt"];
$fwd_dist=$_POST["fwd_dist"];
$aft_dist= $_POST["aft_dist"];

$gpslat =$_POST["gpslat"];
$gpslon= $_POST["gpslon"];
$host_name = $_POST["host_name"];
$ip =$_POST["ip"];




$sql = "INSERT INTO `robot_data_main` (`datetime`,`robot_state`,`robot_mode`,`speedL`,`speedR`,`posL`,`posR`, `currentL`,`currentR`,`robot_status`,`ctrl_volt`,`motor_volt`, `fwd_dist`,`aft_dist`, `gpslat`,`gpslon`,`host_name`,`ip`) 
values ('$dt0', '$robot_state', '$robot_mode','$speedL', '$speedR', '$posL','$posR', '$currentL', '$currentR','$robot_status', '$ctrl_volt', '$motor_volt', '$fwd_dist', '$aft_dist', '$gpslat', '$gpslon', '$host_name','$ip')";
$query= mysqli_query($con,$sql);



$con->close();
?>