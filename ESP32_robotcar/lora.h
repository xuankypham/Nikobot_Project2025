 
unsigned int pack_freq_lora = 0; // freq sent
SimpleTimer loraTimer ;

void read_lora(){
    while (Serial1.available()) {        // Check if there is any data on the serial monitor  We can use if (Serial2.available()>0)
    String DataIn = Serial1.readString();       // String DataIn receives the data typed in the Serial Monitor
    Serial.println(DataIn);
    
        StaticJsonDocument<200> doc;//V6
        DeserializationError error = deserializeJson(doc, DataIn);
        if (error) {
        Serial.print(F("deserializeJson() Lora failed: "));
        Serial.println(error.f_str());
        return;
      }
      else {
        serializeJson(doc, Serial);
        
        read_data_ws_mqtt(doc); // Control Motor here( in mqtt .h)
        
         
      
            //--------Setup Mqtt broker----------
        if (doc.containsKey("mqttserver") ){  
       // {"mqttserver":"192.168.0.1", "port":1884, "clientId":"esp32", "username":"robot", "password":"123456", "TopicPub":"robotcar/feedback", "TopicSub":"robotcar/control","MqttEnable": "Enable"}
        if (doc.containsKey("mqttserver") ){
        mqttserver=  doc["mqttserver"].as<String>();
        port = doc["port"].as<int>();
        clientId=doc["clientId"].as<String>();
        username=  doc["username"].as<String>();
        password= doc["password"].as<String>();
        TopicPub= doc["TopicPub"].as<String>();
        TopicSub=doc["TopicSub"].as<String>();
        MqttEnable= doc["MqttEnable"].as<String>();
         if (mqttserver != "") {
              Serial.println("Mqtt Server is: "+mqttserver);
              Serial.println("port   is: " +String(port));
              Serial.println("ClientID   is: " +clientId);
              Serial.println("username   is: " +username);
              Serial.println("PassWord is: " +password);
              Serial.println("TopicPub   is: " +TopicPub);

              Serial.println("TopicSub   is: " +TopicSub);
              Serial.println("MqttEnable   is: " +MqttEnable);
         } else {  Serial.println("MQTT Broker is not config");}
        
        
        write_mqtt_FLASH();
    
        } else{Serial.println("mqtt server setting fail");}
        
        //-----------------end of mqtt setup------
  
      }
      
    }
  }
}
//--------------End------------------------


void senddata_lora(){
  //send data to Lora 
  
  if (pack_freq_lora ==0)
    {
    String msg = packdata1();
    Serial1.println(msg);
    }
    
  if (pack_freq_lora ==1)
     {
     String msg = packdata2();
     Serial1.println(msg); 
     //Serial.println("Send lora data");
     } 
   if (pack_freq_lora ==2)
     {
     String msg = packdata4();
     Serial1.println(msg); 
     //Serial.println("Send lora data");
     }
}
