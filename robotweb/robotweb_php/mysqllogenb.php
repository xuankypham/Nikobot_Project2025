

<?php
//include connection file 
include_once("connection.php");


?>


<!DOCTYPE html>
<html>
<head>
<title> CONTROL ROBOT CAR BY WEB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

<style>
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


</style>
  <head>
    <title>Websockets and mqtt robotcar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/mqttws31.js" type="text/javascript"></script>
 	<script type = "text/javascript" 
         src = "js/jquery-3.7.1.min.js"></script>
    <script type = "text/javascript">

	var message_arrive




	function onConnectionLost(){
	console.log("connection lost");
	document.getElementById("status").innerHTML = "Connection Lost";
	document.getElementById("status_messages").innerHTML ="Connection Lost";
	document.getElementById("status").style.backgroundColor='red';
	connected_flag=0;
	}
	function onFailure(message) {
		console.log("Failed");
		document.getElementById("status_messages").innerHTML = "Connection Failed- Retrying";
        setTimeout(MQTTconnect, reconnectTimeout);
        }
	function onMessageArrived(r_message){
		out_msg="Message received "+r_message.payloadString;
		out_msg=out_msg+"      Topic "+r_message.destinationName +"<br/>";
		out_msg="<b>"+out_msg+"</b>";
		//console.log(out_msg+row);

		var datareceive_str = r_message.payloadString;
		extractdata(datareceive_str);


		try{
			document.getElementById("out_messages").innerHTML+=out_msg;
		}
		catch(err){
		document.getElementById("out_messages").innerHTML=err.message;
		}
	
		if (row==1){
			row=1;
			document.getElementById("out_messages").innerHTML=out_msg;
			}
		else
			row+=1;
			
		mcount+=1;
		console.log(mcount+"  "+row);
		}
		
	function onConnected(recon,url){
	console.log(" in onConnected " +reconn);
	}
	function onConnect() {
	  // Once a connection has been made, make a subscription and send a message.
	document.getElementById("status_messages").innerHTML ="Connected to "+ host +" on port "+port;
	connected_flag=1;
	document.getElementById("status").innerHTML = "Connected Successfull";
	document.getElementById("status").style.backgroundColor='green';
	console.log("on Connect "+connected_flag);

	  }
	  function disconnect()
	  {
		if (connected_flag==1)
			mqtt.disconnect();
	  }

    function MQTTconnect() {
	var clean_sessions=document.forms["connform"]["clean_sessions"].value;
	var user_name=document.forms["connform"]["username"].value;
	console.log("clean= "+clean_sessions);
	var password=document.forms["connform"]["password"].value;
	
	if (clean_sessions=document.forms["connform"]["clean_sessions"].checked)
		clean_sessions=true
	else
		clean_sessions=false

	document.getElementById("status_messages").innerHTML ="";
	var s = document.forms["connform"]["server"].value;
	var p = document.forms["connform"]["port"].value;
	if (p!="")
	{
		port=parseInt(p);
		}
	if (s!="")
	{
		host=s;
		console.log("host");
		}

	console.log("connecting to "+ host +" "+ port +"clean session="+clean_sessions);
	console.log("user "+user_name);
	document.getElementById("status_messages").innerHTML='connecting';
	var x=Math.floor(Math.random() * 10000); 
	var cname="orderform-"+x;
	mqtt = new Paho.MQTT.Client(host,port,cname);
	//document.write("connecting to "+ host);
	var options = {
        timeout: 3,
		cleanSession: clean_sessions,
		onSuccess: onConnect,
		onFailure: onFailure,
      
     };
	 if (user_name !="")
		options.userName=document.forms["connform"]["username"].value;
	if (password !="")
		options.password=document.forms["connform"]["password"].value;
	
        mqtt.onConnectionLost = onConnectionLost;
        mqtt.onMessageArrived = onMessageArrived;
		mqtt.onConnected = onConnected;

	mqtt.connect(options);
	return false;
  
 
	}
	function sub_topics(){
		document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		out_msg="<b>Not Connected so can't subscribe</b>"
		console.log(out_msg);
		document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
	var stopic= document.forms["subs"]["Stopic"].value;
	console.log("here");
	var sqos=parseInt(document.forms["subs"]["sqos"].value);
	if (sqos>2)
		sqos=0;
	console.log("Subscribing to topic ="+stopic +" QOS " +sqos);
	document.getElementById("status_messages").innerHTML = "Subscribing to topic ="+stopic;
	var soptions={
	qos:sqos,
	};
	mqtt.subscribe(stopic,soptions);
	return false;
	}
	function send_message(){
		document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		out_msg="<b>Not Connected so can't send</b>"
		console.log(out_msg);
		document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
		var pqos=parseInt(document.forms["smessage"]["pqos"].value);
		if (pqos>2)
			pqos=0;
		var msg = document.forms["smessage"]["message"].value;
		console.log(msg);
		document.getElementById("status_messages").innerHTML="Sending message  "+msg;

		var topic = document.forms["smessage"]["Ptopic"].value;
		//var retain_message = document.forms["smessage"]["retain"].value;
		if (document.forms["smessage"]["retain"].checked)
			retain_flag=true;
		else
			retain_flag=false;
		message = new Paho.MQTT.Message(msg);
		if (topic=="")
			message.destinationName = "test-topic";
		else
			message.destinationName = topic;
		message.qos=pqos;
		message.retained=retain_flag;
		mqtt.send(message);
		return false;
	}

	
    </script>

  </head>
  <body>

  <?php
