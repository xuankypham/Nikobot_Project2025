
// Reading analoge value page
//----------------------------------CONVERT FLOAT to String-----------------------------------
String convertFloatToString(float Variable)
{ // begin function

  char temp[10];
  String tempAsString;
   
    // perform conversio7
    dtostrf(Variable,7,3,temp);
    
    // create string object
  tempAsString = String(temp);
  
  return tempAsString;
  
} // end function
//--------------------------------------------------------------------------------



void readvoltagesensor(){
// Voltage Sensor is connected with Pin ADC1, and ADC 2

float T_Ctr_volt = (analogReadMilliVolts(volt_ctr_pin)* 5.128)/1000; // Real voltage of equpipment READ MANUAL of Voltage Sensor
Ctr_volt= convertfloat(T_Ctr_volt);
float T_M_volt = (analogReadMilliVolts(volt_motor_pin)* 5.128)/1000; // Real voltage of equpipment
M_volt= convertfloat(T_M_volt);

//Serial.print("Control voltage: "); Serial.println(Ctr_volt,2);
//Serial.println(analogReadMilliVolts(1));
//Serial.print("Motor voltage: "); Serial.println(M_volt,2);
//Serial.println(analogReadMilliVolts(2));
/*
Voltage sensor:
If + =3.3V      Max Reading 16.5V
If + = 5V   .  Max Reading 25V
Measure  voltage                    Signal   (max 12bit 4095) 
5v                                        0.95V  / (1150)
3.3V             0.64
12V       2.28V
13.40v      2.57vdc
25V                    x = 4.75Vdc
*/

}

void readtemp_humidity(){
  /*
   * We Use 5Vdc Type, We need to connect with devider resistor     to conver 5V to 3.0 vdc
Humidity(%) 10  20  30  40  50  60  70  80  90
0~1V output 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.
0~3V output 0.3 0.6 0.9 1.2 1.5 1.8 2.1 2.4 2.7
0~3.3V output 0.33  0.66  0.99  1.32  1.65  1.98  2.31  2.64  2.97
0~5V output 0.5 1 1.5 2 2.5 3 3.5 4 4.5

Temperature (°C)  -10 0 10  20  30  40  50  60  70
0~1V output 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9
0~3V output 0.3 0.6 0.9 1.2 1.5 1.8 2.1 2.4 2.7
0~3.3V output 0.33  0.66  0.99  1.32  1.65  1.98  2.31  2.64  2.97
0~5V output 0.5 1 1.5 2 2.5 3 3.5 4 4.5

*/ 

  int mvolt_temp  = analogReadMilliVolts(temp_pin);  // Real Temperature value convert from Volt to temp (-20 to 70oc)
  int mvolt_humi = analogReadMilliVolts(humi_pin);     // Real value humidity  
// input is 500mv to 4500mv  (5vdc type) ; -10 to 70 I multifly 10 to -100 to 700, I can get temp Val 0 0.1 0.2 to 70.0
  temperature = map(mvolt_temp,330,2970,-100,700 )/10;   //ex: Voltage = 2207mv; Temp=24.2oC // 3vdc type sensor

  //temperature = map(mvolt_temp,500,4500,-100,700 )/10;   //ex: Voltage = 2207mv; Temp=24.2oC // 3vdc type sensor

  //Serial.print("Temperature: "); Serial.println(temperature,1);
  humidity = map(mvolt_humi,330,2970,10,90 );

  //humidity = map(mvolt_humi,500,4500,10,90 );

  //Serial.print("Humidity: "); Serial.println(humidity,1);

}
