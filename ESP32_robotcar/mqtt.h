#include <PubSubClient.h>
//--------------------

WiFiClient espClient;
PubSubClient client(espClient);
unsigned long lastMsg = 0;
#define MSG_BUFFER_SIZE  (400) // To set buffer go in pubsubclient.h change max buffer size , default 256 byte, we can increase 356 byte
char msg[MSG_BUFFER_SIZE];
int value=0;

void callback(char* topic, byte* payload, unsigned int length); // gan bien nay vao de goi publish ben trong call back

SimpleTimer mqttTimer ;
SimpleTimer mqttTimer_receive;

//-------------------------------------
//------------package Mqtt data--send over ws-----
  String packdata3(){
  StaticJsonDocument<200> doc;//V6
  String msg;
  JsonObject object = doc.to<JsonObject>();
  object["mqttserver"] = mqttserver;
  object["port"] = port;
  object["clientId"] = clientId;
  object["username"] = username;
  object["password"] = password;
  object["TopicPub"] = TopicPub;
  object["TopicSub"] = TopicSub;
  object["MqttEnable"] = MqttEnable;

  object["IP"]=WiFi.localIP().toString();
  serializeJson(object, msg);
  return msg;
}
//-------------------------------------------------

bool write_mqtt_FLASH() {
  StaticJsonDocument<200> doc;  // JSON DATA ADDING
  doc["mqttserver"]= mqttserver;//D_SaveEnergy;
  doc["port"]= port;
  doc["clientId"]= clientId;
  doc["username"] = username; // String
  doc["password"]= password;//D_SaveEnergy;
  doc["TopicPub"]= TopicPub;
  doc["TopicSub"] = TopicSub; // String
  doc["MqttEnable"]= MqttEnable;
 
  File DataFile = LittleFS.open("/mqtt.txt", "w");
  if (!DataFile) {
    //Serial.println("Failed to open config file for writing");
    return false;
  }

  serializeJson(doc, DataFile);
  DataFile.close();
  Serial.println("Write MQTT Setting to FLASH Sussesful");
  return true;     
  }