include_once("nav.php");
//require ("hader_css_js.php"); // the same
?>
  
  



    <h2>LOGGING DATA INTERVAL EVERY 1 MIN WHILE ROBOT IN RUNNING </h2>



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
	

	<?php

include_once("mqtt_seting.php");



?>



<div>

Enter password to enable Store data to MYSQL Server EX:123456 <br>

Password: <input type ="text" id ="pass_sql" value=0>
<button type="button" id="button1"class="btn">Add_data1</button>

<button type="button" id="button2"class="btn">Add_data2</button>





</div>

<script>
	var modews = document.getElementById("websocket_mode");
	var modemqtt = document.getElementById("mqtt_mode");


	var robot_state;
			var robot_mode;
			var speedL;
			var speedR;
			var posL;
			var posR;
			var currentL;
			var currentR;
			var robot_status;
			var ctrl_volt;
			var motor_volt;
			var fwd_dist;
			var aft_dist;
			var gpslat;
			var gpslon;
			var host_name;
			var ip;


			var mqtt_status;
			var currentL_status;
			var currentR_status;
			var ctr_volt_status;
			var motor_volt_status;
			var ps2_remote;

			var fwd_enb;
			var aft_enb;


function extractdata(data){
    var jsonObject = JSON.parse(data);
    
    
    if ('speedL_rpm' in jsonObject) {

	if (jsonObject.robot_state){
		robot_state = "ON";
	} else {robot_state = "OFF";}

	  if (jsonObject.robot_mode){
		robot_mode = "Auto";
	} else {robot_mode = "Manual";}

	  speedL =jsonObject.speedL_rpm;
      speedR =jsonObject.speedR_rpm;
      posL =jsonObject.posL;
      posR =jsonObject.posR;
      currentL = jsonObject.currentL;
      currentR =jsonObject.currentR;
	  if(jsonObject.carmove==0) {robot_status ="STOP";}
        else if(jsonObject.carmove==1) {robot_status ="FORWARD";}
        else if(jsonObject.carmove==2) {robot_status ="BACKWARD";}
        else if(jsonObject.carmove==3){ robot_status ="LEFT";}
        else if(jsonObject.carmove==4) {robot_status ="RIGHT";}
        else if(jsonObject.carmove==5) {robot_status ="FWD_RIGHT";}
        else if(jsonObject.carmove==6) {robot_status ="FWD_LEFT";}
        else if(jsonObject.carmove==7) {robot_status ="BWD_LEFT";}
        else if(jsonObject.carmove==8) {robot_status ="BWD_RIGHT";}
        else if(jsonObject.carmove==9) {robot_status ="SPIN_RIGHT";}
        else if(jsonObject.carmove==10) {robot_status ="SPIN_LEFT";}

          }
      motor_volt =jsonObject.M_volt;
      ctrl_volt = jsonObject.Ctr_volt;

 
      



    
    if ('gpslat' in jsonObject) {
        
        gpslat = jsonObject.gpslat
		gpslon= jsonObject.gpslon;
        ip =jsonObject.IP;
		host_name =jsonObject.host_name;



		
		if(jsonObject.mqttstatus){
			mqtt_status = "Connected";
		}else {mqtt_status = "Disonnected";}

		//----------------------
		if (jsonObject.low_volt_ctr){
			ctr_volt_status = "Abnormal";
		} else{ctr_volt_status = "Normal";}

		if (jsonObject.low_volt_motor){
			motor_volt_status = "Abnormal";
		} else{motor_volt_status = "Normal";}

		//----------------------------

		if (jsonObject.L_Hcurrent){
			currentL_status = "Abnormal";
		} else{currentL_status = "Normal";}

		if (jsonObject.R_Hcurrent){
			currentR_status = "Abnormal";
		} else{currentR_status = "Normal";}





    }


    if ('PS2_status' in jsonObject) {  // package 4
      
		

	  if (jsonObject.PS2_status){
		ps2_remote = "Fail";
		} else{ps2_remote = "Normal";};

      fwd_dist  =jsonObject.fwd_dist;
      aft_dist =jsonObject.aft_dist;

	  aft_enb = jsonObject.aft;
	  if (jsonObject.aft){
		aft_enb = "Enable";
		} else{aft_enb = "Disable";};
	  
	  if (jsonObject.fwd){
		fwd_enb = "Enable";
		} else{fwd_enb = "Disable";};




    }


}

	</script>


