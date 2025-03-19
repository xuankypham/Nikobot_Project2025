/**
This program is for reading and controlling robot car.
this is making with many communication protocal in this project, each protocal is separate by file.h
*/


// JSON DOCCUMENT PROCESS
#include <ArduinoJson.h>
#include <SimpleTimer.h>

//--------------webserver ESP32------------
#include <WiFi.h>
#include <WiFiClient.h>
#include <NetworkClient.h>
#include <WebServer.h>
#include <ESPmDNS.h>
#include <Update.h>

#include <Arduino.h>
#include "FS.h"
#include <LittleFS.h>
WebServer server(80);

#include <HardwareSerial.h>

// Replace with your network credentials

const char* host_name = "esp32_robot";

#include "globalvariable.h"
#include "wifisetup.h"
#include "filesystem.h"
#include "gps.h"
#include "motor.h"
#include "robot_run_mode.h"
#include "mqtt.h"
#include "lora.h"
#include "temp_humidity.h"
#include "websocket.h"
#include "web_process.h"
#include "remotecontrol.h"
#include "ultrasonic.h"
#include "automatic_control.h"
#include "safety.h"



//---------------------------------------------------------
void setup() {
    
  Serial.begin(115200);
  //ss.begin(GPSBaud);
  Serial1.begin(115200, SERIAL_8N1, RXD1, TXD1);
  Serial2.begin(GPSBaud, SERIAL_8N1, RXD2, TXD2);// Pin 15,16; GPS 
  
 
  delay(3000);
  
  Serial.println("\n Starting");
  Serial.println("Information- - TEST");

  wifi_configure();

  pinMode(motor_ready_pin, OUTPUT);// Ready
  pinMode(motor_stop_pin, OUTPUT);// STop
  pinMode(motor_alarm_pin, OUTPUT);// Alarm

  //----------------LittleFS  Enable----

  if (!LittleFS.begin(true)) {
     Serial.println("SPIFFS initialisation failed...");
     SPIFFS_present = false; 
  }else{
    Serial.println(F("SPIFFS initialised... file access enabled..."));
    SPIFFS_present = true; 
    }

//   After enable little fs,---------------
  // read setting file and set to ESP
   
  read_mqtt_FLASH();
  
  delay(1000);
//------------------------------------
  MDNS.begin(host_name);
 //if (MDNS.begin(host_name)) {Serial.println("HTTP Service is started");}
 
///////////////////////////// Server Commands SPIFFS----------------------
  server.serveStatic("/", LittleFS, "/index.htm");
  server.serveStatic("/setup", LittleFS, "/setup.htm");  // Read static web on FS
  server.serveStatic("/about",LittleFS,"/about.htm"); 
  server.serveStatic("/config",LittleFS,"/config.htm"); 
  server.serveStatic("/wsdata",LittleFS,"/wsdata.htm"); 
   
  //------------------------------------------------------
  server.on("/SetRobot", handle_SetRobot); // handles button values AJAX or FORM 
  server.on("/setup_mqtt",handle_setup); // response from FORM submit
  server.on("/setup_wifi",handle_setup); // response from FORM submit

  //---------------------------------------------
  server.on("/fs_read",         HomePage);
  server.on("/download", File_Download);
  server.on("/upload",   File_Upload);
  server.on("/fupload",  HTTP_POST,[](){ server.send(200);}, handleFileUploadFS);
  server.on("/stream",   File_Stream);
  server.on("/delete",   File_Delete);
  server.on("/dir",      SPIFFS_dir);

  //server.onNotFound(handleNotFound);

//---------------------------------------------------------
server.on("/configure", HTTP_GET, []() {
      server.sendHeader("Connection", "close");
      server.send(200, "text/html", serverIndex());
    });
server.on(
      "/update", HTTP_POST,
      []() {
        server.sendHeader("Connection", "close");
        server.send(200, "text/html", (Update.hasError()) ? update_html_fail() : update_html_success());
        delay(4000);
        ESP.restart();
      },
      []() {
        HTTPUpload &upload = server.upload();
        if (upload.status == UPLOAD_FILE_START) {
          Serial.setDebugOutput(true);
          Serial.printf("Update: %s\n", upload.filename.c_str());
          if (!Update.begin()) {  //start with max available size
            Update.printError(Serial);
          }
        } else if (upload.status == UPLOAD_FILE_WRITE) {
          if (Update.write(upload.buf, upload.currentSize) != upload.currentSize) {
            Update.printError(Serial);
          }
        } else if (upload.status == UPLOAD_FILE_END) {
          if (Update.end(true)) {  //true to set the size to the current progress
            Serial.printf("Update Success: %u\nRebooting...\n", upload.totalSize);
          } else {
            Update.printError(Serial);
          }
          Serial.setDebugOutput(false);
        } else {
          Serial.printf("Update Failed Unexpectedly (likely broken connection): status=%d\n", upload.status);
        }
      }
    );
    //----------------------------------------------


  //--------------------
  server.begin();
  
  MDNS.addService("http", "tcp", 80);
  Serial.println("HTTP server started");
  //--------------------------------------------
// Websocket---------
  webSocket.begin();
  webSocket.onEvent(webSocketEvent);

//----------------------
 // Set an interval to 3 secs for the second timer
    wsTimer.setInterval(200);
    mqttTimer.setInterval(200);
    motorTimer.setInterval(1000);
    loraTimer.setInterval(500);
    mqttTimer_receive.setInterval(200);
    autoTimer.setInterval(200);

//-----------------Set ADC------
//set the resolution to 12 bits (0-4096)
  analogReadResolution(12); // set Analoge for all process // 12 bit

//------------------Motor Encorder--
 config_motor_encorder();

 //----------------------------
config_remoteps2();

setup_ultrasonic();





}
//End Setup------



