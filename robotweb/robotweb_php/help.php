<!DOCTYPE html>
<html>
<head>
  <title> Robot Car control</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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

* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 25%;
  height: 100%;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 10px 10px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 75%;
  border-left: none;
  height: 100%;
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
 
<p>Click button to read instruction</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, '1')" id="defaultOpen">1. How to setup wifi</button>
  <button class="tablinks" onclick="openCity(event, '2')">2. How to setup Mqtt for ESP32</button>
  <button class="tablinks" onclick="openCity(event, '3')">3. How to download complete or update website</button>

  <button class="tablinks" onclick="openCity(event, '4')">4. How to download complete Program</button>
  <button class="tablinks" onclick="openCity(event, '5')">5. how to control car by remote PS2</button>
  <button class="tablinks" onclick="openCity(event, '6')">6. how to control robot car by Webserver direct on ESP32</button>
  <button class="tablinks" onclick="openCity(event, '7')">7. How to Control robot by Python App</button>


  <button class="tablinks" onclick="openCity(event, '8')">8. How to Control Robot over Internet</button>
  <button class="tablinks" onclick="openCity(event, '9')">9. how to install webserver on RPI LAMPP</button>
  <button class="tablinks" onclick="openCity(event, '10')">10. how to install webserver on PC XAMPP</button>
  <button class="tablinks" onclick="openCity(event, '11')">11. HowToInstall and Control car by android app</button>

  <button class="tablinks" onclick="openCity(event, '12')">12. How to control car over google map</button>
  <button class="tablinks" onclick="openCity(event, '13')"> 13. How to enter wifi  router</button>
  <button class="tablinks" onclick="openCity(event, '14')">14. how to access webserver on RPI</button>
  <button class="tablinks" onclick="openCity(event, '15')">15. How to access RPI remotely VNC or Putty</button>
  <button class="tablinks" onclick="openCity(event, '16')">16. How to display FWD and AFT camera Python program pc</button>
  <button class="tablinks" onclick="openCity(event, '17')">17. How to make android application by MIT App Mqtt protocol</button>
  <button class="tablinks" onclick="openCity(event, '18')">18. How to Startup Robot Car</button>
  <button class="tablinks" onclick="openCity(event, '19')">19. How to Charger Battery for Robot Car</button>
  <button class="tablinks" onclick="openCity(event, '20')">20. How to Emergency Stop for Robot Car</button>



</div>

<div id="1" class="tabcontent">
  <h3>1. SETUP WIFI FOR ESP32</h3>

  <p>
  1. To Setup wifi for ESP32 controller <br>
  - power on robot car , Normally, Controller remember access point already, we dont need to setup wifi. However if we want to change wifi router we need to config wifi.<br>
  - click wifi at laptop or smartphone, check access point default name " AutoConnectAP" , click and enter default password "password"
  <br>
  <img src="img/wifi1.png" alt="robotcar" width="20%">  <br>
  After signin wifi, Computer or phone will directly login the main wifi config page <span style ="color: blue;" > http://192.168.4.1</span> , otherwise manually open web browser and enter the link. <br>
    <br>  
    <table> <tr> <td><img src="img/wifi2.png" alt="robotcar" width="40%">  </td><td><img src="img/wifi3.png" alt="robotcar" width="40%"> </td></tr>
    <br>

  </table>
    click to the Config Wifi Button to carry out configuration <br>

    to clear wifi in the controller Memory<br>
    enter in config menu and click Button Clear Wifi and Reset, with password 123456. <br>

<img src="img/wifi4.png" alt="robotcar" width="60%">  <br>

NOTE:  One important Note when ESP32 cannot connect to WIFI router on Robot Car. It is due to the power supply of Robot and ESP Controller on at the same time, ESP32 controller
will restart faster than Wifi Router, So ESP cannot recognize wifi when fist power on, then Wifi Accesspoint will be start and require to setup wifi.
It is no need to setup wifi, because Wifi config already remember in the ESP32 controller.
the only press Reset Push Button to Reset ESP32 after power on. Wifi will be connected. 
Swith on or off Main Control Power is not the solution, Only press Reset Button infront of CAR.<br>

