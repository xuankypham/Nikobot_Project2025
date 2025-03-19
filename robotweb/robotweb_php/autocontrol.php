<!DOCTYPE html>
<html>
<head>
  <title> Robot Car control</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script src="js/mqttws31.js" type="text/javascript"></script>
 	<script type = "text/javascript"  src = "js/jquery-3.7.1.min.js"></script>
<script src="js/knob.js"></script>


<style>

body {font-family: Arial, Helvetica, sans-serif;}
 h2{
      text-align: center;
      color: white;
      background-color:turquoise;
    padding:0px;
    margin: 0px;
      
      }
    h5{
      text-align: center;
      color: white;
      background-color:turquoise;
    padding:0px;
    margin: 0px;
      }
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
  background-color: #837d7d;
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




* {
  box-sizing: border-box;
}

.row {
  display: flex;
}

/* Create two equal columns that sits next to each other */
.column {
  flex: 50%;
  padding: 10px;
  height: 500px; /* Should be removed. Only for demonstration */
}




/* CREATE SWITCH */

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


table th, td,tr {
  text-align: center;
}












#object, 
#sidePanel {
  /* puts the image and side panel side by side */
  display: inline-block;

  /* makes the image and side panel aligned at the top */
  vertical-align: top;
}

#image {
  /* gives dimensions and a border to the image */
  border: 1px solid black;
  aspect-ratio: 1;
  background: yellow;

  /* puts empty space to the right of the box to separate it from the side panel */
  margin-right: 30px;
  margin-bottom: 30px;
  margin-top: 30px;
}

</style>
</head>
<body> <!-- onload="getdata_setup()">   -->

<?php
include_once("nav.php");
?>

<div>
<h4>
  CONTROL ROBOT CAR OVER WEBSERVER WITH ESP32</h4>


  <div class="row">
    <div class="column" style="background-color:#aaa;">
      <center>
        <h2>ROBOT CAR position control  by Angle</h2>
        <input type="text" class="dial" value="0" data-displayPrevious=true data-fgColor="#00A8A9" data-thickness=.6> <br>
      <label> ANGLE DEGREE</label><h1 id = "angle" style="color: rgb(3, 35, 177);"> 0 </h1>
      
        </center>



    </div>
    <div class="column" style="background-color:#bbb;">
     
     
     
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

      <table>
        <tr> <td>
          <div>
      <p> AUTO Start Begin by select Angle Control or Path then press Start button</p>
      <p>Control By: <span class="led" id="pathplan">Angle</span></p> 
          
      <!--<label class="switch">
            <input class="Button"type="checkbox" id="button1" onchange="state_change(3)">
            <span class="slider1 round"></span>
          </label>  <br>
        -->

        <input type="radio" id="byangle" name="control" value="Angle" checked onclick="state_change(3)">
        <label for="byangle">BY ANGLE</label>
        <input type="radio" id="bypath" name="control" value="Path" onclick="state_change(4)">
        <label for="bypath">BY PATH</label>
        <input type="radio" id="bypid" name="control" value="PID" onclick="state_change(5)"> 
        <label for="bypid">BY PID</label> <br>

        <label for="kp">KP</label>
        <input type="number" step="0.1" id="kp" style="width: 50px;" value="4">
        <label for="ki">KI</label>
        <input type="number" step="0.1" id="ki"  style="width: 50px;" value="0.6">
        <label for="kd">KD</label>
        <input type="number" step="0.1" id="kd"  style="width: 50px;" value="0.3"> <br>



       <button onclick ="sendpath()"> <img width=80px  height=80px id =" img_startstart"src="img/Start.png" /> </button> <button onclick ="state_change(2)"> <img  width=80px  height=80px id =" img_startstop"src="img/Stop1.png" /> </button>
        <p> CURRENT CAR ANGLE <span id="Angle" style="font-size: 40;font-weight: bold; color: #4CAF50;"> 0 </span> Deg</p> 
      </div>
      </td>

      <td>
<!-- image that will be rotated -->
<div id="object">
  <image src="img/car.png" width="200" height="200"  id="image">
</div>

<!-- side panel -->
<div id="sidePanel">
  <p id="">How many degrees is the car turned?</p>
  <input type="number" min="0" max="359" placeholder="0-359" id="degrees" value="0">
  <button id="submitButton" onclick="guessRotation()">Submit</button>
  <p id="rotationParagraph"></p>
