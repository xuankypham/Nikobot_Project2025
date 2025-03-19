// Mqtt global variables which is used for many application it can be shared to other devices
// global setting variable
String mqttserver = "192.168.0.110",clientId="ESP32",username="robot",password="123456",TopicPub ="robotcar/feedback",TopicSub="robotcar/control",MqttEnable ="Enable"; // data from web
//String AlternativeBroker ="broker.emqx.io", mqserver = "192.168.0.110";
int port = 1883;
bool MqttStatus = false;
// if mqtt lost connection, after 10 times trial to connect, Mqtt will be set to Disable
int mqtt_trial =5;  unsigned int reconnect_interval = 120; // Every 5 Mins MQTT 100x500= 50.000ms 1 misute


// Main Motor control gloabl variable
bool robot_state = false,robot_mode = false,directL=true, directR=true; // True = Forward; False = Reverse ;  robot_mode  = true is auto, 0 is Manual.
// if robot_mode is true, the speed is maintain and auto control speed or direction depend on other control  Lidar, Gps, etc.  
// if manual mode it is only activate when receive data, otherwise it off when release button 
float speedL_rpm,speedL_kmh,currentL, speedR_rpm,speedR_kmh , currentR,M_volt =0.0 ,Ctr_volt=0.0;
long posR=0,posL=0; // every rotation record   // max   -2,147,483,648 to 2,147,483,64

// variable to receive and control motor
int motorspeed_cmd, direct_cmd; bool motor_enb_cmd;
// direct_cmd 0 stop, 1 fwd,2 bwd,3 left,4 right
bool fwd_status;
bool stop_status;
bool bwd_status;
bool left_status;
bool right_status; int robot_move_status ;
bool spinleft_status,spinright_status;

int remember_speed=0;//  Use for control Motor speed left right

// Error status varriable
bool R_Hcurrent,L_Hcurrent; 
bool low_volt_ctr, low_volt_motor;
float hcurrent_setpoint=20.0; //20A
float lowvolt_setpoint=10.00;  //10V

//  Temperature and Humidity Sensor
float temperature =20.0;
int humidity= 40;


float convertfloat(float v){
    int temp = v*100;
    float finalval = float(temp) / 100;
    return finalval;
}

//---------------------
    // LORA Pack send delay by number per second,   Mqtt Package, and WS package
    // Variable  to set data package Send each package per time.
int pack_freq =0; int pack_freq_mqtt =0;

//----------------PIN USED-------------------ESP32--------
#define RXD2 15
#define TXD2 16   //GPS
 
#define RXD1 17    // LORA
#define TXD1 18  // if use RS232 no need to cross over pin

//--------------------MOTOR--------------------------
// Right Motor working normal  PIN of ESP32
const uint8_t L_EN_2 = 4;  //Pin GPIO5 ESP32 ,on Arduino Mega 7
const uint8_t LPWM_2 = 5; //Pin GPIO4 ESP32,on Arduino Mega 11

const uint8_t R_EN_2 = 6;  //Pin GPIO4 ESP32,on Arduino Mega 10
const uint8_t RPWM_2 = 7; //Pin GPIO4 ESP32,on Arduino Mega 9

//// Left Motor testing
const uint8_t L_EN_1 = 8;  //ESP32 GPIO8 ,on Arduino Mega 5
const uint8_t LPWM_1 = 3;  // ESP32 GPIO9 on Arduino Mega 6  // Reverse

const uint8_t R_EN_1 = 46;  //ESP32 GPIO46 on Arduino Mega 4
const uint8_t RPWM_1 = 9; // ESP32 GPIO3 on Arduino Mega 8  //FWD

const uint8_t motor_ready_pin = 48 ; // Output indicator
const uint8_t motor_stop_pin = 45;
const uint8_t motor_alarm_pin = 14;

int CurrentIn_PinRight = 10,CurrentIn_PinLeft = 11; //GPIO 14 an GPIO13 on ESP

int volt_ctr_pin =1; 
int volt_motor_pin =2; 

// Encoder output to Arduino Interrupt pin. Tracks the pulse count.
#define ENC_PULSE_LEFT 35    // Pulse
#define ENC_DIR_LEFT 36     // Direction
// Encoder output to Arduino Interrupt pin. Tracks the pulse count.
#define ENC_PULSE_RIGHT 37 // Pulse
#define ENC_DIR_RIGHT 38  // Direction
//----------------------------------------------------
// PS2 Remote Controller
//  ESP32 pin
// https://github.com/espressif/arduino-esp32/blob/master/docs/esp32_pinmap.png

#define PS2_DAT        42  //DI  MSO
#define PS2_CMD        40  //DO  MOSI
#define PS2_SEL         41  //SS    
#define PS2_CLK        39  //SLK   

int error = -1;  // this variable used to detect Remote fail, Stop Motor for safety.
bool PS2_Remote_error = false;

//-------------------------------------
// Temperature and Humidity pin defination
#define temp_pin  12
#define humi_pin  13

//--------------------------------GPS------------------------

unsigned long last = 0UL;
// variable of GPS system
bool gps_status;
double gps_lat ,gps_lon , gpsdistance, start_pos_lat,start_pos_lon, end_pos_lat = -37.78567, end_pos_lon=175.31820;
double gpsspeed_kmh, gpsspeed_ms;
uint8_t gpshour, gpsmin, gpssec, gpsday, gpsmonth;
uint16_t gpsyear;

///////////AUTO CONTROL-----------
float lat_ctrl[8];
float lon_ctrl[8];
float heading_ctrl[8];
float distance_ctr[8];


//-----------------------------------------------
//--------------Ultra Sonic Sensor DIStance

const int echoPin2 = 47;// AFT
const int trigPin2 = 21;

const int echoPin1 = 19; // FWD
const int trigPin1 = 20;
float duration1, fwd_distance;
float duration2, aft_distance;

bool enb_stop_fwdsensor = true;
bool enb_stop_aftsensor = true;
float dist_safe = 0.8;
bool block_move_bwd=false;
bool block_move_fwd=false;

// Fwd_distance and aftdistance Abnormal

//------------------- Automatic Speed controll ------------
unsigned int AutoSpeedSetpoint = 40;
int AngleSetpoint=0;  
long Dist_Setpoint=0;
bool autoAngle=false;
bool autoPathplan=false;
unsigned int Angle=0,  lastAngle=0;
long auto_number_pulseL=0; // Position of angle Motor left
long auto_number_pulseR=0;  //Position of Angle Right Motor
unsigned int auto_pos_set=0;
bool auto_moveright=false;
bool auto_moveleft=false;
uint8_t sizePath=0;

unsigned int moveindex[8];
float dist_ang[8];
//long setpoint_dist_ang[8];
//-------------Define Length Array-----------------------
#define lengtharray(array) ((sizeof(array)) / (sizeof(array[0])))