Clear Wifi Hardware Button, When keep press button Wifi clear 2s , all wifi config will be clear in the memory, so reconfig wifi need to be done for ESP32 after clear. <br>
<img src="img/5_howto_4.jpg" alt="robotcar" width="60%">  <br>



  </p>
</div>

<div id="2" class="tabcontent">
  <h3>2. Setup MQTT for ESP32 Controller</h3>
  <p>
  To Setup Mqtt for ESP32 controller, open server on ESP32. use http:// ipaddress, make sure ESP and PC or phone connected at the same router. by the way, we also can use DNS Sever on ESP.  http://esp32_robot.local
Click Setup link button on website<br>
  <img src="img/mqtt1.png" alt="robotcar" width="80%">  <br>


Click getdataback to read data stored on ESP Controller. Note that check MQTT Enable or Disable status. <br>
MQTT is automatic Disable if after about 20 times or 2 miniutes cannot connect to broker <br> however, if Reset Robot MQTT will be restart.
  <br>
  <img src="img/mqtt2.png" alt="robotcar" width="60%" height >  <br>

 After complete Setting up MQTT, Go to Main Home page to check MQTT Status 
 <br>
 <img src="img/mqtt3.png" alt="robotcar" width="60%" height >  <br>

 Finish configuration of MQTT.<br>
 Note that MQTt can be config over webserver Websocket and Config over internet.<br>
 <h3>Some free MQTT Broker </h3>
 <img src="img/freebroker.png" alt="robotcar" width="60%" height >  <br>




  </p> 
</div>

<div id="3" class="tabcontent">
  <h3>3. download Data website to ESP32</h3>
  <p>
To download Data website for ESP32 Controller from PC there are 2 ways.
<h4> 1. Using Arduino IDE V2.x</h4>

 The Complete website data folder is below <br>
 <img src="img/3_ide0.png" alt="robotcar" width="60%" height >  <br>

- Install Arduino IDE for you PC,  Window or Linux have minor difference of configuration. in this program I use WIndow PC <br>
- Download Arduino IDE Version > 2.0 to install for window laptop or pc. <br>

<h4>2. download Data website from Arduino IDE</h4>
<img src="img/3_ide1.png" alt="robotcar" width="60%" height >  <br>
<h4>Installation</h4>
Copy the VSIX file to ~/.arduinoIDE/plugins/ on Mac and Linux or C:\Users\<username>\.arduinoIDE\plugins\ on Windows 
  <br>  (you may need to make this directory yourself beforehand). Restart the IDE. <br>
  link:  https://github.com/earlephilhower/arduino-littlefs-upload/releases  <br>

  <img src="img/3_ide2.png" alt="robotcar" width="60%" height >  <br>

<h4>Usage</h4>
[Ctrl] + [Shift] + [P], then "Upload LittleFS to Pico/ESP8266/ESP32".

On macOS, press [⌘] + [Shift] + [P] to open the Command Palette in the Arduino IDE, then "Upload LittleFS to Pico/ESP8266/ESP32".

Make sure correct COM Port setting and controller before upload. <br>

<img src="img/3_ide3.png" alt="robotcar" width="60%" height >  <br>
<hr> <br>
upload <br>

<img src="img/3_ide4.png" alt="robotcar" width="60%" height >  <br>


<h4> 2. For Upload Little FS for Arduino IDE Version 1.xx</h4>
Just download these folder in my web site and copy to the link of Arduino. <br>

<img src="img/3_ide5.png" alt="robotcar" width="60%" height >  <br>

Remember Arduino IDE V1.x can not upload for ESP32 S3 <br>

<img src="img/3_ide6.png" alt="robotcar" width="60%" height >  <br>

Now you are able to Upload COmplete Website and Data to File System of ESP32. the location of file system data is project folder /data <br>


<h4> To Update individual Web page only or change some inteface of web and download to ESP following steps</h4>