//-------------------------------------------------------------------------------------------
void read_data_ws_mqtt(StaticJsonDocument<200> doc){

        //  CONTROL ROBOT CAR HERE

      if (doc.containsKey("robot_state")){
       motor_enb_cmd=     doc["robot_state"];
       if (motor_enb_cmd){
          enable_robot();  // robot_state =true
          String fb = "{\"robot_state\":true\"}";
          if (MqttStatus){client.publish(TopicPub.c_str(), fb.c_str());}
        }else{
          disable_robot();  // robot_state=false
          g_CarState = enSTOP;
          String fb = "{\"robot_state\":false\"}";
          if (MqttStatus){client.publish(TopicPub.c_str(), fb.c_str());}

        }
        
      }

    if (doc.containsKey("robot_mode")){
       robot_mode=     doc["robot_mode"];
       if (robot_mode){
          String fb = "{\"robot_mode\":true\"}";
          if (MqttStatus){client.publish(TopicPub.c_str(), fb.c_str());}
        }else{
          String fb = "{\"robot_mode\":false\"}";
          if (MqttStatus){client.publish(TopicPub.c_str(), fb.c_str());}
        }
        
      }

        
        //-----------------------------------------------------Control Motor
        if (doc.containsKey("joystick") && doc.containsKey("motorspeed_cmd")){
        CarSpeedControl= doc["motorspeed_cmd"];       
        direct_cmd=     doc["direct_cmd"];
       
            if (direct_cmd==0) g_CarState = enSTOP;

        if (mqttTimer_receive.isReady()) {  
            if (robot_state){
            if (direct_cmd==1)g_CarState = enRUN; //FWD
            if (direct_cmd==2)g_CarState = enBACK; // BWD
            if (direct_cmd==3)g_CarState = enLEFT; //left
            if (direct_cmd==4)g_CarState = enRIGHT; //right
            
            if (direct_cmd==5)g_CarState = enUPRIGHT;//upright
            if (direct_cmd==6) g_CarState = enUPLEFT; //upleft
            
            if (direct_cmd==7)g_CarState = enDOWNLEFT;
            if (direct_cmd==8)g_CarState = enDOWNRIGHT;
            if (direct_cmd==9)g_CarState = enSpinRIGHT; //if motor is turnright ,press button spin
            if (direct_cmd==10)g_CarState = enSpinLEFT;
            }
          mqttTimer_receive.reset();
  
          } 

        }
       

       if (doc.containsKey("motorspeed_cmd" ) && !doc.containsKey("joystick")){
        CarSpeedControl= doc["motorspeed_cmd"];       
        direct_cmd=     doc["direct_cmd"];
       
            if (direct_cmd==0) g_CarState = enSTOP;        
            if (robot_state){
            if (direct_cmd==1)g_CarState = enRUN; //FWD
            if (direct_cmd==2)g_CarState = enBACK; // BWD
            if (direct_cmd==3)g_CarState = enLEFT; //left
            if (direct_cmd==4)g_CarState = enRIGHT; //right
            
            if (direct_cmd==5)g_CarState = enUPRIGHT;//upright
            if (direct_cmd==6) g_CarState = enUPLEFT; //upleft
            
            if (direct_cmd==7)g_CarState = enDOWNLEFT;
            if (direct_cmd==8)g_CarState = enDOWNRIGHT;
            if (direct_cmd==9)g_CarState = enSpinRIGHT; //if motor is turnright ,press button spin
            if (direct_cmd==10)g_CarState = enSpinLEFT;
            }
          
  
          } 

        
       
        //----------------------------------------
        // for automatic control by GPS Signal
     // {"auto_nav":1,"lat":[-37.7861,-37.7856],"lon":[175.29,175.29049999999998],"heading":[44.89,224.89],"distance":[70.86,70.86]}
        if (doc.containsKey("auto_nav") ){
          
          uint8_t length_matrix=0;
          length_matrix = doc["lat"].size(); 


          for (int i=0 ;i<length_matrix-1 ; i++){
            lat_ctrl[i] = doc["lat"][i];
            Serial.print("Lat: " +String(i) +": ");
            Serial.println(lat_ctrl[i]);

            Serial.print("Lon: " +String(i) +": ");
            lon_ctrl[i] = doc["lon"][i];
            Serial.println(lon_ctrl[i]);

            Serial.print("Heading: " +String(i) +": ");
            heading_ctrl[i] = doc["heading"][i];
            Serial.println(heading_ctrl[i]);
          }
                
          
        
         
        }
//-----------------------------------------
      if (doc.containsKey("speed")  ){
          if (robot_state ){
            CarSpeedControl = doc["speed"];
            Serial.println("Adjust Speed: " + String(CarSpeedControl));
            
          }

      }
//---------------------------------------------------
      if (doc.containsKey("enb_stop_fwdsensor")  ){
          enb_stop_fwdsensor = doc["enb_stop_fwdsensor"];
          enb_stop_aftsensor=doc["enb_stop_aftsensor"];
          dist_safe = doc["dist_safe"];
          Serial.print(dist_safe);

      }

        if (doc.containsKey("block_move_fwd")  ){  // {"block_move_fwd":false, "block_move_bwd": false}
          block_move_fwd = doc["block_move_fwd"];
          block_move_bwd=doc["block_move_bwd"];
          

      }
//--------------------------------------------------------------------------------------------------
  if (doc.containsKey("autoAngle")  ){  // {"Angle": 30, "autoAngle":true, "AutoSpeed": 40}
    auto_number_pulseR =0; 
    auto_number_pulseL =0;
    autoPathplan = false;
    if (robot_state){
      brake();
      delay(2000);
     
     CarSpeedControl = doc["AutoSpeed"];
     int tempAngle=doc["Angle"];

     if (tempAngle>=lastAngle ){
          Angle = tempAngle-lastAngle; // Angle Spin Right
          lastAngle = tempAngle;
          // convert to Pulse:   AngleSetpoint = Angle (pulse) + auto_number_pulseR (pulse)
          //AngleSetpoint = (int) round((Angle* 0.5233 *86 /78.5)) + abs(auto_number_pulseR) ; //     Angle* 0.5233 = Lenght cm,   Conver to Pulse , 1 rotate = 86 pulse = 78.5cm,  Xcm  = lenght*86/78.5
          AngleSetpoint =  -(int)round((Angle* 7.413 *512 /109.9)) ;
          Serial.println("AngleSetpoint: " +String(AngleSetpoint));
          
          auto_moveright = true; // spin right
          g_CarState = enSpinRIGHT; 
          spin_right();

     }
    if (tempAngle<lastAngle ){   // temp angle (0-360o)
          Angle = lastAngle - tempAngle ; // Angle Spin left
          lastAngle = tempAngle;

          //AngleSetpoint = abs(auto_number_pulseR) - (int)round((Angle* 0.5233 *86 /78.5)) ; //     Angle* 0.5233 = Lenght cm,   Conver to Pulse , 1 rotate = 86 pulse = 78.5cm,  Xcm  = lenght*86/78.5
          
          AngleSetpoint = (int) round((Angle* 7.413 *512 /109.9))  ;  //(Angle* 34.54)
          Serial.println("AngleSetpoint: " +String(AngleSetpoint));
          auto_moveright = false; // spin left
           g_CarState = enSpinLEFT; 
           spin_left();
     }

      Serial.println(Angle);
      Serial.println(lastAngle);
     autoAngle= doc["autoAngle"];
    
     

    }
    }



 if (doc.containsKey("autoPathplan")  ){  // {"block_move_fwd":false, "block_move_bwd": false}
          auto_number_pulseR =0; 
          auto_number_pulseL =0;
          Angle=0;
          lastAngle=0;
  if (robot_state){
    brake();
    delay(1000);
          autoAngle = false;

          //{"moveindex":[0],"dist_ang":[2] }   //index  0, fwd,1 , bwd, 2 left, 3 right
          //lengtharray(array)
          //{"autoPathplan":true,"AutoSpeed":40,"moveindex":[0,1],"dist_ang":[1,2]}
          autoPathplan = doc["autoPathplan"];
          //AutoSpeedSetpoint = doc["AutoSpeed"];
          CarSpeedControl =doc["AutoSpeed"];

          sizePath = doc["dist_ang"].size();
          for (int i=0;i< sizePath;i++){
          dist_ang[i] = doc["dist_ang"][i];
          moveindex[i]=doc["moveindex"][i];
          Serial.println(dist_ang[i]);
          Serial.println(moveindex[i]);
          }


          if (moveindex[0]==0) {g_CarState = enRUN; 
            run_fwd();
            Dist_Setpoint = (int) round((dist_ang[0]*100 *512/109.9 ));     // 512 pulse/ distance of a rotation        (33*3.14 =109.9)
            Serial.println("Setpoint DIst : " + String(Dist_Setpoint));



          }
          else if (moveindex[0]==1) {
            g_CarState = enBACK; 
            back();
            Dist_Setpoint = -(int) round((dist_ang[0]*100 *512/109.9 ));   
            Serial.println("Setpoint DIst : " + String(Dist_Setpoint));
          }
          else if (moveindex[0]==2) {g_CarState = enSpinLEFT; 
          Dist_Setpoint = (int) round((dist_ang[0]* 7.413 *512 /109.9))  ; //     Angle* 0.5233 = Lenght cm,   Conver to Pulse , 1 rotate = 86 pulse = 78.5cm,  Xcm  = lenght*86/78.5
          Serial.println("Setpoint DIst : " + String(Dist_Setpoint));
          
          spin_left();
          
          }
          else {g_CarState = enSpinRIGHT; 

          Dist_Setpoint =  -(int)round((dist_ang[0]* 7.413 *512 /109.9)) ; //     Angle* 0.5233 = Lenght cm,   Conver to Pulse , 1 rotate = 86 pulse = 78.5cm,  Xcm  = lenght*86/78.5
          Serial.println("Setpoint DIst : " + String(Dist_Setpoint));
          spin_right();

          }

          //Serial.println(doc["dist_ang"].size());
          //Serial.println(lengtharray(dist_ang));

    }
          
    }

   //------------------------------------------------------------------------   

    if (doc.containsKey("speedlimit")  ){  // {"block_move_fwd":false, "block_move_bwd": false} Cleasr Interlock
          Carspeed_limit = doc["speedlimit"];
          
          
      }

      //--------Setup Mqtt broker----------------------------------------------
    if (doc.containsKey("mqttserver") ){
    mqttserver=  doc["mqttserver"].as<String>();
    port = doc["port"].as<int>();
    clientId=doc["clientId"].as<String>();
    username=  doc["username"].as<String>();
    password= doc["password"].as<String>();
    TopicPub= doc["TopicPub"].as<String>();
    TopicSub=doc["TopicSub"].as<String>();
    MqttEnable= doc["MqttEnable"].as<String>();
    if (MqttEnable=="Enable"){mqtt_trial =10;} // reset mqtt trial
    
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
    //String msg1 = packdata3();
    //webSocket.broadcastTXT(msg1);
    }//-----------------end of mqtt setup------
  }