</div>
   
      </td>
      
      
      
      </tr>
      </table>
    </div>
  </div>


  

  <div>

  <h2 > CONTROL ROBOT MOVE BY PATH PLANNING </h2>
<table>
  <thead>
    <tr>
      <th>PATH1</th>
       <th>PATH2</th>
       <th>PATH3</th>
       <th>PATH4</th>
      <th>PATH5</th>
       <th>PATH6</th>
       <th>PATH7</th>
       <th>PATH8</th>
            
    </tr>
 </thead>

 <tbody >
<tr>
<td>  <select name="move_action" id="path1" onchange="sel1(0)">
  
</select> </td>
<td>   <select name="move_action" id="path2"onchange="sel1(1)">
  
</select>   </td>
<td>   <select name="move_action" id="path3"onchange="sel1(2)">
  
</select>   </td>
<td>   <select name="move_action" id="path4"onchange="sel1(3)">
  
</select>   </td>
<td>   <select name="move_action" id="path5"onchange="sel1(4)">
  
</select>   </td>
<td>  <select name="move_action" id="path6"onchange="sel1(5)">
  
</select>    </td>
<td>  <select name="move_action" id="path7"onchange="sel1(6)">
  
</select>    </td>
<td>  <select name="move_action" id="path8"onchange="sel1(7)">
  
</select>    </td>




</tr>





<tr>
  <td>  <input type ="text"  id= "pathval1" value ="0" style="width:50%">  </td>
  <td>  <input type ="text" id="pathval2" value ="0" style="width:50%">   </td>
  <td>  <input type ="text" id= "pathval3"value ="0" style="width:50%">  </td>
  <td>  <input type ="text" id= "pathval4"value ="0" style="width:50%"> </td>
  <td> <input  type ="text" id= "pathval5"value ="0" style="width:50%">  </td>
  <td>  <input type ="text" id= "pathval6" value ="0" style="width:50%">  </td>
  <td>  <input type ="text" id= "pathval7"value ="0" style="width:50%"> </td>
  <td>  <input type ="text" id= "pathval8"value ="0" style="width:50%"> </td>
  
  
  
  
  </tr>








 </tbody>


       <tfoot>
            <tr>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                <th>Deg/Metter</th>
                

            </tr>
        </tfoot>


</table>
<p> PREPARE PATH:   <span id="pathsend"> </span> </p>

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




</div>


<label> DATA FROM WEBSOCKET</label>
<textarea id="response" style="width: 100%;"> test </textarea>






<?php

include_once("mqtt_seting.php");



?>



<p id="demo" > Data Send </p>
<p id="demo1" hidden> test </p>

















    <script>
  









      $(".dial").knob({
          'change' : function (v) { console.log(Math.round(v,0));    
      //$.ajax({url: "/setLOCATION?rotation="+Math.round(v,0), success: function(result){
              //$("#div1").html(result);
  
  
  
            var knobval = scale(Math.round(v,0),[0,100],[0,360]);
            document.getElementById("angle").textContent= String(knobval);
  

              // If MODE SELECTED, DATA WILL SEND BY THIS GATE WS OR MQTT

          if (pathplan.textContent=="Angle" && robot_state.innerHTML == "ON"){
            var jsonsend = {"autoAngle":true, "AutoSpeed":40, "Angle": parseInt(knobval) }
            Sent = JSON.stringify(jsonsend); //String
             document.getElementById("demo").innerHTML = Sent;

          if (modews.checked){
            Socket.send(Sent); 
          }
          else if (modemqtt.checked){
            send_message_mqtt(Sent);
          }

          }



          //----------------------
          if (pathplan.textContent=="PID" && robot_state.innerHTML == "ON"){
            var kp= parseFloat(document.getElementById("kp").value);
            var ki= parseFloat(document.getElementById("ki").value);
            var kd= parseFloat(document.getElementById("kd").value);
            
            var jsonsend = {"PID":true, "AutoSpeed":parseInt(knobval), "kp": kp , "ki":ki , "kd":kd};
            Sent = JSON.stringify(jsonsend); //String
            document.getElementById("demo").innerHTML = Sent;

          if (modews.checked){
            Socket.send(Sent); 
          }
          else if (modemqtt.checked){
            send_message_mqtt(Sent);
          }

          }
  
         // }});
    }
  
  
    
  
  
  
  
      });
  
  
  
  
  //  Remap Value 
  const scale = (number, [inMin, inMax], [outMin, outMax]) => {
    // if you need an integer value use Math.floor or Math.ceil here
    return    parseInt((number - inMin) / (inMax - inMin) * (outMax - outMin) + outMin);
  }
  
  
  
    </script>