- Open project folder then open data folder.<br>

<img src="img/3_ide7.png" alt="robotcar" width="60%" height >  <br>

- Open files need to be update by visual studio code, then change and save. <br>

<img src="img/3_ide8.png" alt="robotcar" width="60%" height >  <br>
Open Website on ESP <br>

<img src="img/3_ide9.png" alt="robotcar" width="60%" height >  <br>
click upload button <br>


<img src="img/3_ide10.png" alt="robotcar" width="60%" height >  <br>
select file need to be update or upload to ESP <br>
<img src="img/3_ide11.png" alt="robotcar" width="60%" height >  <br>
Update complete  now ESP32 website already updated<br>
<img src="img/3_ide12.png" alt="robotcar" width="60%" height >  <br>
 COMPLETE

  </p>
</div>





<div id="4" class="tabcontent">
  <h3>4. download Program to ESP32</h3>
  <p>
    <h4>  Using IDE to download complete program this is not recommend for robot car</h4>
    <img src="img/4_howto1.png" alt="robotcar" width="60%" height >  <br>

<h4> Using Web update over  wifi or internet</h4>
Open IDE arduino Program and export to binary files, all data Bin will be created in the folder below after finish complying <br>
<img src="img/4_howto2.png" alt="robotcar" width="60%" height >  <br>

Open Web update to cary out update new program for controller select config link <br>
<img src="img/4_howto3.png" alt="robotcar" width="60%" height >  <br>

Choose BIN file to upload <br>
<img src="img/4_howto4.png" alt="robotcar" width="60%" height >  <br>

Upload new program for ESP <br>

<img src="img/4_howto5.png" alt="robotcar" width="80%" height >  <br>

Complete program Update

  </p>
</div>



<div id="5" class="tabcontent">
  <h3>5. Control Robot car by using PS2 Remote</h3>
  <p>
    Robot car is designed for multi control ways. <br>
     <strong>1 By Remote PS2  </strong><br>
     2. By Mqtt Over Websocket LOCAL Network or Internet<br>
     3. By Webserver - websocket or AJAX<br>
     4. By Andoid Application - MQTT Protocol<br>
     5. By Python Program - Mqtt Protocol <br>
     6. By Lora Signal -  Control and Monitor data.<br>
     7. By Automactically Using GPS Signal ( Under development due to Encoder reading motor speed is not stable).<br>

     This slide will discuss about controlling robot over PS2 Remote
    <img src="img/5_howto_1.png" alt="robotcar" width="80%" height >  <br>

    PS2 Remote is programmed to control robot following the configuration below: <br>
    <img src="img/5_howto_2.png" alt="robotcar" width="80%" height >  <br>

    1. Power on CAR Switch ON Main Battery for Motor power ( Switch to Right side, ) <br>
    <img src="img/5_howto_3.png" alt="robotcar" width="80%" height >  <br>


    2. Switch control power on inside the controller box <br>
    <img src="img/5_howto_4.jpg" alt="robotcar" width="80%" height >  <br>


    3. Press Reset Button for ESP32 recover network connection ( this is because Wifi router take more time to start up than ESP32, so when power on car, ESP can not receive 
    the wifi router ready signal , so it cannot connect to wifi, then Access point automatically start on ESP32 for user to config wifi.  Although Wifi config is already stored in ESP controller.
    what we need to do after power on, press restart button of ESP after power on about 1 or 2 minute.
    )<br>


    Now Robot will be controlled by Remote PS2 easily


    Note that,  For safely, Ultrasonic Senor to used for detect obstruction, If object about 2m range, Motor speed will automatically fix, Speed can not be increased.


  </p>
</div>


<div id="6" class="tabcontent">
  <h3>6. Control Robot Car over local webserver directly on ESP32 controller</h3>
  <p>
