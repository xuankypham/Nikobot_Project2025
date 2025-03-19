


<?php
//include connection file 
include_once("connection.php");
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Data Table Monitoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.dataTables.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js">  </script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/dataTables.buttons.js">  </script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.dataTables.js">  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js">  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js">  </script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.html5.min.js">  </script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.colVis.min.js">  </script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.print.min.js">  </script>


 <!--

<link rel="stylesheet" href="css/dataTables.dataTables.css" />
<link rel="stylesheet" href="css/buttons.dataTables.css" />

    <script type = "text/javascript"src="js/jquery-3.7.1.js"></script>
    <script type = "text/javascript"src="js/js/dataTables.js">  </script>

    <script type = "text/javascript"src="js/dataTables.buttons.js">  </script>
    <script type = "text/javascript"src="js/buttons.dataTables.js">  </script>
    <script type = "text/javascript"src="js/jszip.min.js">  </script>
    <script type = "text/javascript"src="js/pdfmake.min.js">  </script>
    <script type = "text/javascript"src="hjs/vfs_fonts.js">  </script>
    <script type = "text/javascript"src="js/buttons.html5.min.js">  </script>
    <script type = "text/javascript"src="js/buttons.colVis.min.js">  </script>
    <script type = "text/javascript"src="js/buttons.print.min.js">  </script>

-->



    <style>

div.dt-container {
        margin-bottom: 3em;
        width: 100%;
    }



    /*------------------NAV-----------------------*/
body {font-family: Arial, Helvetica, sans-serif;}

.navbar {
  width: 100%;
  background-color: #555;
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #000;
}

.active {
  background-color: #4CAF50;
}

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}






button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 0px 0px;
  width:100px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px
  }

/* Green ---------------------------------*/
    </style>
</head>





<body>
<?php
include_once("nav.php");
//require ("hader_css_js.php"); // the same
?>
<h3 style="text-align:left">ANALOGUE DATA LOGGING MONITOR</h3>

<div>
    <table id="analogue" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>DateTime</th>
                <th>RobotState</th>
                <th>RobotMode</th>
                <th>SpeedL</th>
                <th>SpeedR</th>
                <th>PosL</th>
                <th>PosR</th>
                <th>CurrentL</th>
                <th>CurrentR</th>
                <th>RobotStatus</th>
                <th>CtrlVolt</th>
                <th>MotorVolt</th>
                <th>FwdDist</th>
                <th>AftDist</th>
                <th>GPSLat</th>
                <th>GPSLon</th>
                <th>HostName</th>
                <th>IP</th>

            
            </tr>
        </thead>


        <?php


                $sql0 = "SELECT MAX(Id) as max_id FROM robot_data_main";     
                $max1 =  mysqli_query($con, $sql0);   
                $row = mysqli_fetch_assoc($max1); 
                $max_id=$row['max_id'];      
                //echo $max_id;  
                $sql ="";

                if ($max_id <100){

                    $sql = "SELECT * FROM `robot_data_main`";
                    }

                else{
                    $sql = "SELECT * FROM `robot_data_main`  WHERE id>  $max_id-100";
                    }

                        
            $query = mysqli_query($con, $sql) or die("error to fetch employees data");


            $cnt=1;
            while($row=mysqli_fetch_row($query))
            {
            ?>
            <tr>
            
            <td><?php echo $row['0'];?></td>
            <td><?php echo $row['1'];?></td>
            <td><?php echo $row['2'];?></td>
            <td><?php echo $row['3'];?></td>
            <td><?php echo $row['4'];?></td>
            <td><?php echo $row['5'];?></td>
            <td><?php echo $row['6'];?></td>


   
            <td><?php echo $row['7'];?></td>
            <td><?php echo $row['8'];?></td>
            <td><?php echo $row['9'];?></td>
            <td><?php echo $row['10'];?></td>


            <td><?php echo $row['11'];?></td>
            <td><?php echo $row['12'];?></td>
            <td><?php echo $row['13'];?></td>
            <td><?php echo $row['14'];?></td>
            <td><?php echo $row['15'];?></td>
            <td><?php echo $row['16'];?></td>
            <td><?php echo $row['17'];?></td>
            <td><?php echo $row['18'];?></td>

            </tr>



            <?php
            
            } ?>



        <tfoot>
            <tr>
                <th>Id</th>
                <th>DateTime</th>
                <th>RobotState</th>
                <th>RobotMode</th>
                <th>SpeedL</th>
                <th>SpeedR</th>
                <th>PosL</th>
                <th>PosR</th>
                <th>CurrentL</th>
                <th>CurrentR</th>
                <th>RobotStatus</th>
                <th>CtrlVolt</th>
                <th>MotorVolt</th>
                <th>FwdDist</th>
                <th>AftDist</th>
                <th>GPSLat</th>
                <th>GPSLon</th>
                <th>HostName</th>
                <th>IP</th>

            </tr>
        </tfoot>
    </table>

