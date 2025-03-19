#include "BTS7960.h"


// One-second interval for measurements
int interval = 1000;
  
// Counters for milliseconds during interval
long previousMillis = 0;
long currentMillis = 0;
//------------------------------------------------------------------------

BTS7960 LeftMotor(L_EN_1,R_EN_1, LPWM_1, RPWM_1);
BTS7960 RightMotor(L_EN_2,R_EN_2, LPWM_2, RPWM_2);
//-----------------------------------------
volatile bool has_interrupted_enc_L = false;
volatile bool has_interrupted_enc_R = false;

//------------------------------------------
// Motor encoder output pulses per 360 degree revolution (measured manually)
#define ENC_COUNT_REV 512
float wheelradius = 0.175;  // meter

SimpleTimer motorTimer ;
// timer

const float rpm_to_radians = 0.10471975512;
const float rad_to_deg = 57.29578;
//--------Right Motor Encorder----------
int total_count_R =0;  // every 512 pulse, total_cout_L reset to 0, Rotate_L +1  // rotation

// linear vilocity  V = r*Angular_vilocity  // r is radius of wheel in meter
    // Keep track of the number of right wheel pulses
volatile long right_wheel_pulse_count = 0;
 
// Variable for angular velocity measurement
float ang_velocity_right = 0;
float ang_velocity_right_deg = 0;

//-----Left Encorder-variable------------------

int total_count_L =0;  // every 512 pulse, total_cout_L reset to 0, Rotate_L +1  // rotation

// Variable using for calculate Motor Speed


// linear vilocity  V = r*Angular_vilocity  // r is radius of wheel in meter

 // Keep track of the number of right wheel pulses
volatile long left_wheel_pulse_count = 0;
// Variable for RPM measuerment
 
// Variable for angular velocity measurement
float ang_velocity_left = 0;
float ang_velocity_left_deg = 0; 
//--------------End of Encorder-----------

//Current Sensor Reading-------
//Defining current variables************************************************************************************


float CurrentTotalRight = 0;
float CurrentTotalLeft = 0;

//---------------------------------------------TEST ROTATION--------------------------------
long wheel_left_pulse=0;
long wheel_right_pulse=0;

void read_currentsensor(){
  
 int Current_right_motor  = analogReadMilliVolts(CurrentIn_PinRight);  
 int Current_left_motor = analogReadMilliVolts(CurrentIn_PinLeft);     

  // offset 2.5V  at 0A.     2.5V = 2500 mV
  // 72mV /A   ( Supply 5vdc)    2572mV = 1A   ( range mv 60 to 84 mv/A , Typical 72mV)
  
 float ampe_right = (Current_right_motor -2500)/72 ;
 float ampe_left = (Current_left_motor -2500)/72 ;
  //Serial.print("ampe_right: "); Serial.println(ampe_right);
  //Serial.print("ampe_left: "); Serial.println(ampe_left);

  currentR = ampe_right;
  currentL =ampe_left;
}





// Increment the number of pulses by 1 with Right motor encorder
// Increment the number of pulses by 1 with Right motor encorder
void right_wheel_pulse() {
   
  // Read the value for the encoder for the right wheel
  int val = digitalRead(ENC_DIR_RIGHT); // Direction
 
  if(val == LOW) {
    directR = false; // Reverse
   
  }
  else {
    directR = true; // Forward
  }
   
  if (directR) {   // Remember 2 Encorder is install opposite side so left and right encorder opposite reading data
    right_wheel_pulse_count--;
        if(robot_mode){
        auto_number_pulseR--;
        }

    //Serial.println(right_wheel_pulse_count);
    total_count_R--; // count pulse, used for counting rotation of wheel
    //Serial.println(total_count_R);
    if (total_count_R ==-512){total_count_R =0 ;posR--;
    //Serial.print("Rotation right bwd: ");
    //Serial.println(posR);
    }  
  }
  else {
    right_wheel_pulse_count++;
    //Serial.println(right_wheel_pulse_count);
        if(robot_mode){
        auto_number_pulseR++;
        }
    total_count_R++; // count pulse, used for counting 
    //Serial.println(total_count_R);
    if (total_count_R ==512){total_count_R =0 ;posR++;
    //Serial.print("Rotation right fwd: ");
    //Serial.println(posR);
    }
  }
}

// ----------------------------------
// Increment the number of pulses by 1 with LEFT motor encorder
void left_wheel_pulse() {
   
  // Read the value for the encoder for the right wheel
  int val = digitalRead(ENC_DIR_LEFT); // Direction
  
 
  if(val == LOW) {
    directL = false; // Reverse
  }
  else {
    directL = true; // Forward
  }
   
  if (directL) {
    left_wheel_pulse_count++;
    //Serial.println(left_wheel_pulse_count);
    if(robot_mode){
    auto_number_pulseL++;
    }

    total_count_L++; // count pulse, used for counting 
    //Serial.println(total_count_L);
    if (total_count_L ==512){total_count_L =0 ;posL++;
    //Serial.print("Rotation left fwd: ");
    //Serial.println(posL);
    }
  }
  else {
    left_wheel_pulse_count--;  // use for calculate speed
        if(robot_mode){
         auto_number_pulseL--; // use for Auto control
        }
    //Serial.println(left_wheel_pulse_count);

    total_count_L--; // count pulse, used for counting 
    //Serial.println(total_count_L);
    if (total_count_L ==-512){
    total_count_L =0; 
    posL--;
    //Serial.print("Rotation left bwd: ");
    //Serial.println(posL);
    }
  }
}
//------------------------------------