To control Car directly on webserver, you need to connect your laptop/ phone / tablet to the same wifi router of ESP32 controller. DNS Server on ESP is not working stably, normally you need to enter webserver by ESP IP address .<br>
So what you do, You need to enter WIFI Router to check IP address. Select tab 13 in this Help website.
or you can randomly try 192.168.169.0.100 ,   192.168.169.0.101, 192.168.169.0.102,  192.168.169.0.103 ....  Because Router DHCP Start from  192.168.0.100.
<img src="img/6_howto_1.png" alt="robotcar" width="80%" height >  <br>

Dont forget to waite and make sure Websocket is connected before controll. ESP RAM is small, Loading data from ESP to web take more time than usual.

<img src="img/6_howto_2.png" alt="robotcar" width="80%" height >  <br>

Now you can easy control robot car by local website.



  </p>
</div>



<div id="7" class="tabcontent">
  <h3>7. Control Robot car by using Python Application over MQTT</h3>
  <p>
Due to Python application is using MQTT and Lora Protocol, so to control or read data , you need to be sure MQTT connection of Python app and ESP32 controller have connected to the same broker. <br>
for example, Now i use Mosca or Mosquitto Local server on my window PC, then I will connect Python and ESP32 to the same broker address.<br>

<img src="img/7_howto_1.png" alt="robotcar" width="60%"  >  <br>
ESP32 connect to broker 192.168.0.101  is my local PC. <br>

<img src="img/7_howto_2.png" alt="robotcar" width="20%"  >  <br>

Open Pycharm program on your pc <br>
<img src="img/7_howto_3.png" alt="robotcar" width="30%"  >  <br>

Make sure ESP MQTT already connected and healthy <br>
<img src="img/7_howto_4.png" alt="robotcar" width="60%"  >  <br>

Open and run Python program <br>
<img src="img/7_howto_5.png" alt="robotcar" width="60%"  >  <br>

Setup MQTt connection<br>
<img src="img/7_howto_6.png" alt="robotcar" width="60%"  >  <br>

Start Robot by MQTT <br>
Start robot, check Ready indicator is Green like picture below. Data from ESP32 come to Python in terminal below.
<img src="img/7_howto_7.png" alt="robotcar" width="60%"  >  <br>
Now Robot is controlled properly by Python app. Note that this report is use a simulator, without Robot connected, so feedback data is not real. <br>
<img src="img/7_howto_8.png" alt="robotcar" width="60%"  >  <br>

Complete, Feed back from robot will send real data to controller.  if any alarm it will display in this aplication tabl alarm and event <br>
<img src="img/7_howto_9.png" alt="robotcar" width="60%"  >  <br>


  </p>
</div>


<div id="8" class="tabcontent">
  <h3>8. How to control robot on website over internet using MQTT protocol</h3>
  <p>
  Access website for myrobot

The application to control robot car over internet is using Webpage with MQTT protocol.
Note: this web page is not proper secure, just for experiment. For more secure we need to use multifactor authentication AWS. This is for small project only. <br>
Enter link to web browser  ; Enter username:   robot,  Pass: 123456
1.  Access : <span style="color: blue;"> http://robotcarwaikato.great-site.net/ </span>   (port 80)    Or  <span style="color: blue;"> https://robotcarwaikato.great-site.net      </span>        ( port 443 SSL)<br>

    <img src="img/8_howto_1.png" alt="robotcar" width="20%"  >  <br>

Click submit button to enter main package <br>
    <img src="img/8_howto_2.png" alt="robotcar" width="60%"  >  <br>


Go to the end of web page, check MQTT protocol is connected or not. if not due to broker out of service, You need to set different free broker. <br>
link :   https://mntolia.com/10-free-public-private-mqtt-brokers-for-testing-prototyping/ <br>
link of a broker list here :  https://mntolia.com/10-free-public-private-mqtt-brokers-for-testing-prototyping/ <br>

Make sure ESP32 Controller also connected at the same briker , Port 1883.  On website use mqtt over websocket.<br>


<img src="img/8_howto_3.png" alt="robotcar" width="60%"  >  <br>

Now you can operate Robot car the same in operation in local network, Only different is that control using Webserver over MQTT <br>