<hr> </hr>
<footer style ="text-align : center; color: blue"> CopyRight:phamxuanky82@gmail.com; <br>Zalo: 0985510900 ;Date:24/11/2024 </footer>






<script>
function initDropdownList( id, min, max ) {
    var select, i, option;
    
    select = document.getElementById( id );
    for ( i = min; i <= max; i += 1 ) {
        option = document.createElement( 'option' );
        option.value = option.text = i;
        select.add( option );
    }
}


function initDropdownListpath( id,path ) {
    var select, i, option;
    
    select = document.getElementById( id );
    for ( i = 0; i <= path.length-1; i += 1 ) {
        option = document.createElement( 'option' );
        option.value = option.text = path[i];
        select.add( option );
    }
}
var id_path =["Forward","Backward","Left","Right"];

initDropdownListpath("path1",id_path);
initDropdownListpath("path2",id_path);
initDropdownListpath("path3",id_path);
initDropdownListpath("path4",id_path);
initDropdownListpath("path5",id_path);
initDropdownListpath("path6",id_path);
initDropdownListpath("path7",id_path);
initDropdownListpath("path8",id_path);



//initDropdownList( 'test1', 10, 20 );
//initDropdownList( 'test2', 100, 200 );



  var AutoButton = document.getElementById("button0");
  var AutoMan = document.getElementById("robot_mode");

  var controtypeButton = document.getElementById("button1");
  var pathplan = document.getElementById("pathplan");

  var modews = document.getElementById("websocket_mode");
  var modemqtt = document.getElementById("mqtt_mode");

  var robot_state = document.getElementById("robot_state");







function state_change(n){

  if (n==0){
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



  if (n==1){

var jsonsend = {"robot_state": true}
 Sent = JSON.stringify(jsonsend); //String
 
 document.getElementById("demo").innerHTML = Sent;
}
//------------------------------------
if (n==2){
 
 var jsonsend = {"robot_state":false}
 Sent = JSON.stringify(jsonsend); //String
 
 document.getElementById("demo").innerHTML = Sent;

}







  if (n==3){
  pathplan.innerHTML = "Angle";
  pathplan.style.color ="green";
      
  } 
 

  if (n==4){
  pathplan.innerHTML = "Path";
  pathplan.style.color ="yellow";
      
  } 
  
  if (n==5){
  pathplan.innerHTML = "PID";
  pathplan.style.color ="blue";
      
  } 





  // If MODE SELECTED, DATA WILL SEND BY THIS GATE WS OR MQTT
if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}


}



function sendpath(){
  if (pathplan.innerHTML == "Path" && robot_state.innerHTML == "ON"){
  //var Sent = document.getElementById("pathsend").textContent ;//JSON.stringify(jsonsend); //String



//let arr = [null, undefined, 1, 8, 4, 3, null];
//select_path("path1", "pathval1",0);
//select_path("path2", "pathval2",1);
//select_path("path3", "pathval3",2);
//select_path("path4", "pathval4",3);
//select_path("path5", "pathval5",4);
//select_path("path6", "pathval6",5);
//select_path("path7", "pathval7",6);
//select_path("path8", "pathval8",7);

let isNotNull = value => value != null;

let path_index_send1 = path_index_send.filter(isNotNull)


let dist_ang_send1 = dist_ang_send.filter(isNotNull)




var jsonsend= {"autoPathplan":true, "AutoSpeed" : 40 , "moveindex":path_index_send1, "dist_ang":dist_ang_send1 }
  var Sent = JSON.stringify(jsonsend); //String
 document.getElementById("pathsend").innerHTML = Sent;




let text = "Do You Want To Send Path Plan to Robot car!\n Either OK or Cancel. \n"+Sent;
if (confirm(text) == true) {
  if(path_index_send.length==dist_ang_send.length){

  if (modews.checked){
   Socket.send(Sent); 
}
else if (modemqtt.checked){
  send_message_mqtt(Sent);
}

document.getElementById("demo").textContent=Sent;
  }else{alert(" The path plan is incorrect, Please check path plan matrix the same size")}



} else {
  //text = "You have not send!";
}




}
}

</script>

<script>





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





