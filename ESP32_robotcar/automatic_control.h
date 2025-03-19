//float wheeldiameter = 35; // cm
//float wheellenght = 35*3.14; //cm = 109.9
//float Robotdiameter = 850 ;//cm
//float Robotlenght = 850*3.14; //cm
//float each_10deg =  Robotlenght/36;   //(0--360o)  resolution 10 degree

// 1 Each degree , Wheel need move 7.413cm,  Pules = 34.54 pulse  ,  Rontation = 0.0674 roation.
// 10 deg   , 74.13, 345.4 pulses , 0.674 rotation
//30 deg, 222.42 cm distance, 2.0238 Rotation,  Pulse = 1036.19 Pulses.
// 1 de 

SimpleTimer autoTimer ;

//--------------------------PID Control Motor Speed-----------












// -----------------Config motor--------------


void loop_automatic_control()
{
if ( abs(speedR_rpm)>0){  
    StaticJsonDocument<100> doc;//V6
    String msg;
    doc["pulseR"] = auto_number_pulseR;
    doc["pulseL"] = auto_number_pulseL;
    doc["autoPathplan"]=autoPathplan;
    doc["autoAngle"]=autoAngle;
    serializeJson(doc, msg);
    if (autoTimer.isReady()) {    
    client.publish("robotcar/feedback", msg.c_str());
    autoTimer.reset();
    }

}


if (autoPathplan){
  if(fwd_status){
      if (auto_number_pulseR >= Dist_Setpoint){
          brake();
      }
  }

    if(bwd_status){

    if (auto_number_pulseR <= Dist_Setpoint){
          brake();
      }
  }

if(spinleft_status){
    if (auto_number_pulseR >= Dist_Setpoint){
          brake();
      }
  }


if(spinright_status){
    if (auto_number_pulseR <= Dist_Setpoint){
          brake();
      }
  }



}
//--------------------------------------------------
if (autoAngle){
  if(auto_moveright){
    if (auto_number_pulseR <= AngleSetpoint){
        brake();
        Serial.println("number>setpoint spinright");
    }

  }else{
     if (auto_number_pulseR >= AngleSetpoint){
      Serial.println("Number<setpoint spinleft");
     brake();

  }
}
      



}



//if (pid_control_motor_speed){

//}
  
}