DONE
  </p>
</div>



<div id="9" class="tabcontent">
  <h3>9. Install Webserver LAMPP for RPI</h3>
  <p>



<h4>Apache, PhpMyAdmin and MariaDB</h4>

Full link procedure to install here <br>

<strong style = "color: blue;">https://randomnerdtutorials.com/raspberry-pi-apache-mysql-php-lamp-server/    </strong>  <br>



sudo apt-get install mariadb-server mariadb-client <br>
sudo apt-get install apache2 php5 libapache2-mod-php5<br>
sudo apt-get install phpmyadmin<br>

<h4>install missing sqli extension</h4>
sudo apt-get install php5-mysqlnd <br>
now setup password and secure your install<br>
sudo mysql_secure_installation<br>

<h4>if username and password fails then disable MySQL authenticating using plugin</h4>

sudo mysql -u root<br>

[mysql] use mysql;<br>
[mysql] update user set plugin='' where User='root';<br>
[mysql] flush privileges;<br>
[mysql] \q<br>

After installation complete, Copy robotweb folder to raspberry <br>
<img src="img/9_howto_1.png" alt="robotcar" width="60%"  >  <br>

To Start webserver on RPI, Only type Ipaddress / robotweb (ip is the address of RPI) <br>  
<img src="img/9_howto_2.png" alt="robotcar" width="60%"  >  <br>




</p>
</div>

<div id="12" class="tabcontent">
  <h3>12. Control Robot automatically running by Google Map setting (GPS)</h3>
  <p>

After selecting the route for the robot by moving  the marker
Each marker will be displayed, and the position heading and distance from Marker 1 to the end marker will be shown. There are a total of 8 positions in this application.
After that click the Set Navigation of Marker button,  Data will be sent to the Robot ESP32 Controller Over MQTT.
{"auto_nav":1,"lat":[-37.7861,-37.7856],"lon":[175.29,175.29049999999998],"heading":[44.89,224.89],"distance":[70.86,70.86]}

This data will be stored in ESP32 Controller, the idea that only Set Car MODE to Auto, The Robot car will move automatically from point to point and heading will be control by PID Algorithm with GPS feedback at the car.
To achieve this control, the motor speed reading should be properly detected to detect motor speed from the encoder. The PID will control the motor's movement to the position. Without proper speed sensing, it is not able to achieve this automatic control.

<br>  http://robotcarwaikato.great-site.net/robotweb/map_control.html <br>
<img src="img/12_howto_1.png" alt="robotcar" width="60%"  >  <br>

Setup Route for Robot moving <br>  
<img src="img/12_howto_2.png" alt="robotcar" width="60%"  >  <br>

GPS Data send to controller <br>
<img src="img/12_howto_3.png" alt="robotcar" width="60%"  >  <br>
</p>
</div>






<div id="13" class="tabcontent">
  <h3>13. How to Access Wifi router TPlink to check Client connected IP</h3>
  <p>
    Access TP link wifi to config and check IP is very important when working with wifi controller. <br>
    Connect PC with Tp-link router <br>


<img src="img/13_howto_1.png" alt="robotcar" width="60%"  >  <br>

Access TPlink by entering IP 192.168.0.1 into web browser <br>
<img src="img/13_howto_2.png" alt="robotcar" width="60%"  >  <br>

Check DHCP Client IP address connected to router <br>
<img src="img/13_howto_3.png" alt="robotcar" width="60%"  >  <br>

find the ip address for equipment ESP32 and PC <br>
<img src="img/13_howto_4.png" alt="robotcar" width="60%"  >  <br>


Change Wifi User Name  <br>
<img src="img/13_howto_5.png" alt="robotcar" width="60%"  >  <br>

Change Wifi Password  <br>
<img src="img/13_howto_6.png" alt="robotcar" width="60%"  >  <br>

  </p>
</div>