<script src="js/mqtt_script.js"></script>

<script>





$(document).on('click', '#button2', function(e) {
      e.preventDefault();


	  $.ajax({
          url: "add_datasql2.php",
          type: "post",
          data: {
			mqtt_status: mqtt_status,
			currentL_status: currentL_status,
			currentR_status: currentR_status,
			ctr_volt_status: ctr_volt_status,
			motor_volt_status: motor_volt_status,
			ps2_remote: ps2_remote,
			fwd_enb: fwd_enb,
			aft_enb: aft_enb,
				
					
          },
          success: function(data) {
            var json = JSON.parse(data);
			var temp=json.status; 
            

          }
        });
      


    });
//-------------------------------------


$(document).on('click', '#button1', function(e) {
      e.preventDefault();
    

	  $.ajax({
          url: "add_datasql1.php",
          type: "post",
          data: {
            robot_state:  robot_state,
			robot_mode: robot_mode,
			speedL: speedL,
			speedR: speedR,
			posL: posL,
			posR :posR,
			currentL: currentL,
			currentR: currentR,
			robot_status: robot_status,
			ctrl_volt: ctrl_volt,
			motor_volt: motor_volt,
			fwd_dist: fwd_dist,
			aft_dist: aft_dist,
			gpslat: gpslat,
			gpslon: gpslon,
			host_name: host_name,
			ip: ip,
					
          },
          success: function(data) {
            var json = JSON.parse(data);
			var temp=json.status; 
            

          }
        });
      


    });

//-------------------------------------

	



const button1 = document.getElementById('button1');
const button2 = document.getElementById('button2');
var pass_sql=  document.getElementById('pass_sql');

  function autoClick_sql() {
	
	  if (robot_state=="ON" && mqtt_status == "Connected" pass_sql.value = "123456"){
	  button1.click(); // Triggers the button's click event
	  button2.click(); // Triggers the button's click event
	}

	//clearTimeout(myTimeout);
   
  }

	
  const myTimer_sql = setInterval(autoClick_sql, 60000);









	</script>





  </body>
</html>
