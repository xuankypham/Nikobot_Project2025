#include <WebSocketsServer.h>
WebSocketsServer webSocket = WebSocketsServer(81);

SimpleTimer wsTimer;


void webSocketEvent(byte num, WStype_t type, uint8_t * payload, size_t length) {      // the parameters of this callback function are always the same -> num: id of the client who send the event, type: type of message, payload: actual data sent and length: length of payload
  switch (type) {                                     // switch on the type of information sent
    case WStype_DISCONNECTED:                         // if a client is disconnected, then type == WStype_DISCONNECTED
      Serial.println("Client " + String(num) + " disconnected");
      break;
    case WStype_CONNECTED:                            // if a client is connected, then type == WStype_CONNECTED
      Serial.println("Client " + String(num) + " connected");
      // optionally you can add code here what to do when connected
      break;
    case WStype_TEXT:                                 // if a client has sent data, then type == WStype_TEXT
      // try to decipher the JSON string received

       //Serial.printf("[%u] get Text: %s\n", num, payload);
      
      StaticJsonDocument<200> doc;                    // create a JSON container
      DeserializationError error = deserializeJson(doc, payload);
      if (error) {
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        
        return; break;
      }
      else {
        // JSON string was received correctly, so information can be retrieved:
        //extract data from Json object to variable
        serializeJson(doc, Serial);
        Serial.println();

    
         read_data_ws_mqtt(doc);  // this is shared with MQTT
        //----------------------------------
        if (doc.containsKey("Mqtt_setup_val")){
            String msg1 = packdata3();
            webSocket.broadcastTXT(msg1);               // send JSON string to client 
            }
      }
    //--------------------------------------
     break;
  }
}


void senddata_ws(){
  
  if (pack_freq == 0){
    String msg = packdata1();
    webSocket.broadcastTXT(msg);               // send JSON string to clients
  }
  if (pack_freq ==1){
    String msg = packdata2();
    webSocket.broadcastTXT(msg);               // send JSON string to clients
  }
  if (pack_freq ==2){
    String msg = packdata4();
    webSocket.broadcastTXT(msg);               // send JSON string to clients
  }
}
