
<div>

  <h1>MQTT Monitor Robot car data</h1>
	


<div id="status">Connection Status: Not Connected</div> <br>
<button  onclick="display_mqtt()" style="width :200px ; background-color: gray; height: 50;"> ShowOrHideMQTT_SET</button> 
 <button style="width :200px ; background-color: gray; height: 50;" onclick="connectinternet()"> Connect_Internet_Broker</button> <button    onclick="connectlocal()"style="width :200px ; background-color: gray; height: 50;"> Connect_Local_Broker</button>
<br><br>




<div id="mqttset_dis" style="display: none;">
<fieldset style = "width: 330px; background-color: #f5eeee;">
<legend>SETUP PARAMETER FIELD</legend>
  

<form name="connform" action="" onsubmit="return MQTTconnect()">
  <fieldset>
  
  <legend>Mqtt Setup</legend>
<table>
 <tr><td>MqttBroker*</td>    
 <td style="width: 400px" ><input id ="mqttbroker" style="font-size:15px"type="text" name="server"  size="30" maxlength="30" autofocus="autofocus" placeholder= "Mqtt Broker" value="broker.emqx.io" > </td></tr>

 <tr><td>Port*</td>
   <td><input id ="mqttport" style="font-size:15px; width : 170px;" type="number" name="port"   value="8083"></td></tr>

   <tr><td>Clean Session*</td> 
    <td><input style="font-size:15px; width : 170px;" type="checkbox" name="clean_sessions"  value="true" checked></td></tr>

  
 <tr><td>UserName*</td>
 <td><input style="font-size:15px"type="text" name="username" size="18" maxlength="30"placeholder= "MqttUsername" value="robot"></td></tr>
 <tr><td>Password*</td>    
 <td><input style="font-size:15px"type="password" name="password" size="18" maxlength="10" placeholder="Password" value="123456"></td></tr>
 <td><hr> </td>
   <td><hr> </td>

   <tr><td><input name="conn" type="submit" value="Connect">  </td> 
   <td><input TYPE="button" name="discon " value="DisConnect" onclick="disconnect()">  </td>  </tr>
  
 

</table>
</fieldset>
</form>


<form name="subs" action="" onsubmit="return sub_topics()">
<fieldset>

<legend>TOPIC Sub Setup</legend>
<table>
<tr><td>Subscribe Topic*</td>    
<td><input id="subtopic" style="font-size:15px"type="text" name="Stopic" value = "robotcar/feedback"  size="18" maxlength="20" autofocus="autofocus" > </td></tr>

<tr><td>Subscribe QOS*</td>
 <td><input style="font-size:15px; width : 170px;" type="text" name="sqos" value="0"></td></tr>

 <tr><td>Clean Session*</td>
  <td><input style="font-size:15px; width : 170px;" type="checkbox" name="clean_sessions"  value="true" checked></td></tr>


<tr><td>Submit*</td>
<td><input type="submit" value="Subscribe" id = "autoclick_button"></td></tr>
   


</table>
</fieldset>
</form>


<form name="smessage" action="" onsubmit="return send_message()">
<fieldset>

<legend>TOPIC Pub Setup</legend>
<table>
<tr><td>Message*</td>    
<td><input style="font-size:15px"type="text" name="message" value = ""  size="18" maxlength="20" autofocus="autofocus" > </td></tr>

<tr><td>Publish Topic:*</td>
 <td><input style="font-size:15px; width : 170px;" type="text" name="Ptopic" value="robotcar/control"></td></tr>

 <tr><td>Publish QOS:*</td>
  <td><input style="font-size:15px; width : 170px;" type="text" name="pqos" value="0"></td></tr>




  <tr><td>Retain Message*</td>
    <td><input style="font-size:15px; width : 170px;" type="checkbox" name="retain" value="true"></td></tr>

        
<tr><td>Submit*</td>
<td><input type="submit" value="Submit"></td></tr>
   


</table>
</fieldset>
</form>


</fieldset>


<br>
<h3>Some free MQTT Broker </h3>
 <img src="img/freebroker.png" alt="robotcar" width="50%" height >  <br>

</div>

<div id ="mqtt_area">

  Status Messages:
  <div id="status_messages">
  </div>
  <br> <hr>
  Received Messages:
  
  <label> DATA FROM MQTT</label>

  <textarea id="out_messages"  style="width: 100%;">  </textarea>
  
  
  </div>