<div>

<hr>
<h3 style="text-align:left">STATUS DATA LOGGING MONITOR</h3>


<div>
    <table id="digital" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>DateTime</th>
                <th>MqttStatus</th>
                <th>CurrentL_Status</th>
                <th>CurrentR_Status</th>
                <th>CtrlVolt_Status</th>
                <th>MotorVolt_Status</th>
                <th>PS2_RemotrStatus</th>
                <th>FWD_UltraSonicSensor</th>
                <th>AFT_UltrasonicSensor</th>
 

            
            </tr>
        </thead>

         <?php

                    
                    $sql0 = "SELECT MAX(Id) as max_id FROM robot_data_status";     
                    $max1 =  mysqli_query($con, $sql0);   
                    $row = mysqli_fetch_assoc($max1); 
                    $max_id=$row['max_id'];      
                    //echo $max_id;  
                    $sql ="";

                    if ($max_id <100){

                        $sql = "SELECT * FROM `robot_data_status`";
                    }

                    else{
                        $sql = "SELECT * FROM `robot_data_status`  WHERE id>  $max_id-100";
                    }
                    //$sql = "SELECT * FROM `robot_data_status` ";
                    $query = mysqli_query($con, $sql) or die("error to fetch data");
            
            
                        $cnt=1; 
                        while($row=mysqli_fetch_row($query))
                        {
                        ?>
                        <tr>
                        
                        
                        <td><?php echo $row['0'];?></td>
                        <td><?php echo $row['1'];?></td>
                        <td><?php echo $row['2'];?></td>
                        <td><?php echo $row['3'];?></td>
                        <td><?php echo $row['4'];?></td>
                        <td><?php echo $row['5'];?></td>
                        <td><?php echo $row['6'];?></td>
        
                        <td><?php echo $row['7'];?></td>
                        <td><?php echo $row['8'];?></td>
                        <td><?php echo $row['9'];?></td>

            
                        </tr>
            
            
            
                        <?php
                        $cnt=$cnt+1;
                        } ?>
            






        <tfoot>
            <tr>
                <th>Id</th>
                <th>DateTime</th>
                <th>MqttStatus</th>
                <th>CurrentL_Status</th>
                <th>CurrentR_Status</th>
                <th>CtrlVolt_Status</th>
                <th>MotorVolt_Status</th>
                <th>PS2_RemotrStatus</th>
                <th>FWD_UltraSonicSensor</th>
                <th>AFT_UltrasonicSensor</th>
 

            </tr>
        </tfoot>
    </table>

<div>

<script>



new DataTable('#analogue', {
    
    //ajax: 'server_processing.php',
    //processing: true,
    //serverSide: true,
    "scrollX": true,
    "scrollY": 400,
    
    
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'print',
                    orientation:'landscape',       //potrait
				    pageSize: 'LEGAL',
                    title: 'DataRobotCar',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: 'DataRobotCar',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation:'landscape',       //potrait
				    pageSize: 'LEGAL',
                    title: 'DataexportPDF',
                    exportOptions: {
                      //  columns: [0, 1, 2, 3]
                       columns: ':visible'
                    }
                },
                'colvis'
            ]
        }
    }


});

//----------------------------------------------

new DataTable('#digital', {
    
    //ajax: 'server_processing_status.php',
    //processing: true,
    //serverSide: true,
    "scrollX": true,
    "scrollY": 400,
    
    
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'print',
                    orientation:'landscape',       //potrait
				    pageSize: 'LEGAL',
                    title: 'DataRobotCar',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: 'DataRobotCar',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation:'landscape',       //potrait
				    pageSize: 'LEGAL',
                    title: 'DataexportPDF',
                    exportOptions: {
                      //  columns: [0, 1, 2, 3]
                       columns: ':visible'
                    }
                },
                'colvis'
            ]
        }
    }






        


});







    </script>
    
    
    </body>
    
    </html>