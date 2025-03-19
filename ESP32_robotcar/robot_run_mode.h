/*Car running status enumeration*/
enum {
  //enDisable,
  //enEnable,
  enSTOP = 1,
  enRUN,
  enBACK,
  enLEFT,
  enRIGHT,
  enUPLEFT,
  enUPRIGHT,
  enDOWNLEFT,
  enDOWNRIGHT,
  enSpinLEFT,
  enSpinRIGHT
} enCarState;


int CarSpeedControl = 0;
int Carspeed_limit = 120;
int g_CarState = enSTOP;  
//----------------------------------------------

void set_status_of_car(bool fwd,bool bwd, bool left, bool right, bool stopst, bool spinleft,bool spinright){
fwd_status=fwd;
stop_status=stopst;
bwd_status=bwd;
left_status=left;
right_status=right;
spinleft_status=spinleft;
spinright_status=spinright;

}

//---------------------------------------------------------------------------
void enable_robot(){  // enable car
   LeftMotor.Enable();
   RightMotor.Enable();
   robot_state=true;
  
}
void disable_robot(){ // Disable car
  LeftMotor.Stop();
  RightMotor.Stop();
  LeftMotor.Disable();
  RightMotor.Disable();
  robot_state=false;

  block_move_bwd = false;
  block_move_fwd = false;

  autoAngle=false; // clear AUTO navigation
  autoPathplan = false;

  CarSpeedControl = 0;  //minimum speed
  set_status_of_car(0,0,0,0,1,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)

}

