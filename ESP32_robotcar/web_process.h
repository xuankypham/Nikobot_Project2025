void handle_setup(){
  //file:///C:/setup_data?mqttbroker=192.168.1.1&mqttclientid=dfhfd&mqttuser=dhfdfh&mqttpass=fdgdfg&mqttpub=vbncvb&mqttsub=dfhgdfg&mqttenb=Enable
   //setup_data?mqttbroker=192.168.1.1
  // server.argName  = mqttbroker
  //server.arg = 192.168.1.1   
   String dataname[20];
   String datasetup[20];
   String fbwebsetup;
   if (server.args() > 0 ) { // Arguments were received    
    for ( uint8_t i = 0; i < server.args(); i++ ) {  
      dataname[i] = server.argName(i);
      datasetup[i] = server.arg(i);
      //Serial.print(dataname[i]);
      //Serial.print(": ");
      //Serial.println(datasetup[i]);
        }

    //-----------------------------------------------MQTT-------------------------------
    if (dataname[0].indexOf("mqtt") >=0){ // neu data nhan duoc la mqtt setup, trong chuoi co mqtt
      mqttserver=datasetup[0];
      port=datasetup[1].toInt();
      clientId=datasetup[2];
      username=datasetup[3];
      password=datasetup[4];
      TopicPub=datasetup[5];
      TopicSub=datasetup[6];
      MqttEnable=datasetup[7];
      if (MqttEnable=="Enable"){mqtt_trial =10;} // reset mqtt trial
      
      fbwebsetup = "<html><body><h3> MQTT Setting Value Success </h3>";
      fbwebsetup += "<p>MQTT Server is: " +  mqttserver + " <br>";
      fbwebsetup += "<p> Server PORT mqtt is: " +  String(port) + " <br>";
      fbwebsetup+= "MQTT Channel ID is: " + clientId +"<br> ";
      fbwebsetup+= "MQTT username is: " +username+" <br>";
      fbwebsetup+= "MQTT password: " +password+" <br>";
      fbwebsetup+= "Topic Subscribe: " +TopicSub+" <br>";
      fbwebsetup+= "Topic publish: " +TopicPub+" <br>";
      fbwebsetup+="Mqtt Enable is: "+MqttEnable+" <br></p>";
      fbwebsetup  += "<a href=\"/setup\"> Setting </a> <br>";
      fbwebsetup+= "<a href=\"/\"> Home</a> <body><html>";
      Serial.println("mqtt config complete");
      write_mqtt_FLASH();
    }
  //--------------------------------
          
   //-------------------------------
    }
    // End of server arg >0
    server.send(200, "text/html", fbwebsetup);
   }
//--------------------------------------------------

void handle_SetRobot() {
  String temp;
   if (server.args() > 0 ) { // Arguments were received
    for ( uint8_t i = 0; i < server.args(); i++ ) {
      temp = server.argName(i); 
      String data_input = server.arg(i);  // JSON STRING {"motorspeed_cmd":50,"direct_cmd":2,"motor_enb_cmd":1}
      Serial.print(server.argName(i)); // Display the argument = movefwd
      Serial.println(" :  " + data_input);

      Serial.println(temp);
      if (temp=="robot_cmd"){ 
      StaticJsonDocument<200> doc;                    // create a JSON container
      DeserializationError error = deserializeJson(doc, data_input);
      
      if (error) {
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        return;
      }
      
        //serializeJson(doc, Serial);
        read_data_ws_mqtt(doc);  // this is shared with MQTT
      }

        
//----------------------------------------
        if (temp=="refreshmqtt"){
          read_mqtt_FLASH();
        
        }
        if (temp=="restartESP"){ // press, waite for esp reset, Connect PC to ESP Wifi access point, 192.168.1.1:8080 , user: admin, pass: pass_ESP.  
          ESP.restart();
        }  

        if (temp=="clearwifi"){ // press, waite for esp reset, Connect PC to ESP Wifi access point, 192.168.1.1:8080 , user: admin, pass: pass_ESP.         

            Serial.println("clearwifi");
            enb_reset_wifi =true;
        }                
 }
}

}// End of handle root 
