<!DOCTYPE html>
<html>
<head>
<title> CONTROL ROBOT CAR BY WEB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 


<script src="js/joy.js"></script>


<script src="js/mqttws31.js" type="text/javascript"></script>
 	<script type = "text/javascript"  src = "js/jquery-3.7.1.min.js"></script>

  
<style>

/* --------------------------------------------*/

.menu > a:link {
    position: absolute;
    display: inline-block;
    right: 12px;
    padding: 0 6px;
    text-decoration: none;
    }
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .0s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #326C88;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #326C88;
  cursor: pointer;
}

/* Rounded switch */

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider1 {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider1:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .2s;
  transition: .2s;
}

input:checked + .slider1 {
  background-color: #326C88;
}

input:focus + .slider1 {
  box-shadow: 0 0 1px #326C88;
}

input:checked + .slider1:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider1.round {
  border-radius: 34px;
}

.slider1.round:before {
  border-radius: 50%;
}
/*------------------Button----------------------*/
.led{
  font-weight : bold;
}

             ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;

        
                
              }

              li {
                float: left;
        width: 50%;
        text-align: center;   
              }

      
         h2{
              text-align: center;
              color: white;
              background-color:teal;
            padding:0px;
            margin: 0px;
              
              }
            h5{
              text-align: center;
              color: white;
              background-color:teal;
            padding:0px;
            margin: 0px;
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














  
  button:hover {
  background-color: blue;
	
	}
input {
   text-align :center;
   width: 170px;
   height: 20px;
   
   font-size: 16px;
   }
 .com{
	font-weight: bold;
    font-size: 16px;
   }





  
  
  
  
 


 

table tr, td{ 
  border: 1px solid ;
  height: 20px; 
  

}

table {
  width: 100%;
  text-align: left;
 
}

/* ---------------------JOYSTICK-----------------------*/


.row
{
	display: inline-flex;
	clear: both;
}
.columnLateral
{
  float: left;
  width: 15%;
  min-width: 500px;
}
.columnCetral
{
  float: left;
  width: 70%;
  min-width: 500px;
}
#joy2Div
{
	width:400px;
	height:400px;
	margin:50px
}
#joystick
{
	border: 1px solid #FF0000;
}
#joystick2
{
	border: 1px solid #0000FF;
}


.tablesetup {
border: none;
width: 100%;
text-align: left;


}






#messages
{
background-color:yellow;
font-size:3;
font-weight:bold;
line-height:140%;
}
#status
{
background-color:red;
font-size:4;
font-weight:bold;
color:white;
line-height:140%;
}
</style>




</head>
<body>

<?php
include_once("nav.php");
//require ("hader_css_js.php"); // the same
?>
<h3 style="text-align:left">CONTROL ROBOT CAR</h3>
<h4>Date: <span id="dateval"> </span> -    Time: <span id="timeval">  </span> </h4>
<br>



<!-----------------MAIN PROGRAM-------------------->

<div style="background-color:MintCream; margin-bottom:1px; padding:0px 0px 20px 0px ; text-align:center" >

  <ul>
    <li>
    <p>STATUS: <span class="led" id="robot_mode">MANUAL</span></p> 
    <label class="switch">
      <input class="Button"type="checkbox" id="button0" onchange="state_change(0)">
      <span class="slider1 round"></span>
    </label>
    </li>
    <li>
    <p>ROBOT CAR: <span class="led"id="robot_state">OFF</span></p> 
    <button id="Start" onclick="state_change(1)"> START</button>
	<button id="Stop" onclick="state_change(2)"> STOP</button>

    </li>
  </ul>
</div>

<div style="background-color: MintCream; margin-bottom:1px; padding:0px 0px 20px 0px ; text-align:center; display: inline;">
	<h5> Robot control area screen</h5>



  <div style="text-align: center;">
        
    <table class = "controlBT" style="float:center">
    <tr>
      <td>   </td>
      <td> <button class = "ctrBt" onclick=" state_change(3)">  <i class="fa fa-arrow-circle-o-up" aria-hidden="true" style ="font-size: 100px;"></i> FWD </button>  </td>
      <td>  </td>
      
      <!--<td style=" color: white;">SPACE BETWEEN</td> -->
      <td>   </td>





      <td>  </td>
      <td> <button class = "ctrBt" onclick=" state_change(41)">  <i class="fa fa-arrow-up" aria-hidden="true" style ="font-size: 100px;" ></i>BWD-LEFT </button>   </td>
     
      <td>  </td>



    </tr>
    <tr>
      <td> <button class = "ctrBt"onclick=" state_change(5)" >   <i class="fa fa-arrow-circle-o-left" aria-hidden="true" style ="font-size: 100px;"></i> LEFT </button>   </td>
      <td>   </td>
      <td><button class = "ctrBt" onclick=" state_change(6)"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true" style ="font-size: 100px;"></i>  RIGHT </button>    </td>
     
      <td></td>

      <td> <button class = "ctrBt"onclick=" state_change(51)">  <i class="fa fa-arrow-left" aria-hidden="true" style ="font-size: 100px;" ></i>  FWD-LEFT </button>   </td>
      <td>   </td>
      <td><button class = "ctrBt" onclick=" state_change(61)">  <i class="fa fa-arrow-right" aria-hidden="true" style ="font-size: 100px;" ></i>  FWD-RIGHT </button>    </td>

    </tr>

    <tr>
      <td>   </td>
      <td> <button class = "ctrBt" onclick=" state_change(4)">   <i class="fa fa-arrow-circle-o-down" aria-hidden="true" style ="font-size: 100px;"></i>BWD </button>   </td>
      <td>   </td>

      <td></td>
      <td> <button style= "width: 100px; height:100px;" class = "ctrBt"  onclick=" state_change(42)"> <i class="fa fa-undo" aria-hidden="true" style ="font-size: 100px;"></i>  SPINLEFT </button>   </td>
      <td> <button class = "ctrBt" onclick=" state_change(43)">  <i class="fa fa-arrow-down" aria-hidden="true" style ="font-size: 100px;" ></i>BWD-RIGHT </button>   </td>
      <td> <button style= "width: 100px; height:100px;" class = "ctrBt"  onclick=" state_change(31)"><i class="fa fa-repeat" aria-hidden="true" style ="font-size: 100px; "></i> SPIN RIGHT   </button>  </td>
     
      
  </tr>

  </table>
  
  <br>
  <div style ="width: 50%; text-align: left;">
    <i> SPEED SETTING</i><input type="range" min="1" max="255" value="0" class="slider" id="speedSlider" onchange="speedchange()">
    <p>Value:  0 to 100% : <span id="speedset"> 0 </span></p>

  </div>

  <br>
  <hr> 

<div>
<h2> JOYSTICK CONTROLLER</h2>

<p id ="demo2" > MODE OF CONTROLL SELECT Please Move Joystick Slowly, Monitor Speed Command </p>  

    <div style = "text-align: left;">
      <input type="radio" 
             id="Digital" 
             name="mode_ctrl" 
             value="0" checked>
      <label for="Digital">KeyBoard_Button</label>

      <input type="radio" 
             id="Joystick" 
             name="mode_ctrl" 
             value="1">
      <label for="Joystick">JOYSTICK</label>
  </div>
  
		<div class="row" >
			<div class="columnLateral" >
				<div id="joy1Div" style="width:400px;height:400px;margin:50px"></div>			

			</div>
<div id="joy3Div" style="width:200px;height:200px;margin:50px;position:fixed;bottom:30px;left:500px;"></div>
				<!-- Example of two JoyStick integrated in the page structure -->
    
      <div > 

        Posizione X:<input id="joy1PosizioneX" type="text" /><br />`
				Posizione Y:<input id="joy1PosizioneY" type="text" /><br />
				Direzione:<input id="joy1Direzione" type="text" /><br />
				X :<input id="joy1X" type="text" /></br>
				Y :<input id="joy1Y" type="text" /> <br>
        SPEED: <input id = "controlspeed" type="text"> <br>
        Command: <input id = "MoveComand" type="text"> <br>
         

       EM Start/Stop <button onclick ="emergencystop(0)"> <img id =" img_startstop"src="img/Stop1.png" /> </button> <button onclick ="emergencystop(1)"> <img id =" img_startstart"src="img/Start.png" /> </button><br>
              CarSpeedLimit: <input type ="number" min= '0' max ="255" value="150" id="speedlimit"> <input type = "submit" value="SETMAXSPEED" onclick="setspeedlimit()">
      
      
      </div>




		</div>
     
</div>



</div>
<br>
<hr>
<h5> Data Table monitoring</h5>
<br>
<div>


  
    <table>
      <tr> 
        <td> MotorL Kmh:</td>  <td id="speedL_kmh"> 0.0 </td> <td>M DirectL: </td>  <td id="directL">0.0</td> <td>  M_CurrentL:</td>  <td id= "currentL">0.0  </td>  <td> GPS:</td>  <td id="gps"> 0.0 </td>
      </tr>
      <tr> 
        <td> MotorR Kmh:</td>  <td id="speedR_kmh"> 0.0</td> <td> M DirectR: </td>  <td id="directR"> 0.0 </td>  <td> M_CurrentR:</td>  <td id= "currentR"> 0.0 </td> <td> GPS_SpeedKmh:</td> <td id ="gpsspeed_kmh">0.0  </td>
      </tr>
      <tr> 
        <td> MotorL RPM:</td>  <td id="speedL_rpm"> 0.0</td> <td> M_POSL:</td>  <td id = "posL"> 0.0 </td>  <td>M_Volt: </td>  <td id="M_volt"> 0.0 </td> <td> GPS_Speedms:</td> <td  id = "gpsspeed_ms"> 0.0 </td>
      </tr>
      <tr> 
        <td> MotorR RPM:</td>  <td id="speedR_rpm"> 0.0</td> <td> M_POSR:</td>  <td id="posR"> 0.0 </td>  <td> CTR_Volt:</td>  <td id = Ctr_volt>0.0  </td> <td> GPS_Distance </td> <td id = "gpsdistance"> 0.0 </td>
      </tr>
      <tr> 
        <td> Temperature:</td>  <td id="temperature"> 0.0</td> <td> Humidity:</td>  <td id="humidity"> 0.0 </td>  <td> FWD_Distance:</td>  <td id ="fwd_dist" >0.0  </td> <td> AFT_Distance </td> <td id = "aft_dist"> 0.0 </td>
      </tr>
      

    </table>
  </div>
    

</div>

<div>


<h5> ALARM AND EVENT SCREEN </h5>
<table>
<tr> 
<td> MovingStatus:</td>  <td id="MoveStatus"> STOP </td> <td> L_HCurrent:</td>  <td id="LeftCurrentHigh"> NORMAL </td>  <td> R_Hcurrent:</td>  <td id = "RightCurrentHigh"> NORMAL  </td> <td> Spare </td> <td > Spare</td>
</tr>
<tr> 
<td> LowVolt_Ctrl:</td>  <td id="LowVolt_Ctrl"> NORMAL </td> <td> LowVolt_Motor:</td>  <td id="LowVolt_Motor"> NORMAL </td>  <td> PS2_Remote:</td>  <td id = "PS2"> NORMAL  </td> <td> Spare </td> <td > Spare</td>
</tr>

</table>

</div>

<h5> Communication status </h5>
<br>
<hr>


<div>
  
<div style="text-align: left;">

    <p>Websocket Status:  <span id="WSstatus"> Disconnected <span></p> 
    
    <fieldset style = "width: 30%; background-color: #f5eeee;">
      <legend>SETUP PARAMETER FIELD</legend>
    <table> <tr>
    <td>SocketServer: </td><td><input style =" width:200px" id = "ipadd" type="text"  placeholder="192.168.0.101" > </input> </td>
  </tr>
  <tr>
   <td> PORT:</td> <td><input style =" width:200px" id = "wsport" type="text"  value="81" placeholder="81"> </input> </td> 
    <input id="btws" type ="button" onclick="onconnect()" value="SETUP WEBSOCKET" style="width: 200px;">  </input>
  </tr>

  <tr> 
    <td>  
    
      WS Server address:</td> <td>
        <input id = "ip" type="text"  placeholder="http://192.168.1.8" readonly style=" width:200px "> </input>
    </td>
    
    </tr>
<br> <hr>
<tr> <td>MQTT STATUS</td >    <td id = "mqttstatus" >  DISCONNECTED </td></tr>

  </table>

  </fieldset>

  <br> <hr>
       
</div>

<div>
  <fieldset style = "width: 30%; background-color: #f5eeee;">
  <legend>SETUP TYPE OF CONTROL </legend>
<table class="tablesetup"> 

  <tr><td><label>CONTROL MODE</label>  </td> 
    <td>  
     <input type="radio" id="websocket_mode" name="typecontrol" value="websocket">
    <label for="typecontrol">WEBSOCKET</label><br>

    <input type="radio" id="mqtt_mode" name="typecontrol" value="mqttmode"  checked>
    <label for="typecontrol">MQTT </label><br>
 
        
    <input type="radio" id="Automatic_gps" name="typecontrol" value="gps">
    <label for="typecontrol">Auto by gps</label><br> 

  </td></tr>

    

</table>

</fieldset>
</div>

<!--                           Safety            -->


<hr>


<div>
  <fieldset style = " width: 30%; background-color: #f5eeee;">
  <legend>SETUP SAFTY DISTANCE STOP CAR </legend>
<table class="tablesetup"> 

  <tr><td><label>ULTRASONIC SENSOR</label>  </td> 
  <td>  
     <input type="checkbox" id="fwdsens_mode" name="typecontrol">
    <label for="typecontrol" id="aftsensor">AftSensor</label>

    <input type="checkbox" id="aftsens_mode" name="typecontrol1">
    <label for="typecontrol1"id="fwdsensor">FWDSensor </label>
    </td>
    <td> <input type="text" value ='1' id = "distance_safe"  style="width:150px"></td>
           
    <td > <p id ="fwdinterlock">FWDInterlock </p>   <p id ="bwdinterlock">BWDInterlock </p> </td>

  </td></tr>
  <tr>
    <td> SETUP</td>  <td>     <input type="button" id="bt_set_safety_dist" onclick="set_safety_distance()" value = " SETUP" style="width: 200px;">
    </td> 
    </td> <td><p  > Setting: <span id="setdist"> m </span> (m)</p>  <p> Red is Disable </p></td>
    <td> <button onclick="clearinterlock()"> CLEAR INTERLOCK </button></td>
  </tr>

    

</table>

</fieldset>
</div>



</div>


</div>


<label> DATA FROM WEBSOCKET</label>
<textarea id="response" style="width: 100%;"> test </textarea>







<?php

include_once("mqtt_seting.php");



?>



<p id="demo" > Data Send </p>
<p id="demo1" style="visibility: hidden"> test </p>




<hr> </hr>
<footer style ="text-align : center; color: blue"> CopyRight:phamxuanky82@gmail.com; <br>Zalo: 0985510900 ;Date:24/11/2024 </footer>


<script>



// Global Variable
	var speedseting =document.getElementById("speedSlider");

	var AutoButton = document.getElementById("button0");
    var AutoMan = document.getElementById("robot_mode");

    // Control MODE-------------

    var modews = document.getElementById("websocket_mode");
    var modemqtt = document.getElementById("mqtt_mode");
    //-------------------------

  var state=0;  // Value 0 Man, Val 1 Auto
  

  var myVar2 = setInterval(updateTime, 1000); 
	


  function speedchange(){
    var a = document.getElementById("speedSlider")
    document.getElementById("speedset").innerHTML = a.value;

    // if (document.getElementById("button0").checked){ // Mode = auto 

var jsonsend = {"speed": parseInt(a.value)}
  Sent = JSON.stringify(jsonsend); //String
  document.getElementById("demo").innerHTML = Sent;
// Send Data over websocket
 
  if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}
  }


//-------------------------------------------
  
       function updateTime() 
    {  
       var d = new Date();
       var t = "";
       var dayval =d.toLocaleDateString();
       var date =d.toDateString();
       t = d.toLocaleTimeString();
       
       document.getElementById('dateval').innerHTML = date;
       document.getElementById('timeval').innerHTML = t;
    }


// Sigle button change status--------------------------------------------------------------------
function state_change(i) {
 // data send to server
 var Sent;       
  
if (i==0){

    if (AutoButton.checked){
      AutoMan.innerHTML = "AUTO";
      AutoMan.style.color ="green";

    var jsonsend = {"robot_mode":true}
    Sent = JSON.stringify(jsonsend); //String
    document.getElementById("demo").innerHTML = Sent;
      
    } 
    else if (!AutoButton.checked){
      AutoMan.innerHTML = "MANUAL";
      AutoMan.style.color ="red";
        
      var jsonsend = {"robot_mode":false}
      Sent = JSON.stringify(jsonsend); //String
      document.getElementById("demo").innerHTML = Sent;
    }
}

//--------------------------------------
if (i==1){

var jsonsend = {"robot_state": true}
 Sent = JSON.stringify(jsonsend); //String
 
 document.getElementById("demo").innerHTML = Sent;
}
//------------------------------------
if (i==2){
 
 var jsonsend = {"robot_state":false}
 Sent = JSON.stringify(jsonsend); //String
 
 document.getElementById("demo").innerHTML = Sent;

}

if (i==3){
 
 var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 1}
 
 Sent = JSON.stringify(jsonsend); //String

 document.getElementById("demo").innerHTML = Sent;
}

if (i==4){
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 2}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}

if (i==5){
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 3}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}

if (i==6){
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 4}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}
//---------------------------------

if (i==31){  //SPIN RIGHT
 
 var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 9}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}

if (i==41){ //BWD-LEFT
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 7}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
} 
if (i==42){   // SPIN LEFT
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 10}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}
if (i==43){ //  BWD RIGHT
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 8}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}

if (i==51){  //FWD LEFT
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 6}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}

if (i==61){ // FWD-RIGHT
var jsonsend = {"motorspeed_cmd": parseInt(speedseting.value), "direct_cmd": 5}
 Sent = JSON.stringify(jsonsend); //String
 document.getElementById("demo").innerHTML = Sent;
}
// Send Data over websocket






// If MODE SELECTED, DATA WILL SEND BY THIS GATE WS OR MQTT
if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}






}
//-------------------------------







</script>

<script>
 
//------------Declare global varable
var speedL_kmh = document.getElementById('speedL_kmh');
    var speedR_kmh = document.getElementById('speedR_kmh');
    var speedL_rpm = document.getElementById('speedL_rpm');
    var speedR_rpm = document.getElementById('speedR_rpm');
    var posL = document.getElementById('posL');
    var posR = document.getElementById('posR');
    var directL = document.getElementById('directL');
    var directR = document.getElementById('directR');

    var currentL = document.getElementById('currentL');
    var currentR = document.getElementById('currentR');
    var M_volt = document.getElementById('M_volt');
    var Ctr_volt = document.getElementById('Ctr_volt');


    var robot_state = document.getElementById('robot_state');
    var robot_mode = document.getElementById('robot_mode');


    var gps = document.getElementById('gps');
    var gpsdistance = document.getElementById('gpsdistance');
    var gpsspeed_kmh = document.getElementById('gpsspeed_kmh');
    var gpsspeed_ms = document.getElementById('gpsspeed_ms');
    var ip = document.getElementById('ip');

    
    
    var mqttstatus = document.getElementById('mqttstatus');
    var MoveStatus = document.getElementById('MoveStatus');
    var LowVolt_Ctrl = document.getElementById('LowVolt_Ctrl');
    var LowVolt_Motor = document.getElementById('LowVolt_Motor');
    var RightCurrentHigh = document.getElementById('RightCurrentHigh');
    var LeftCurrentHigh = document.getElementById('LeftCurrentHigh');
    var temperature = document.getElementById('temperature');
    var humidity = document.getElementById('humidity');
    var PS2_status = document.getElementById('PS2');

    var fwd_dist = document.getElementById('fwd_dist');
    var aft_dist = document.getElementById('aft_dist');
    var distance_safe = document.getElementById('setdist');

    


function extractdata(data){
    var jsonObject = JSON.parse(data);
    
    
    if ('speedL_rpm' in jsonObject) {
      speedL_kmh.innerHTML =jsonObject.speedL_kmh;
      speedR_kmh.innerHTML =jsonObject.speedR_kmh;
      speedR_rpm.innerHTML =jsonObject.speedR_rpm;
      speedL_rpm.innerHTML =jsonObject.speedL_rpm;

      posL.innerHTML =jsonObject.posL;
      posR.innerHTML =jsonObject.posR;
      
      currentL.innerHTML = jsonObject.currentL;
      currentR.innerHTML =jsonObject.currentR;
      M_volt.innerHTML =jsonObject.M_volt;
      Ctr_volt.innerHTML = jsonObject.Ctr_volt;
      directL.innerHTML = jsonObject.directL;
      directR.innerHTML =jsonObject.directR;

      if (jsonObject.robot_state ==true){
      robot_state.innerHTML = "ON";} else{robot_state.innerHTML = "OFF";}

      if (jsonObject.robot_mode ==true){
       robot_mode.innerHTML = "AUTO"; document.getElementById("button0").checked=true;} else{robot_mode.innerHTML = "MANUAL"; document.getElementById("button0").checked=false;}


        if(jsonObject.carmove==0) {MoveStatus.innerHTML ="STOP";}
        else if(jsonObject.carmove==1) {MoveStatus.innerHTML ="FORWARD";}
        else if(jsonObject.carmove==2) {MoveStatus.innerHTML ="BACKWARD";}
        else if(jsonObject.carmove==3){ MoveStatus.innerHTML ="LEFT";}
        else if(jsonObject.carmove==4) {MoveStatus.innerHTML ="RIGHT";}
        else if(jsonObject.carmove==5) {MoveStatus.innerHTML ="FWD_RIGHT";}
        else if(jsonObject.carmove==6) {MoveStatus.innerHTML ="FWD_LEFT";}
        else if(jsonObject.carmove==7) {MoveStatus.innerHTML ="BWD_LEFT";}
        else if(jsonObject.carmove==8) {MoveStatus.innerHTML ="BWD_RIGHT";}
        else if(jsonObject.carmove==9) {MoveStatus.innerHTML ="SPIN_RIGHT";}
        else if(jsonObject.carmove==10) {MoveStatus.innerHTML ="SPIN_LEFT";}

          }

    
    if ('gpslat' in jsonObject) {
        
        gps.innerHTML = "LAT: " + jsonObject.gpslat + " LON: " + jsonObject.gpslon;
        ip.value =jsonObject.IP;


        //if (jsonObject.mqttstatus){ mqttstatus.textContent = "CONNECTED" ; mqttstatus.style.color ='green';} else{mqttstatus.textContent = "DISCONNECTED" ; mqttstatus.style.color ='red';}

        
        if (jsonObject.mqttstatus){ mqttstatus.innerHTML = "CONNECTED" ; mqttstatus.style.color ='green';} else{mqttstatus.innerHTML = "DISCONNECTED" ; mqttstatus.style.color ='red';}
        if (jsonObject.low_volt_ctr){LowVolt_Ctrl.style.color ="red"; LowVolt_Ctrl.innerHTML="ABNORMAL";} else {LowVolt_Ctrl.style.color ="green";LowVolt_Ctrl.innerHTML="NORMAL";}
        if (jsonObject.low_volt_motor) {LowVolt_Motor.style.color ="red"; LowVolt_Motor.innerHTML="ABNORMAL";} else {LowVolt_Motor.style.color ="green";LowVolt_Motor.innerHTML="NORMAL";}
        if (jsonObject.L_Hcurrent) {LeftCurrentHigh.style.color ="red";LeftCurrentHigh.innerHTML="ABNORMAL";} else {LeftCurrentHigh.style.color ="green";LeftCurrentHigh.innerHTML="NORMAL";}
        if (jsonObject.R_Hcurrent) {RightCurrentHigh.style.color ="red"; RightCurrentHigh.innerHTML="ABNORMAL";} else {RightCurrentHigh.style.color ="green";RightCurrentHigh.innerHTML="NORMAL";}
        

    }


    if ('PS2_status' in jsonObject) {  // package 4
      if (jsonObject.PS2_status) {PS2_status.style.color ="red"; PS2_status.innerHTML="ABNORMAL";} else {PS2_status.style.color ="green";PS2_status.innerHTML="NORMAL";}
      temperature.innerHTML =jsonObject.temp;
      humidity.innerHTML =jsonObject.humi;

      fwd_dist.innerHTML =jsonObject.fwd_dist;
      if (jsonObject.fwd_dist<800){
          fwd_dist.style.color = "red";
        } else{ fwd_dist.style.color = "lime";}

      aft_dist.innerHTML =jsonObject.aft_dist;
      
      if (jsonObject.aft_dist<800){
          aft_dist.style.color = "red";
        } else{ aft_dist.style.color = "lime";}

      gpsdistance.innerHTML =jsonObject.gpsdistance;

      gpsspeed_kmh.innerHTML =jsonObject.gpsspeed_kmh;
      gpsspeed_ms.innerHTML = jsonObject.gpsspeed_ms;

      distance_safe.innerHTML = jsonObject.dist



  //----------------------------
  if (jsonObject.aft){document.getElementById("aftsensor").style.color ="green";
      }else{ document.getElementById("aftsensor").style.color ="red"}
      if (jsonObject.fwd){document.getElementById("fwdsensor").style.color ="green";
      }else{ document.getElementById("fwdsensor").style.color ="red"}



      if (jsonObject.fwdMove){document.getElementById("fwdinterlock").style.color ="green";
      }else{ document.getElementById("fwdinterlock").style.color ="red"}
      if (jsonObject.bwdMove){document.getElementById("bwdinterlock").style.color ="green";
      }else{ document.getElementById("bwdinterlock").style.color ="red"}



    }


}


function set_safety_distance(){

var fwdsens_mode = document.getElementById("fwdsens_mode");
var aftsens_mode = document.getElementById("aftsens_mode");
var distance_safe = parseFloat(document.getElementById("distance_safe").value);

var fwd_sens_val;
var aft_sens_val;
if (fwdsens_mode.checked){fwd_sens_val=true; } else{fwd_sens_val=false;}
if (aftsens_mode.checked){aft_sens_val=true; } else{aft_sens_val=false;}



var jsonsend = {"enb_stop_fwdsensor": fwd_sens_val, "enb_stop_aftsensor": aft_sens_val, "dist_safe":distance_safe}
Sent = JSON.stringify(jsonsend); //String
document.getElementById("demo").innerHTML = Sent;

// Send Data over websocket

if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}



}



var Socket;
function onconnect(){
var server = document.getElementById("ipadd").value;

var port = document.getElementById("wsport").value;

if (server!="" &&  port!=""){

//Socket = new WebSocket('ws://' + window.location.hostname + ':81/');
//var Socket = new WebSocket('ws://192.168.0.101:81/');
Socket = new WebSocket('ws://'+server +':' + port+'/');
Socket.onopen = function () {  
  Socket.send('Connect ' + new Date());
                          var e = document.getElementById('WSstatus');
                          e.innerHTML = 'Connected !';
                          e.style.color = 'blue'         
};

Socket.onerror = function (error) {
  console.log('WebSocket Error ', error);
                          var e = document.getElementById('WSstatus');
                          e.innerHTML = 'Disconnected !';
                          e.style.color = 'red'
};

Socket.onmessage = function(event) { 
  


 var receivedata = document.getElementById('response');

 if (modews){
    receivedata.value = event.data; // print data received
 
    extractdata(receivedata.value);
    
    

  }

  };


}else{alert("Please enter websocket server address and port")}
}

  



 

  function myFunction() {
  var x = document.getElementById("wr_fwd");
  var y = document.getElementById("wr_bwd");
  var z = document.getElementById("wr_stop");

  x.style.visibility = "hidden";
  y.style.visibility = 'hidden';
  z.style.visibility= 'visible';


  /*
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }*/
}

function ToggleVisibility(divClass)
{
    var els = document.getElementsByClassName(divClass);
    for(var i = 0; i < els.length; i++)
    {
        els[i].style.visibility = els[i].style.visibility == "hidden" ? "visible" : "hidden";
    }
}


</script>


<script type="text/javascript">


//  Remap Value 
const scale = (number, [inMin, inMax], [outMin, outMax]) => {
  // if you need an integer value use Math.floor or Math.ceil here
  return    parseInt((number - inMin) / (inMax - inMin) * (outMax - outMin) + outMin);
}

  // Create JoyStick object into the DIV 'joy1Div'
  //var Joy1 = new JoyStick('joy1Div');
  
  var joy1IinputPosX = document.getElementById("joy1PosizioneX");
  var joy1InputPosY = document.getElementById("joy1PosizioneY");
  var joy1Direzione = document.getElementById("joy1Direzione");
  var joy1X = document.getElementById("joy1X");
  var joy1Y = document.getElementById("joy1Y");
  var controlspeed = document.getElementById("controlspeed");
  var MoveComand = document.getElementById("MoveComand");
  var direct_command;
  
  // Create JoyStick object into the DIV 'joy1Div'
  var Joy1 = new JoyStick('joy1Div', {}, function(stickData) {
      joy1IinputPosX.value = stickData.xPosition;
      joy1InputPosY.value = stickData.yPosition;
      joy1Direzione.value = stickData.cardinalDirection;
      joy1X.value = stickData.x;
      joy1Y.value = stickData.y;

      var xval = parseInt(joy1X.value);
      var yval = parseInt(joy1Y.value);
      var speedlimit_set = document.getElementById("speedlimit").value;

      if (speedlimit_set>255) {speedlimit_set=255;}
      if (speedlimit_set<0) {speedlimit_set=0;}
     
      if (xval>-30 && xval<30 && yval >=30){

      controlspeed.value  = String(scale(yval, [30, 100], [0, speedlimit_set]));

      MoveComand.value = "MOVE FORWARD";
      direct_command =1;
      

      } else if (xval>-30 && xval<30 && yval <=-30){

        controlspeed.value  = String(scale(yval, [-30, -100], [0, speedlimit_set]));

      MoveComand.value = "MOVE BACKWARD";
      direct_command=2;
      

      }

      else if (yval>-30 && yval<30 && xval <=-30){

      controlspeed.value  = String(scale(xval, [-30, -100], [0, speedlimit_set]));

      MoveComand.value = "MOVE LEFT";
      direct_command =3;
      

    }
    else if (yval>-30 && yval<30 && xval >=30){

    controlspeed.value  = String(scale(xval, [30, 100], [0, speedlimit_set]));
    MoveComand.value = "MOVE RIGHT";
    
    direct_command =4;

    
    
    }else{
      controlspeed.value = 0;
      MoveComand.value = "STOP";
      direct_command =0;

    }

  




    //-------------------------------------------------------------
  var joystickselect = document.getElementById("Joystick")
  var speed_seting = parseInt(controlspeed.value);

if (joystickselect.checked){
if  (speed_seting<0) {speed_seting=0;}
if (speed_seting>255){speed_seting=255;}

  var jsonsend = {"motorspeed_cmd": speed_seting, "direct_cmd": direct_command, "joystick":true}
      Sent = JSON.stringify(jsonsend); //String
      document.getElementById("demo").innerHTML = Sent;


    // If MODE SELECTED, DATA WILL SEND BY THIS GATE WS OR MQTT

          if (modews.checked){
            Socket.send(Sent); 
          }
          else if (modemqtt.checked){
            send_message_mqtt(Sent);
          }

          
  }
    

    //-------------------------------
      
      
  });
  
 


  function emergencystop(n){
    

  if (n== 1){
      state_change(1);  // START
      
  }else{ 
    state_change(2);  // STOP
  }

   


  }




  //----------------------------

function clearinterlock(){

var jsonsend = {"block_move_fwd":false, "block_move_bwd": false}
Sent = JSON.stringify(jsonsend); //String
document.getElementById("demo").innerHTML = Sent;


// If MODE SELECTED, DATA WILL SEND BY THIS GATE WS OR MQTT
if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}



}

function setspeedlimit(){
  var speedlm = document.getElementById("speedlimit").value;
  var jsonsend = {"speedlimit": parseInt(speedlm)}
Sent = JSON.stringify(jsonsend); //String
document.getElementById("demo").innerHTML = Sent;


// If MODE SELECTED, DATA WILL SEND BY THIS GATE WS OR MQTT
if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}

}


//0-------------------END WS------------------
</script>

<script src="js/mqtt_script.js"></script>


</body>
</html>

