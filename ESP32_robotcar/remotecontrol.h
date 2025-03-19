#include <PS2X_lib.h>  //for v1.6

/******************************************************************
 * set pins connected to PS2 controller:
 *   - 1e column: original
 *   - 2e colmun: Stef?
 * replace pin numbers by the ones you use
 ******************************************************************/



/******************************************************************
 * select modes of PS2 controller:
 *   - pressures = analog reading of push-butttons
 *   - rumble    = motor rumbling
 * uncomment 1 of the lines for each mode selection
 ******************************************************************/
#define pressures   false
#define rumble      false

PS2X ps2x; // create PS2 Controller Class

//right now, the library does NOT support hot pluggable controllers, meaning
//you must always either restart your Arduino after you connect the controller,
//or call config_gamepad(pins) again after connecting the controller.

//int error = -1;
byte type = 0;
byte vibrate = 0;
int tryNum = 1;
bool reconfig_remote=false;


void config_remoteps2(){
 error = ps2x.config_gamepad(PS2_CLK, PS2_CMD, PS2_SEL, PS2_DAT, pressures, rumble);
//error = ps2x.config_gamepad(9,7,6,8, true, true);   //setup pins and settings:  GamePad(clock, command, attention, data, Pressures?, Rumble?) check for error
 
 if(error == 0){
   Serial.println("Found Controller, configured successful");
   
 }
   
  else if(error == 1)
   Serial.println("No controller found, check wiring.");
   
  else if(error == 2)
   Serial.println("Controller found but not accepting commands.");
   
  else if(error == 3)
   Serial.println("Controller refusing to enter Pressures mode, may not support it. ");
   
  //Serial.print(ps2x.Analog(1), HEX);
   
   type = ps2x.readType(); 
     switch(type) {
       case 0:
        Serial.println("Unknown Controller type");
       break;
       case 1:
        Serial.println("DualShock Controller Found");
       break;
       case 2:
         Serial.println("GuitarHero Controller Found");
       break;
       case 3:
         Serial.println(" Wireless Sony DualShock Controller found ");
        break;
     }

     reconfig_remote=false;

   
} 
   