<div id="14" class="tabcontent">
  <h3>14. Access Webserver by RPI</h3>
  <p>

    <img src="img/14_howto_1.png" alt="robotcar" width="60%"  >  <br>

    Access TPlink by entering IP 192.168.0.1 into web browser <br>
    <img src="img/14_howto_2.png" alt="robotcar" width="60%"  >  <br>
    
    Check DHCP Client IP address connected to router <br>
    <img src="img/14_howto_3.png" alt="robotcar" width="60%"  >  <br>
    
    find the ip address for equipment ESP32 and PC <br>
    <img src="img/14_howto_4.png" alt="robotcar" width="60%"  >  <br>
    
    
    Change Wifi User Name  <br>
    <img src="img/14_howto_5.png" alt="robotcar" width="60%"  >  <br>
    
    Change Wifi Password  <br>






  </p>
</div>


<div id="10" class="tabcontent">
  <h3>10. Install webserver XAMPP for window PC</h3>
  <p>
    1. Download XAMPP for window PC 64 bit and install  <br>
    <img src="img/10_howto_1.png" alt="robotcar" width="60%"  >  <br>

    2. following steps and Install for window PC  <br>
    <img src="img/10_howto_2.png" alt="robotcar" width="60%"  >  <br>


    3. Start XAMPP  <br>
    <img src="img/10_howto_3.png" alt="robotcar" width="60%"  >  <br>


    3. Copy Web Project to XAMPP  <br>
    <img src="img/10_howto_4.png" alt="robotcar" width="60%"  >  <br>

    4. Copy Web Project to XAMPP htpdocs folder  <br>
    <img src="img/10_howto_5.png" alt="robotcar" width="60%"  >  <br>

    5. Run Webserver on PC and Open web  <br>

    http:// 192.168.0.101/robotweb <br>
    <img src="img/10_howto_6.png" alt="robotcar" width="60%"  >  <br>

  </p>
</div>



<div id="11" class="tabcontent">
  <h3>11. Install Android application and control car</h3>
  <p>
    1. Download Android application from robotcar website link: <strong style = "color: blue;">https://robotcarwaikato.great-site.net/robotweb/about.html    </strong>  <br>
    <br>
    <img src="img/11_howto_1.png" alt="robotcar" width="60%"  >  <br>

    2. Open Application on your phone  <br>
    <img src="img/11_howto_2.png" alt="robotcar" width="60%"  >  <br>


    3. Main Screen  <br>
    <img src="img/11_howto_3.jpg" alt="robotcar" width="60%"  >  <br>
    4. Main Screen  <br>
    <img src="img/11_howto_4.jpg" alt="robotcar" width="60%"  >  <br>

    5. screen  <br>
    <img src="img/11_howto_5.jpg" alt="robotcar" width="60%"  >  <br>

    6. Phone Screen  <br>
    <img src="img/11_howto_6.jpg" alt="robotcar" width="60%"  >  <br>

    7. screen  <br>
    <img src="img/11_howto_7.jpg" alt="robotcar" width="60%"  >  <br>

    8. Phone Screen  <br>
    <img src="img/11_howto_8.jpg" alt="robotcar" width="60%"  >  <br>

  </p>
</div>





<div id="15" class="tabcontent">
  <h3>11. Install Android application and control car</h3>
  <p>
    download VNC Client Viewer from internet and install for PC  <br>
    <br>
    <img src="img/15_howto_1.png" alt="robotcar" width="60%"  >  <br>

    Download App for Window PC  <br>
    <img src="img/15_howto_2.png" alt="robotcar" width="60%"  >  <br>


    Access Remotely Real VNC to RPI  <br>
    <img src="img/15_howto_3.png" alt="robotcar" width="60%"  >  <br>
   Enter IP address of RPI  <br>

    <img src="img/15_howto_5.png" alt="robotcar" width="60%"  >  <br>

  
    Login RPI with username and password  <br>
    <img src="img/15_howto_6.png" alt="robotcar" width="60%"  >  <br>

    Login Screen complete <br>
    <img src="img/15_howto_7.png" alt="robotcar" width="60%"  >  <br>

    Download Putty  <br>
    <img src="img/15_howto_8.png" alt="robotcar" width="60%"  >  <br>


    Download Putty  <br>
    <img src="img/15_howto_9.png" alt="robotcar" width="60%"  >  <br>


    Open Putty  <br>
    <img src="img/15_howto_10.png" alt="robotcar" width="60%"  >  <br>
    Open Putty  <br>
    <img src="img/15_howto_11.png" alt="robotcar" width="60%"  >  <br>

    Access Putty  <br>
    <img src="img/15_howto_12.png" alt="robotcar" width="60%"  >  <br>

    Access Putty  <br>
    <img src="img/15_howto_13.png" alt="robotcar" width="60%"  >  <br>

    Enter User  <br>
    <img src="img/15_howto_14.png" alt="robotcar" width="60%"  >  <br>

    Login complete  <br>
    

  </p>
