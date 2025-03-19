
//---------------------
#include <WiFiManager.h> // https://github.com/tzapu/WiFiManager

unsigned int conn_restart_delay = 360000; //3600000 //ms, 1 hour
#define TRIGGER_PIN 0

unsigned int Count_time_to_clear_wifi =0;
bool enb_reset_wifi = false;
uint8_t counter_for_pin_reset=0;


int timeout = 600; // seconds to run for
 WiFiManager wm;

void wifi_configure(){
  
  //WiFi.mode(WIFI_STA); // explicitly set mode, esp defaults to STA+AP 
 
  bool res;
    
    res = wm.autoConnect("AutoConnectAP","password"); // password protected AP

    if(!res) {
        Serial.println("Failed to connect");
    } 
    else {
        Serial.println("connected...yeey :)");
    }
   


    pinMode(TRIGGER_PIN, INPUT_PULLUP);
}



void wifi_ondeman(){
 

    if ( Count_time_to_clear_wifi > 10) {
    wm.resetSettings();
    Serial.println("RESET WIFI SETTING");
    delay(2000);
    ESP.restart(); 
 
  }
}







//------------------

const char* serverIndex(){
  const char* page = "<!DOCTYPE html><html> <head><title> ESP robotcar configure</title> </head><body> <h1> Update Firmware for ESP</h1> <br> <form method='POST' action='/update' enctype='multipart/form-data'><input type='file' name='update'><input type='submit' value='Update'></form>  <br> <hr> <p>by xuan ky automation</p></body></html>";
  return page;
}

const char* update_html_success(){
  const char* page = "<!DOCTYPE html><html> <head><title> ESP robotcar configure</title> </head><body> <h3> Update Firmware for ESP</h3> <br>  <h2> Update firmware successfull , Well Done</h2> <br> <p>By Xuan Ky Automation></p> <br> <p> Return Home </p> <a href ='/'>Home </a> <br> <p> BACK: </p>  <a href ='/configure'>Config </a> </body></html> ";
  return page;
}

const char* update_html_fail(){
  const char* page = "<!DOCTYPE html><html> <head><title> ESP robotcar configure</title> </head><body> <h3> Update Firmware for ESP</h3> <br>  <h2> Update firmware </h2> <Fail Update, Please retry it> <p>By Xuan Ky Automation></p> <br> <p> Return Home </p> <a href ='/'>Home </a> <br> <p> BACK: </p>  <a href ='/configure'>Config </a> </body></html> ";
  return page;
}
  