function extractdata(data){
    var jsonObject = JSON.parse(data);
    
    
    if ('speedL_rpm' in jsonObject) {

      if (jsonObject.robot_state ==true){
      robot_state.innerHTML = "ON";} else{robot_state.innerHTML = "OFF";}

      if (jsonObject.robot_mode ==true){
       robot_mode.innerHTML = "AUTO"; document.getElementById("button0").checked=true;} else{robot_mode.innerHTML = "MANUAL"; document.getElementById("button0").checked=false;}

      }


      if ('gpslat' in jsonObject) {
        
        
        document.getElementById("ip").value =jsonObject.IP;
      }


      if ('PS2_status' in jsonObject) {
        
        
        document.getElementById("degrees").value =String(jsonObject.Angle);

        document.getElementById("Angle").innerHTML =String(jsonObject.Angle);
        guessRotation();
      }

      
      if ('pulseR' in jsonObject) {
        var pulseR = jsonObject["pulseR"];
        var pulseL = jsonObject["pulseL"];

        // pulseR  0 -86   ( 0-359)  ,  Angle = 
        /*
        
        FORWARD:  Dist_Setpoint = (int) round((dist_ang[0]*100 *86/78.5 )) + abs(auto_number_pulseR);   
        BACKWARD:  Dist_Setpoint = abs(auto_number_pulseR)- (int) round((dist_ang[0]*100 *86/78.5 ));   
        SPINRIGHT:  AngleSetpoint = (int) round((Angle* 0.5233 *86 /78.5)) + abs(auto_number_pulseR) ; 
        SPIN LEFT: AngleSetpoint = abs(auto_number_pulseR) - (int)round((Angle* 0.5233 *86 /78.5)) ; 

        check robot_status  //robot_move_status =9; Spin Right,   10 Spin Left
        */






        
      }
      



    }


</script>





<script src="js/mqtt_script.js"></script>




<script>


let degrees = document.getElementById(`degrees`)
function guessRotation() {
  let image = document.getElementById(`image`)
  //let rotation = 90;
  //let rotation ;//= Math.floor(Math.random() * 359)
  var rotation = parseInt(degrees.value);
  //let submitButton = document.getElementById(`submitButton`)
  //let difference
  //let rotationParagraph = document.getElementById(`rotationParagraph`)
  
  //image.style.transform = `rotate(${rotation}deg)`;
  
  //submitButton.addEventListener(`click`, guessRotation)
  
  
    //difference = `Math.abs(${rotation.value} - ${degrees.value})`
    //rotationParagraph.innerHTML = `Rotation is ${rotation.value}. You were off by ${difference.value}.`
  
    //rotation = Math.floor(Math.random() * 359);
    
    image.style.transform = `rotate(${rotation}deg)`;
  
  
  }




//-------------Path Planning ------------------

function checkIfDivided(a,b){
// in this section the variables come from an html document
        if(a%10==0)
        return true;
        else return false;

    }


var path_index_send =[];
var dist_ang_send =[];


function sel1(n){
if (n==0) select_path("path1", "pathval1",0);
if (n==1) select_path("path2", "pathval2",1);
if (n==2) select_path("path3", "pathval3",2);
if (n==3) select_path("path4", "pathval4",3);
if (n==4) select_path("path5", "pathval5",4);
if (n==5) select_path("path6", "pathval6",5);
if (n==6) select_path("path7", "pathval7",6);
if (n==7) select_path("path8", "pathval8",7);



var jsonsend= {"moveindex":path_index_send, "dist_ang":dist_ang_send }
  Sent = JSON.stringify(jsonsend); //String
 document.getElementById("pathsend").innerHTML = Sent;

}





function select_path(mySelect, valuedis_ang, i){
  
  var dis_ang = parseInt(document.getElementById(valuedis_ang).value);
  var select_index= parseInt(document.getElementById(mySelect).selectedIndex); //  = "2";

if (dis_ang!=0){
if ((select_index==0) || (select_index==1)){
  //document.getElementById("demo").textContent = String(dis_ang) + " m";
  dist_ang_send[i] = dis_ang;
  path_index_send[i]=select_index;

} else{

  var check = checkIfDivided(dis_ang,10);
  if (check){
    //document.getElementById("demo").textContent = String(dis_ang) + " Deg";
    dist_ang_send[i] = dis_ang;
    path_index_send[i]=select_index;

  }
  else {alert("Please enter degree 10,20 ...360");}
}


}else{alert(" Please Enter value , It is different from 0");}



} 

</script>
  

</body>
</html>