</div>














<div id="16" class="tabcontent">
  <h3>16. How to Display Carmera FWD and AFT for Robot</h3>
  <p>
Robot is used 2 camera FWD is Intel Realsense Camra D455  this is a Stereo Carmera, we can detect the depth from object to camera.<br>
it this project we use python to read data.<br>
Aft camera I use normal Logitec usb webcam, to run the camra we follow steps. <br>

 - Run Intel Realsens Viewer and Enable data server make sure 2 cameras are connected to window PC<br>
 <img src="img/16_howto_1.png" alt="robotcar" width="60%"  >  <br>
 - Open Python application run fwd camera, this camrea is programed to detect object using Yolo V10 <br>

 <img src="img/16_howto_2.png" alt="robotcar" width="60%"  >  <br>
 Display RGB Camera and Depth of image from intel realsens camera. <br>
 <img src="img/16_howto_3.png" alt="robotcar" width="60%"  >  <br>

 - Run aft Camera, this camera can be run simulator from a traffic Video. Select BWD Camera display to view. check Cam ID number by CAM List Button, Then enter id click Start Aft cam <br>
 <img src="img/16_howto_4.png" alt="robotcar" width="60%"  >  <br>

Note that follow step 1 to 3 to setup aft camera. <br>
- Check camera list, to know which camera id connected to USB port. <br>
- enter camera id to box and press Set Aft camera.<br>
- finally click Start Aft camera. <br>
- to setup, camera should be stop mode. <br>
 <img src="img/16_howto_5.png" alt="robotcar" width="60%"  >  <br>

 Check resource is using during run Image processing <br>
 <img src="img/16_howto_6.png" alt="robotcar" width="60%"  >  <br>

 Check resource is using during run Image processing <br>
 <img src="img/16_howto_7.png" alt="robotcar" width="60%"  >  <br>



  </p>
</div>


<div id="17" class="tabcontent">
  <h3> 17. How to make android application by MIT App</h3>
  <p>
It is actually not easy to make one application just short of time. We need to think about the idea, make it from beginning from small idea, then we continue thinking to update depend on the advantage and disadvantage of the application.<br>
After consideration, We continue improve program, but it is never finish until now. There are many thing need to improve. due to the limit of time and ability, I cannot make this application as well as possible.<b>
  Something need to improve of this project such as:<br>
  - Improve automatic control by google map.<br>
  - Improve the Encorder reading accurracy otherwise, it is impossible to control motor direction.<br>
  - RPLidar need to be fit to control car moving safely. and etc..<br>
</b>

1. Create account MIT Application and open application for development. <br>

<img src="img/17_howto_1.png" alt="robotcar" width="60%"  >  <br>

 Open application for drag and drop application screen <br>
 <img src="img/17_howto_2.png" alt="robotcar" width="60%"  >  <br>

 Open application for drag and drop programming <br>
 <img src="img/17_howto_3.png" alt="robotcar" width="60%"  >  <br>

 Finally, Export to APK file for android phone to install <br>
 <img src="img/17_howto_4.png" alt="robotcar" width="60%"  >  <br>

 it is not giving idea overall only.
 Thanks



  </p>
</div>