//------------------------------------------MAIN PROGRAM---------------------------------
void loop() {
 server.handleClient(); // Listen for client connections
 webSocket.loop();


  //------------------------------------------------------------
  //GPS SIgnal reading
  gps_receiveData();
  
  //-------Motor --COntrol--------- 
  
       
      
    read_currentsensor(); //TEMP DISABLE
    calculateMotorSpeed();
    
  //--------------------------------
    read_lora();

   run_ultrasonicsensor();


   //----------Send LORA-------------------
   if (loraTimer.isReady()) {  
      
      pack_freq_lora ++;
        if (pack_freq_lora ==3) {
          pack_freq_lora =0;
               
        }  
    
      senddata_lora();

    loraTimer.reset();
  
  } 


    //-------------------------Websocket----Random data

    if (wsTimer.isReady()) {    
        //Serial.println("5 seconds have passed");
        senddata_ws();
        
        pack_freq ++;
        if (pack_freq ==3) {
        
          pack_freq =0;
               
        }  




        if (!digitalRead(TRIGGER_PIN)){
            counter_for_pin_reset ++;
            Serial.println("reset wifi in progress after " + String(counter_for_pin_reset) +" second");
            if (counter_for_pin_reset==10){
              enb_reset_wifi =true;
              counter_for_pin_reset = 0;
            }
            
        }else{ counter_for_pin_reset = 0;}

        readvoltagesensor();
        readtemp_humidity();

        

        //--------------------------------------PS2 REMOTE AREA-------------
        if (reconfig_remote){
         config_remoteps2();
        }

        // REMOTE PS2
        if (error==0){
        receive_remote_ps2();  // University
        PS2_Remote_error = false;
        } else{
          //reconfig_remote=true;
          //g_CarState =enSTOP;
          //robot_state = false;
          PS2_Remote_error = true;
        }
        //------------------------END PS2 Remote-----------------------
        
        //---------Check Wifi push button press or not-----
        if (enb_reset_wifi ){
            Serial.print(" Counting Timer Clear Wifi: ");
            Serial.print(Count_time_to_clear_wifi);
            Count_time_to_clear_wifi+=1;

        }else{
            Count_time_to_clear_wifi=0;
        }
        
        //-----------------------------------------
        //MQTT   In the case MQTT is not connected, the timer will activate to reconect every 3s

          if (!client.connected()) {

        reconnect_interval--;
    if (reconnect_interval<2){
      MqttEnable="Enable";
      Serial.println("Enable to try Connect mqtt");
    }

    if (reconnect_interval==0){

          reconnect_interval = 10;
    }





          }
        
        wsTimer.reset(); 



    }


if(WiFi.status() == WL_CONNECTED){
//do something when wifi is connected
    // MQTT only loop when Wifi is connected
    if (MqttEnable=="Enable"){
    client.loop();

    if (mqttTimer.isReady()) {  

      if (!client.connected()) {
        reconnect();
        mqtt_trial--;
        
        
       if (mqtt_trial ==0){
        MqttEnable="Disable";
        MqttStatus=false; Serial.println("MQTT is disabled due to 2 times trying but cannot connect");
        mqtt_trial =5;
        } // disable MQTT after 10 times trial to connect fail
        

      }else{
        mqtt_trial =5;
        //MqttEnable="Enable";
      }

      mqttPublish();

      pack_freq_mqtt ++;
      if (pack_freq_mqtt ==3)   {pack_freq_mqtt =0;}

      mqttTimer.reset();

      
    }

    }
} else{ //clearwifi_flag =0;

if (mqttTimer.isReady()) { 
Serial.println("Wifi is not connected or cleared from EEFROM, Please config wifi");
 
 mqttTimer.reset();


}
}

//-------------------------------------------------------------------
  
//----------------------------------MANUAL CONTROL-----------


if (!robot_mode )  {

//--------------------------------------
switch (g_CarState)  // Control Motor
  {
    //case enDisable: disable_robot(); break;
    //case enEnable: enable_robot();break;
    case enSTOP: brake(); break;
    case enRUN: run_fwd();  break;
    case enLEFT: left();  break;
    case enRIGHT: right(); break;
    case enBACK: back(); break;
    case enUPLEFT: upleft();  break;
    case enUPRIGHT: upright(); break;
    case enDOWNLEFT: downleft();  break;
    case enDOWNRIGHT: downright(); break;
    case enSpinLEFT: spin_left(); break;
    case enSpinRIGHT: spin_right(); break;
    default: break;
  }


} else{
if(robot_state){
loop_automatic_control();
}

}


// Update Robot status
  robotmovestatus();
//-----------------------------------end of Remote---------------

// Indicator Light----------------------------
if (robot_state){
   digitalWrite(motor_ready_pin,HIGH);
   digitalWrite(motor_stop_pin,LOW);
}else{
   digitalWrite(motor_ready_pin,LOW);
   digitalWrite(motor_stop_pin,HIGH);
}
  
if(WiFi.status() == !WL_CONNECTED || MqttStatus==false){

digitalWrite(motor_alarm_pin,HIGH);

} else{
  digitalWrite(motor_alarm_pin,LOW);
}
//------------------------------


wifi_ondeman();




//-----------SAFETY---------------
safety_distance_ultrasonic();
safety_volt_current_action();



if (CarSpeedControl>Carspeed_limit){CarSpeedControl =Carspeed_limit;}


//--------------------End of main loop------------------------------------------
}