//------------------------------------------------------------------
void callback(char* topic, byte* payload, unsigned int length) {
  //Serial.print("Message arrived [");
  //Serial.print(topic);
  //Serial.print("] ");
//  for (int i = 0; i < length; i++) {
//    Serial.print((char)payload[i]);
//  }
//  Serial.println();
  // Write Main code for receiveing data from MQTT here
  String strTopic = String((char*)topic);
  if (strTopic.indexOf(clientId) >= 0){
      // write code here if topic have a string value?
  }

  if (strTopic.indexOf("control") >= 0) {  // check topic string value
      
        StaticJsonDocument<200> doc;//V6
        DeserializationError error = deserializeJson(doc, payload);
        if (error) {
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        return;
      }
      else {
        serializeJson(doc, Serial);
        Serial.println();
        read_data_ws_mqtt(doc);
      //-----------------end of mqtt setup------
     
      }
  }
  
}
//-----------------------------------------------------
void reconnect() {
  // Loop until we're reconnected
  //mqttserver=mqserver;
  client.setServer(mqttserver.c_str(), port);
  client.setCallback(callback);
  int trial = 0;
  
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Create a random client ID
    Serial.println(mqttserver +","+String(port) + ","+ username+","+ password);
    
    // Attempt to connect
    if (client.connect(clientId.c_str(), username.c_str(),password.c_str())) {
      Serial.println("connected");
      // Once connected, publish an announcement...
      //client.publish(TopicPub.c_str(), "hello world");
      // ... and resubscribe
      client.subscribe(TopicSub.c_str());
      
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(50);
      
    }
    trial++;
    if (trial >1) break;
    if (trial==1){
      //mqttserver = AlternativeBroker;
    }
    
  }
      
}