<div id="18" class="tabcontent">
  <h3>18. HOW TO START UP ROBOT CAR</h3>
  <p>
1:  to Startup Robot we need to follow steps below <br>
- Open Cover of Car and Switch On Main power , Turn Clockwise 90o, turn it easily, do not make to strong. <br>
- Check Indicator light on power module is display White color.<br>

<img src="img/18_howto1.jpg" alt="robotcar" width="50%" height >  <br>
2. Next Check Main Indicator light in front of car<br>
All indicators will be off,  Why?   because ESP32 startup faster than Wifi MODEM and Raspberry, So ESP32 cannot find Wifi and MQTT Broker, It will run in Setting Wifi MODE while WIFI is stored already in memory.<br>
wait for sometime about 1 -2 mins untill all equpment start up, the follow step 3 below. <br>
<img src="img/18_howto2.jpg" alt="robotcar" width="50%" height >  <br>

3.  Press reset button on the control box, to reset ESP32, it will automatic recover wifi connection <br>
Check indicator light , STOP Line will be on, while other light is off. <br>
<img src="img/18_howto3.jpg" alt="robotcar" width="50%" height >  <br>

4. check indicator light.<br>
<img src="img/18_howto4.jpg" alt="robotcar" width="50%" height >  <br>

RED:  STOP <br>
GREEN: READY TO Start <br>
YELLOW :   WIFI CONNECTION FAIL or MQTT Broker is not connected with ESP32, fail connection broker. <br>
Now you can start robot by Remote controller or website <br>
Note: if use wifi, you need to make sure ,  are you connecting the same wifi on car or not?<br>
WIFI is conneced with Internet or not? <br>

Static IP address for RPI, MQTT Broker:  192.168.0.110  ,  Mqtt Port: 9001 (WS),    website: 192.168.0.110/robotweb <br>

if any error please contact me address below

  </p>
</div>


<div id="19" class="tabcontent">
  <h3>19. HOW TO CHARGE BATTER FOR ROBOT CAR</h3>
  <p>
1:  Charge Control Battery for Robot car <br>
- Behind the car there are 2 place for charging battery, at the center 2 connectors RED + and Black -  12vdc Charging port for Control battery. <br>
- Note that this is 12vdc Charging port. do not connect wrong pin Positive RED, negative is Black.<br>

<img src="img/19_howto_1.png" ajpglt="robotcar" width="50%" height >  <br>

2. Charge Motor Batttery <br>
Motor battery is connected with 3 position Switch 1 charge, 2 off, 3 On.   so when charging battery, Switch to position 1. <br>
when use Car switch to position 3,   when stop car completely, use Position 2. <br>

  </p>
</div>





<div id="20" class="tabcontent">
  <h3>20. HOW TO EMERGENCY STOP FOR ROBOT CAR</h3>
  <p>
To Sop robot car in Emergency <br>
- at the right side behide car there are 2 places to carry out Emergency Stop Car <br>
  1. Emergency Stop Push Button , Press to Stop, to release, just pull up slightly, easily. do not pull too strong .<br>

  2. Switch to Position 3 of Charging Switch behind car, you also can stop car.  <br>

  

<img src="img/20_howto_0.png" ajpglt="robotcar" width="50%" height >  <br>

3. Stop Car by press button on PS2 Remote, Press button 1 or 2 to stop car in emergency<br>
<img src="img/20_howto_1.png" ajpglt="robotcar" width="50%" height >  <br>

4. on Web page press button 1 or 2 to stop car in any case of emergency<br>

<img src="img/20_howto_2.png" ajpglt="robotcar" width="50%" height >  <br>




  </p>
</div>






<!--


<div id="n" class="tabcontent">
  <h3>download Data website to ESP32</h3>
  <p>

-->

  </p>
</div>



<hr> </hr>
<footer style ="text-align : center; color: blue"> CopyRight:phamxuanky82@gmail.com; Tel: +225179272 ;Date:24/11/2024 </footer>





<script>
  
  
 
 </script>







<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
  </script>




</body>
</html>