//--------------------------



 void config_motor_encorder(){
  // Set pin states of the encoder
  pinMode(ENC_PULSE_LEFT , INPUT_PULLUP);
  pinMode(ENC_DIR_LEFT , INPUT);
 
  // Every time the pin goes high, this is a pulse
  attachInterrupt(digitalPinToInterrupt(ENC_PULSE_LEFT), left_wheel_pulse, RISING);

  // Set pin states of the encoder
  pinMode(ENC_PULSE_RIGHT , INPUT_PULLUP);
  pinMode(ENC_DIR_RIGHT , INPUT);
  attachInterrupt(digitalPinToInterrupt(ENC_PULSE_RIGHT), right_wheel_pulse, RISING);


 }






//----------------------------
void speedCalculate_R(){
  // Calculate revolutions per minute for right motor
    speedR_rpm = (float)(right_wheel_pulse_count * 60 / ENC_COUNT_REV);
    ang_velocity_right = speedR_rpm * rpm_to_radians;   
    ang_velocity_right_deg = ang_velocity_right * rad_to_deg;
    //Serial.println(speedR_rpm); 
    right_wheel_pulse_count = 0;
    //Serial.print("speedR_rpm"); Serial.println(speedR_rpm);
    
    //(Linear Velocity in meters per second) = (Radius of the wheel in meters) * (Angular Velocity in radians per second)
   // v = r * ω
    float v = wheelradius * ang_velocity_right ;  // m/s
    speedR_kmh = v* 18/5 ;  // km/h

    float temp  = v* 18/5 ;  // km/h
    speedR_kmh = abs(convertfloat(temp));
   
    //Serial.print(" Linear Velocity of Right Motor km/h: ");
    //Serial.println(speedR_kmh); 
    //1m/h =18/5 km/h   ;   n m/s  = n* 18/5 km/h

}
//---------------------Speed left----------------
void speedCalculate_L(){

    // Calculate revolutions per minute
    speedL_rpm = (float)(left_wheel_pulse_count * 60 / ENC_COUNT_REV);
    ang_velocity_left = speedL_rpm * rpm_to_radians;   
    ang_velocity_left_deg = ang_velocity_left * rad_to_deg;
     
    left_wheel_pulse_count = 0;
    //Serial.print("speedLeft_rpm");
    //Serial.println(speedL_rpm); 
    //(Linear Velocity in meters per second) = (Radius of the wheel in meters) * (Angular Velocity in radians per second)
   // v = r * ω
    float v = wheelradius * ang_velocity_left ;  // m/s
    
    float temp  = v* 18/5 ;  // km/h
    speedL_kmh = abs(convertfloat(temp));
    
    //Serial.print(" Linear Velocity of LEFT Motor km/h: ");
    //Serial.println(speedL_kmh); 
    //1m/h =18/5 km/h   ;   n m/s  = n* 18/5 km/h

    }

//------------------------------------
void calculateMotorSpeed(){
   
  if (motorTimer.isReady()) {  
     speedCalculate_R();
     speedCalculate_L();

    motorTimer.reset();
  
  }




}
//-------------------------------------
  

//-------------------------------------

//---------------------
String packdata1(){
  StaticJsonDocument<600> doc;//V6
  String msg;
  JsonObject object = doc.to<JsonObject>();
  doc["robot_state"]=robot_state;
  doc["robot_mode"]=robot_mode;
  
  object["speedL_rpm"]= abs(speedL_rpm);
 
  object["speedL_kmh"]= speedL_kmh;
  object["posL"]=posL;
  object["currentL"]=currentL;
  if (!directL){object["directL"]="BWD";} else{object["directL"]="FWD";}
  
  object["speedR_rpm"]=abs(speedR_rpm);
  object["speedR_kmh"]=speedR_kmh;
  object["posR"]=posR;
  object["currentR"]=currentR;
  if (directR){object["directR"]="BWD";} else{object["directR"]="FWD";}
  object["M_volt"]= M_volt;
  object["Ctr_volt"]= Ctr_volt;
  object["carmove"] = robot_move_status; 
// 0: Stop, 1 fwd, 2, bwd, 3, left,4 right,5 upleft,6, upright,7,downleft, 8 downright,9 Spin left, 10 spin right.
  serializeJson(object, msg);
 
  return msg;
}

String packdata2(){
  StaticJsonDocument<600> doc;//V6
  String msg;
  JsonObject object = doc.to<JsonObject>();
  
  object["gpslat"] = gps_lat;
  object["gpslon"] = gps_lon;
  
  
  object["mqttstatus"]=MqttStatus;
  object["L_Hcurrent"] = L_Hcurrent;
  object["R_Hcurrent"] = R_Hcurrent;
  object["low_volt_ctr"] = low_volt_ctr;
  object["low_volt_motor"] =low_volt_motor;
  
  object["host_name"]= host_name;
  object["IP"]=WiFi.localIP().toString();
  serializeJson(object, msg);
  
  return msg;
}


String packdata4(){
  StaticJsonDocument<300> doc;//V6
  String msg;
  JsonObject object = doc.to<JsonObject>();
  
  object["PS2_status"] = PS2_Remote_error;
  object["temp"] = temperature;
  object["humi"] = humidity;
  object["fwd_dist"] = fwd_distance;
  object["aft_dist"] = aft_distance;
  object["gpsdistance"] = gpsdistance;
  object["gpsspeed_kmh"] = gpsspeed_kmh;
  object["gpsspeed_ms"] = gpsspeed_ms;
  object["fwd"] = enb_stop_fwdsensor;
  object["aft"] = enb_stop_aftsensor;
  object["dist"] =dist_safe;

  object["fwdMove"] = block_move_fwd;
  object["bwdMove"] = block_move_bwd;
  object["Angle"] = lastAngle;
  serializeJson(object, msg);
  return msg;
}
