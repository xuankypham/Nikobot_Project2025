  
unsigned long  time_intval;
unsigned long LastTime;
unsigned long Interval_safety;

void safety_volt_current_action(){

  if (currentR >25 || currentL>25|| Ctr_volt <9 || M_volt<9) {
    time_intval = millis();
    Interval_safety = time_intval-LastTime;
    if (Interval_safety >= 5000)  //5 sec
    {
      LastTime = time_intval;
      g_CarState = enSTOP; // Car will be stop when MQTT connection fail

    }
  }


}
 