void run_fwd() // go forward
{

if (!block_move_fwd){
  LeftMotor.TurnRight(CarSpeedControl);    
  RightMotor.TurnRight(CarSpeedControl);
  set_status_of_car(1,0,0,0,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
}else{
  g_CarState = enSTOP;
  }


}


void brake()
{
  LeftMotor.Stop();
  RightMotor.Stop();
  set_status_of_car(0,0,0,0,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
  auto_number_pulseR=0;
  auto_number_pulseL=0;

  CarSpeedControl = 0;

}





void upleft() // car move fwd but turn left with different speed
{
  
  
  if (!block_move_fwd){

    if (fwd_status && !left_status){
    remember_speed = CarSpeedControl-30;
    if(remember_speed<0){remember_speed=0;}
    LeftMotor.TurnRight(remember_speed);     // speed >= 30  ;  Speed <=220;  
    RightMotor.TurnRight(CarSpeedControl);
    
    } 
    if (fwd_status&& left_status){
      if (remember_speed<CarSpeedControl-10){
      RightMotor.TurnRight(CarSpeedControl);
      }else{

        remember_speed = CarSpeedControl-30;
        if(remember_speed<0){remember_speed=0;}
        LeftMotor.TurnRight(remember_speed);
      }
    }
  set_status_of_car(1,0,1,0,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
  }else{
  g_CarState = enSTOP;
  }
}


void downleft()  // car move bwd but turn left with different speed
{
  if (!block_move_bwd){

    if (bwd_status && !left_status){
    remember_speed = CarSpeedControl-30;
    if(remember_speed<0){remember_speed=0;}
    LeftMotor.TurnLeft(remember_speed);    
    RightMotor.TurnLeft(CarSpeedControl);
    
    }
    if (bwd_status&& left_status){
      if (remember_speed<CarSpeedControl-10){
      RightMotor.TurnLeft(CarSpeedControl);
       }else{
         remember_speed = CarSpeedControl-30;
         if(remember_speed<0){remember_speed=0;}
        LeftMotor.TurnLeft(remember_speed);

      }
    }

    set_status_of_car(0,1,1,0,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)

  }else{
  g_CarState = enSTOP;
  }
}


void spin_left()
{
  LeftMotor.TurnLeft(CarSpeedControl);    
  RightMotor.TurnRight(CarSpeedControl);
  set_status_of_car(0,0,0,0,0,1,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)

}



void upright() // car move fwd but diff speed to turn right
{
  if (!block_move_fwd ){

      if (fwd_status && !right_status){
        remember_speed = CarSpeedControl-30;
    if(remember_speed<0){remember_speed=0;}
      LeftMotor.TurnRight(CarSpeedControl);    
      RightMotor.TurnRight(remember_speed);
      
      }

      if (fwd_status&& right_status){
        
          if (remember_speed<CarSpeedControl-10){
          LeftMotor.TurnRight(CarSpeedControl);
          }else{

          remember_speed = CarSpeedControl-30;
           if(remember_speed<0){remember_speed=0;}
          RightMotor.TurnRight(remember_speed);
          }
      }


    set_status_of_car(1,0,0,1,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)

  }else{
  g_CarState = enSTOP;
  }
}
   


void downright() // car move backward but turn right
{
  if (!block_move_bwd){

    if (bwd_status && !right_status){
        remember_speed = CarSpeedControl-30;
         if(remember_speed<0){remember_speed=0;}
        LeftMotor.TurnLeft(CarSpeedControl);    
        RightMotor.TurnLeft(remember_speed);
       
    }
    

      if (bwd_status&& right_status){
        
          if (remember_speed<CarSpeedControl-10){
          LeftMotor.TurnLeft(CarSpeedControl);
          }else{

          remember_speed = CarSpeedControl-30;
           if(remember_speed<0){remember_speed=0;}
          RightMotor.TurnLeft(remember_speed);
          }
      }

 set_status_of_car(0,1,0,1,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)



  }else{
  g_CarState = enSTOP;
  }
}



void spin_right()// Left motor run Fwd, right motor run Bwd
{
  set_status_of_car(0,0,0,0,0,0,1); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
  LeftMotor.TurnRight(CarSpeedControl);    
  RightMotor.TurnLeft(CarSpeedControl);
}


void back()
{
  if (!block_move_bwd){
  LeftMotor.TurnLeft(CarSpeedControl);    
  RightMotor.TurnLeft(CarSpeedControl);
  
  set_status_of_car(0,1,0,0,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
}else{
  g_CarState = enSTOP;
  }
}
//----------------------------------

void left() // car turn left while right motor is off, 
{
  /*
  LeftMotor.TurnRight(CarSpeedControl);  
      
  if ( CarSpeedControl>60 and CarSpeedControl<=140){  RightMotor.TurnLeft(40);   }
  else if ( CarSpeedControl>140 and CarSpeedControl<=200){  RightMotor.TurnLeft(50);   }
  else if ( CarSpeedControl>200){  RightMotor.TurnLeft(60);}
  
  else{ RightMotor.TurnLeft(30);};  //CarSpeedControl<60
  
  //RightMotor.Stop
  set_status_of_car(0,0,1,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
  */
spin_right();


}
//-------------------------------

void right()
{
  /*
 if ( CarSpeedControl>60 and CarSpeedControl<=140){  LeftMotor.TurnLeft(40);   }
  else if ( CarSpeedControl>140 and CarSpeedControl<=200){  LeftMotor.TurnLeft(50);   }
  else if ( CarSpeedControl>200){  LeftMotor.TurnLeft(60);}
  
  else{ LeftMotor.TurnLeft(30);};  //CarSpeedControl   <60

  RightMotor.TurnRight(CarSpeedControl);
  
  set_status_of_car(0,0,0,1,0,0,0); //(bool fwd,bool bwd, bool left, bool right, bool stopst)
*/
  spin_left();

}

void robotmovestatus(){

if (g_CarState==enSTOP)robot_move_status =0;
if (g_CarState==enRUN)robot_move_status =1;
if (g_CarState==enBACK)robot_move_status =2;
if (g_CarState==enLEFT)robot_move_status =3;
if (g_CarState==enRIGHT)robot_move_status =4;
if (g_CarState==enUPRIGHT)robot_move_status =5;
if (g_CarState==enUPLEFT)robot_move_status =6;
if (g_CarState==enDOWNLEFT)robot_move_status =7;
if (g_CarState==enDOWNRIGHT)robot_move_status =8;
if (g_CarState==enSpinRIGHT)robot_move_status =9;
if (g_CarState==enSpinLEFT)robot_move_status =10;
// 0: Stop, 1 fwd, 2, bwd, 3, left,4 right,5 upleft,6, upright,7,downleft, 8 downright,9 Spin left, 10 spin right.



if (M_volt<lowvolt_setpoint)low_volt_motor=true;else low_volt_motor=false;
if (Ctr_volt<lowvolt_setpoint)low_volt_ctr=true;else low_volt_ctr=false;
if (currentL>hcurrent_setpoint)L_Hcurrent=true;else L_Hcurrent=false;
if (currentR>hcurrent_setpoint)R_Hcurrent=true;else R_Hcurrent=false;


}