void mqttPublish() {

if (!client.connected()){
  MqttStatus=false;  //Serial.println("mqtt Not connected");
  //g_CarState = enSTOP; // Car will be stop when MQTT connection fail
  Serial.println(" Sendata fail");
}  else{
  
  MqttStatus=true; //Serial.println("mqtt connected"); 
  }
//------------------------------------------
  if (pack_freq_mqtt == 0){
    String msg = packdata1();
    client.publish(TopicPub.c_str(), msg.c_str());
    }
  if (pack_freq_mqtt == 1){
    String msg = packdata2();
    client.publish(TopicPub.c_str(), msg.c_str());
  }

  if (pack_freq_mqtt == 2){
    String msg = packdata4();
    client.publish(TopicPub.c_str(), msg.c_str());
    }
  
}



// Child program---------------------------------------------
bool read_mqtt_FLASH() {
  
    File DataFile = LittleFS.open("/mqtt.txt", "r");
      if (!DataFile) {
        Serial.println("Failed to open Data file");
        return false;
      }
    
      size_t size = DataFile.size();
      if (size > 1024) {
        Serial.println("Config file size is too large");
        return false;
      }
    
      // Allocate a buffer to store contents of the file.
      std::unique_ptr<char[]> buf(new char[size]);
    
      // We don't use String here because ArduinoJson library requires the input
      // buffer to be mutable. If you don't use ArduinoJson, you may as well
      // use DataFile.readString instead.
      DataFile.readBytes(buf.get(), size);
    
      StaticJsonDocument<200> doc;
      auto error = deserializeJson(doc, buf.get());
      if (error) {
        Serial.println("Failed to parse config file");
        return false;
      }
    
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
    
    
        
     DataFile.close(); // Khi mo File ra thi phai CLOSE FILE lai, Neu ko se ko doc ghi dc nua
     return true;

  }
}



// END OF CHILD PROGRAM
  
