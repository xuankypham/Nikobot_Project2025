<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "robotdb";
    // Create connection
    $con = new mysqli($servername, $username, $password);
    // Check connection
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS robotdb";
if ($con->query($sql) === TRUE) {
  $con = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }


//-----------------------------------
$sql1 = "CREATE TABLE IF NOT EXISTS robot_data_main (id int(11) AUTO_INCREMENT,
datetime datetime,
robot_state varchar(10),
robot_mode varchar(10),
speedL float,
speedR float,
posL int,
posR int,
currentL float,
currentR float,
robot_status int,
ctrl_volt float,
motor_volt float,
fwd_dist float,
aft_dist float,
gpslat float,
gpslon float,
host_name varchar(20),
ip varchar(20),

                                                                                     
PRIMARY KEY  (id))";

  if($con->query($sql1) === TRUE) {
    //echo "Database and Table Online";
  }else{
    echo "Database and Table Offline" . $con->error;
  }

//------------------------------------------------------------
$sql2 = "CREATE TABLE IF NOT EXISTS robot_data_status (id int(11) AUTO_INCREMENT,
datetime datetime,
mqtt_status varchar(10),
currentL_status varchar(10),
currentR_status varchar(10),
ctr_volt_status varchar(10),
motor_volt_status varchar(10),
ps2_remote varchar(10),
fwd_enb varchar(10),
aft_enb varchar(10),



                                                             
PRIMARY KEY  (id))";
if($con->query($sql2) === TRUE) {
//echo "Database and Table Online";
}else{
echo "Database and Table Offline" . $con->error;
}
//-------------------------------------------------------



} else {
  echo "Error creating database: " . $con->error;
}

//$con->close();


?>