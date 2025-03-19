#include <TinyGPSPlus.h>
static const uint32_t GPSBaud = 9600;
// The TinyGPSPlus object
TinyGPSPlus gps;

// For stats that happen every 5 seconds



void gps_receiveData(){
  // Dispatch incoming characters
  while (Serial2.available() > 0)
    gps.encode(Serial2.read());

  if (gps.location.isUpdated())
  {
    gps_status = true;
    gps_lat = gps.location.lat();
    gps_lon = gps.location.lng();
    
    //Serial.print(F("LOCATION:   Lat=")); Serial.print(gps.location.lat(), 8);  Serial.print(F(" Long=")); Serial.println(gps.location.lng(), 8);
  }

  else if (gps.date.isUpdated())
  {
    //Serial.print(F("DATE   =")); Serial.print(F(" Year=")); Serial.print(gps.date.year()); Serial.print(F(" Month=")); Serial.print(gps.date.month()); 
    //Serial.print(F(" Day="));    Serial.println(gps.date.day());
   
  gpsday =  gps.date.day();
  gpsmonth =  gps.date.month();
  gpsyear= gps.date.year();
  }

  else if (gps.time.isUpdated())
  {
    //Serial.print(F("TIME:  "));  Serial.print(F(" Hour="));  Serial.print(gps.time.hour()); Serial.print(F(" Minute="));
    //Serial.print(gps.time.minute());   Serial.print(F(" Second="));  Serial.println(gps.time.second());
    gpshour=gps.time.hour();
    gpsmin= gps.time.minute();
    gpssec= gps.time.second();
  }

  else if (gps.speed.isUpdated())
  {
    //Serial.print(F("SPEED:=  "));  Serial.print(F(" m/s="));  Serial.print(gps.speed.mps());     Serial.print(F(" km/h=")); Serial.println(gps.speed.kmph());
    gpsspeed_kmh = gps.speed.kmph();
    gpsspeed_ms =gps.speed.mps();
  
  }

 
  else if (millis() - last > 5000)
  {
   
    if (gps.location.isValid())
    {
      
      gpsdistance =
        TinyGPSPlus::distanceBetween(
          gps.location.lat(),
          gps.location.lng(),
          end_pos_lat, 
          end_pos_lon);

      //Serial.print(F("gpsdistance Move:  "));  Serial.print(gpsdistance/1000, 6); Serial.println(F(" km"));  Serial.println("----------------------------");
    }
   
    if (gps.charsProcessed() < 10)
    //Serial.println(F("WARNING: No GPS data.  Check wiring."));
    gps_status = false;

    last = millis();
  }

  
}