//---------------------------------------
/*
bool fwd_status;
bool stop_status;
bool bwd_status;
bool left_status;
bool right_status;
*/
// Checking Signal from remote
void receive_remote_ps2(){
  if(type == 1){ //DualShock Controller
    ps2x.read_gamepad(false, vibrate); //read controller and set large motor to spin at 'vibrate' speed
    // Function set car status
    //set_status_of_car(bool fwd,bool bwd, bool left, bool right, bool stopst) 
    
    //will be TRUE as long as button is pressed
    if(ps2x.ButtonPressed(PSB_START)){
     
       enable_robot();
       Serial.println("Start Enable car");
    }
    
    if(ps2x.ButtonPressed(PSB_SELECT)){
      
      g_CarState=enSTOP;
      disable_robot();
      Serial.println("Disable Car by remote");
    }
    
        if(ps2x.ButtonPressed(PSB_PAD_UP)) {
          
          g_CarState = enRUN;
          Serial.println("move fwd: "  + String(CarSpeedControl));
          
        }
        if(fwd_status &&ps2x.ButtonPressed(PSB_CIRCLE)&&CarSpeedControl>50){
          
          g_CarState = enUPRIGHT;
          Serial.println("turn right fwd , Left motor speed: " + String(CarSpeedControl+30) + ", Right Motor Speed: "+ String(CarSpeedControl-30));
        }
    
        if(fwd_status&&ps2x.ButtonPressed(PSB_SQUARE)&&CarSpeedControl>50){
          
          g_CarState = enUPLEFT;
          Serial.println("Turn left Fwd, Left motor speed: " + String(CarSpeedControl-30) + ", Right Motor Speed: "+ String(CarSpeedControl+30));
        }
    //------------------------------------BWD----------------------
        
        if(ps2x.ButtonPressed(PSB_PAD_DOWN)) {
          
          g_CarState = enBACK;
          Serial.println("move bwd: " + String(CarSpeedControl));
        }
        if(bwd_status&&ps2x.ButtonPressed(PSB_CIRCLE) && CarSpeedControl>50){
          
          g_CarState = enDOWNRIGHT;
          Serial.println("turn right bwd, Left motor speed: " + String(CarSpeedControl+30) + ", Right Motor Speed: "+ String(CarSpeedControl-30));
        }
    
        if(bwd_status&&ps2x.ButtonPressed(PSB_SQUARE)&&CarSpeedControl>50){
          
          g_CarState = enDOWNLEFT;
          Serial.println("Turn left bwd, Left motor speed: " + String(CarSpeedControl-30) + ", Right Motor Speed: "+ String(CarSpeedControl+30));
        }
    
    
    //--------------------------------------left and right----------------------
    
     if(ps2x.ButtonPressed(PSB_PAD_LEFT)){
         
          g_CarState = enLEFT;
           Serial.println("Turn left, right motor run, left motor off: " + String(CarSpeedControl));
        }
    
     if(left_status&&ps2x.ButtonPressed(PSB_R2)){  // SPIN LEFT
          
          g_CarState= enSpinRIGHT;
          Serial.println("Spin left, right motor run reverse, left motor run forward: " + String(CarSpeedControl));
          
        }
    //---------   Right------------
    
     if(ps2x.ButtonPressed(PSB_PAD_RIGHT)){
          
          g_CarState = enRIGHT;
          Serial.println("Turn right, Left motor run, right motor off: " + String(CarSpeedControl));
        }
    
     if(right_status&&ps2x.ButtonPressed(PSB_R2)){ // Spin right
          
          g_CarState= enSpinRIGHT;
          Serial.println("Spin right, left motor run fwd, left motor run backward: " + String(CarSpeedControl));
        }
    

    //△□○×-----------------------------------SPEED ADJUST----------------
    if(ps2x.ButtonPressed(PSB_TRIANGLE))  {             
      
        CarSpeedControl += 10;
        if (CarSpeedControl > 250)
          {
            CarSpeedControl = 250;
          }

       if (CarSpeedControl < 20)
          {
            CarSpeedControl = 20;
          }

          Serial.println("△ Increase Speed: " + String(CarSpeedControl));
    }

    if(ps2x.ButtonPressed(PSB_CROSS)) {              
     
        CarSpeedControl -=10;
        if (CarSpeedControl < 20)
          {
            CarSpeedControl = 0;
          }
      Serial.println("X Decrease Speed: " + String(CarSpeedControl));
    }
     //-------------------------------
 //  FOR ANALOGE CONTROL Car by JOYSTIC RIGHT
   //-------------------------------------------------
    
  if (ps2x.Button(PSB_L1) || ps2x.Button(PSB_R1))
  {

    //------------Speed--------------
    
    //CarSpeedControl = AlalogSpeed; PS2 remote Center = 128 ( 0-256)
    //-----------------------------------
    //print stick values if either is TRUE
    int X1 = ps2x.Analog(PSS_RX);
    int Y1 = ps2x.Analog(PSS_RY);

    if (Carspeed_limit>255){Carspeed_limit=255; }
    if (Carspeed_limit<0){Carspeed_limit=0; }

    if (Y1 <118 && X1 >= 118 && X1 <= 138)         //UP
    {
      g_CarState = enRUN;
      CarSpeedControl = map(Y1,117,0,0,Carspeed_limit);

      Serial.println("Move FWD: " + String(CarSpeedControl));
    }
    else if (Y1 >138 && X1 >= 118 && X1 <= 138) //DOWN
    {
      g_CarState = enBACK;
      CarSpeedControl = map(Y1,137,254,0,Carspeed_limit);

      Serial.println("Move BWD: " + String(CarSpeedControl));
    }
    else if (X1 < 118 && Y1 >= 118 && Y1 <= 138)   //LEFT
    {
      g_CarState = enLEFT;
      CarSpeedControl = map(X1,117,0,0,Carspeed_limit);

      Serial.println("Move LEFT: " + String(CarSpeedControl));
    }
    else if (X1 >138  && Y1 >= 118 && Y1 <= 138) //RIGHT
    {
      g_CarState = enRIGHT;
      CarSpeedControl = map(X1,139,254,0,Carspeed_limit);
      
      Serial.println("Move Right: " + String(CarSpeedControl));
    }
    
    else                                         //stop
      {
        g_CarState = enSTOP;
        CarSpeedControl=0;
        Serial.println("STOP CAR: " + String(CarSpeedControl));
        
      }
  }
}
}

