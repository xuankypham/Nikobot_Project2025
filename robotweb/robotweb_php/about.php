<!DOCTYPE html>
<html>
<head>
  <title> Robot Car control</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script type="text/javascript" src="js/qrcode.min.js"></script>
<script src="js/jquery-3.6.0.min.js" ></script> 




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

</style>
</head>
<body> <!-- onload="getdata_setup()">   -->



<?php
include_once("nav.php");
?>

<br>

<h4>
  CONTROL ROBOT CAR OVER WEBSERVER WITH ESP32</h4>
 <p> 
  - Support configuration of MQTT Publish client.<br>
  - Communication type : AJAX.<br>
  - 1.  MQTT.<br>
  - 2.  AJAX.<br>
  - 3. WEBSOCKET.<br>
  - 4. LORA SERIAL <br>
 
  <ul >
    <li>
  <img src="" alt="robotcar" width="800" height="500"><br></li>
  <li>
  <img src="img/robotcar.png" alt="robotcar" width="800" height="500"> </li>

</ul>
<br>

  <p> By Xuan KY Automation, Waikato University</p>




  ESP is Webserver, Websocket Server, MQTT Client,   
  Host Name: http://esp_robotcar.local  ;  for setup, press reset or Press Recofigure Wifi , then login ESP_rotbot car Wifi access point.
  Then configuration wifi or update firmware
  <br>
  Program is developed by Pham Xuan Ky (Xuankyautomation)<br>
  Date: 24/11/2024<br>
  Contact: Phamxuanky82@gmail.com<br>
  Tel:+64225179272<br>


</p>
<hr>
<h3> Download Application for robot car </h3>

 
<strong> Pham Xuan Ky;  E&I Engineer </strong>
<hr>
</p>
<h3> II.LINK Download APK QR Generator for Android program </h3>
<div>
<a id="link" href="http://robotcarwaikato.great-site.net//robotweb/app/robotcar_mqtt.apk"> LINK DOWLOAD QRGENERATOR ANDROID</a> 
</div>
<br>
<h2> SCAN QRCODE TO DOWNLOAD "robotcar_mqtt.apk" for ANDROID </h2>
<div style="margin-left:100px; width:200px;height:200px" id="id_qrcode">

</div>
 <br>
<label style="font-weight:bold;"> DEVICE ADDRESS</label>
<input id = "ip" type="text"  placeholder="https://192.168.1.8" style="font-size:20px;color:blue;font-weight:bold;" readonly> </input>
<a href="http://esp32_robot.local" target="blank">Controler Setting</a>

<footer style= "color:blue;">   Program made by Xuankyautomation <br>
  Date: 19/4/2022<br>
  Contact: Phamxuanky82@gmail.com<br>
  Tel:+84985510900<br> </footer>





<hr> </hr>
<footer style ="text-align : center; color: blue"> CopyRight:phamxuanky82@gmail.com; <br>Zalo: 0985510900 ;Date:24/11/2024 </footer>





<script>
  //--------------------------------------
 
 //--------------------------------------
  /**
  * Get the user IP throught the webkitRTCPeerConnection
  * @param onNewIP {Function} listener function to expose the IP locally
  * @return undefined
  */
 function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
     //compatibility for firefox and chrome
     var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
     var pc = new myPeerConnection({
         iceServers: []
     }),
     noop = function() {},
     localIPs = {},
     ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
     key;
 
     function iterateIP(ip) {
         if (!localIPs[ip]) onNewIP(ip);
         localIPs[ip] = true;
     }
 
      //create a bogus data channel
     pc.createDataChannel("");
 
     // create offer and set local description
     pc.createOffer(function(sdp) {
         sdp.sdp.split('\n').forEach(function(line) {
             if (line.indexOf('candidate') < 0) return;
             line.match(ipRegex).forEach(iterateIP);
         });
         
         pc.setLocalDescription(sdp, noop, noop);
     }, noop); 
 
     //listen for candidate events
     pc.onicecandidate = function(ice) {
         if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
         ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
     };
 }
 
 
 getUserIP(function(ip){
     //document.getElementById("ip").innerHTML = 'Your Computer IP Address ! : '  + ip + " ";  //| verify in http://www.whatismypublicip.com/
 
 document.getElementById("ip").value = 'https://'  + ip;  //| verify in http://www.whatismypublicip.com/
 
 });
 
 
 function onReady()
     {
       var qrcode = new QRCode("id_qrcode", {
         text:"http://robotcarwaikato.great-site.net//robotweb/app/robotcar_mqtt.apk",
         width:200,
         height:200,
         colorDark:"#000000",
         colorLight:"#ffffff",
         correctLevel:QRCode.CorrectLevel.H
       });
     clearInterval(myVar);
     //var a=document.getElementById("link");
     //a.href= document.getElementById("ip").value+"/web/mv10qrscan.apk";
     }
 
 var myVar=setInterval(onReady,1000);
 
  
 
 </script>













</body>
</html>
