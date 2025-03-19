//---------------------------------Ultrasonic Sensor

//-----------------------------------
void setup_ultrasonic(){

  pinMode(trigPin1, OUTPUT);//Fwd
  pinMode(echoPin1, INPUT);
  
  pinMode(trigPin2, OUTPUT); // Aft
  pinMode(echoPin2, INPUT);
}
//---------------------------

void run_ultrasonicsensor(){
  // FWD Sensor
  digitalWrite(trigPin1, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin1, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin1, LOW);

  duration1 = pulseIn(echoPin1, HIGH);
  fwd_distance = (duration1*.0343)/2;
  //Serial.print("fwd_distance: ");
  //Serial.println(fwd_distance);
  //-------------------------AFT sensor
  digitalWrite(trigPin2, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin2, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin2, LOW);

  duration2 = pulseIn(echoPin2, HIGH);
  aft_distance = (duration2*.0343)/2;
  //Serial.print("aft_distance: ");
  //Serial.println(aft_distance);

}


unsigned long  time_intval1;
unsigned long LastTime1;
unsigned long Interval_safety1;

unsigned long  time_intval2;
unsigned long LastTime2;
unsigned long Interval_safety2;


//------------------------------------------------
void safety_distance_ultrasonic(){

if (enb_stop_fwdsensor   ){

if (robot_move_status!=2  &&  fwd_distance <=dist_safe*100){   //  80 cm
 
    //time_intval1 = millis();
    //Interval_safety1 = time_intval1-LastTime1;
    //if (Interval_safety1 >= 1000)  //1 sec
    //{
      //LastTime1 = time_intval1;
      // Block Moving Forward, upleft, upright
       block_move_fwd = true;
      g_CarState = enSTOP;
   // }else{ block_move_fwd = false;  }

}
if (fwd_distance > dist_safe*100 ){
  block_move_fwd = false;
}


}

//--------------------------------------------------------------------
if (enb_stop_aftsensor   ){

if (robot_move_status!=1  &&  aft_distance <=dist_safe*100){   // 80 cm

    //time_intval2 = millis();
    //Interval_safety2 = time_intval2-LastTime2;
    //if (Interval_safety2 >= 1000)  //1 sec
    //{
      
      //LastTime2 = time_intval2;
       // Block Moving backward, downleft, downright
    block_move_bwd = true;
    g_CarState = enSTOP;
}
    //}else{ block_move_bwd = false ; }

    if (aft_distance > dist_safe*100 ){
      block_move_bwd = false;

}

}


}
