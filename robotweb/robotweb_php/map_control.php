<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Robot Car GoogleMap control</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/map_control.css"/>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draggable Markers with Heading, Distance, and Lines</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>



    <script src="js/mqttws31.js" type="text/javascript"></script>
    <script type = "text/javascript"  src = "js/jquery-3.7.1.min.js"></script>

   <script type = "text/javascript"  src = "js/mqtt_index.js"></script>




    <style>
        #map {
            height: 500px;
        }
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }
    </style>



</head>
<body>
    <ul>
        <li><a class="active" href="/robotweb/index.php"><i class="fa fa-fw fa-home"></i> Home</a> </li>
        <li><a class="fa fa-cog" aria-hidden="true" href="/robotweb/setup.php">  Setup</a></li>
        <li><a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/datamonitor.php">LineChart</a></li>
        <li><a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/wsdata.php"> wsdata</a></li>
        
        <li><a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/map_control.php"> Mapcontrol</a></li>
        <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/mysqllogenb.php"> mysqllogenb</a>
        <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/robotdata.php"> RobotData</a>
        <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/autocontrol.php "> Autocontrol</a>

        <li><a class="fa fa-address-book-o" aria-hidden="true" href="/robotweb/about.php"> About</a></li>
        <li> <a class="fa fa-address-book-o" aria-hidden="true" href="/robotweb/help.php"> help</a> </li>





      </ul>




   
  </div>
      
  </div>


  <h2>Control Robot Car with Draggable Markers BY Xuan Ky Automation</h2> 
  <button onclick = "createMarkers_car(1)"> Get Current Position</button> 
  <button onclick="setnavigationplan()" > Set Navigation Plan</button>

  <label for="markerCount">Select Number of Markers: </label>
  <select id="markerCount">
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
  </select>
  
  <div id="map"></div>
  
  <table id="headingTable">
      <thead>
          <tr>
              <th>Marker</th>
              <th>Position (LAT, LON)</th>
              <th>Heading (degrees)</th>
              <th>Distance (meters)</th>
          </tr>
      </thead>
      <tbody>
          <!-- Dynamic rows will appear here -->
          <tr class="marker-row">
              <td>Marker 1</td>
              <td id="marker1-position">Loading...</td>
              <td id="marker1-heading">N/A</td>
              <td id="marker1-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 2</td>
              <td id="marker2-position">Loading...</td>
              <td id="marker2-heading">N/A</td>
              <td id="marker2-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 3</td>
              <td id="marker3-position">Loading...</td>
              <td id="marker3-heading">N/A</td>
              <td id="marker3-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 4</td>
              <td id="marker4-position">Loading...</td>
              <td id="marker4-heading">N/A</td>
              <td id="marker4-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 5</td>
              <td id="marker5-position">Loading...</td>
              <td id="marker5-heading">N/A</td>
              <td id="marker5-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 6</td>
              <td id="marker6-position">Loading...</td>
              <td id="marker6-heading">N/A</td>
              <td id="marker6-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 7</td>
              <td id="marker7-position">Loading...</td>
              <td id="marker7-heading">N/A</td>
              <td id="marker7-distance">N/A</td>
          </tr>
          <tr class="marker-row">
              <td>Marker 8</td>
              <td id="marker8-position">Loading...</td>
              <td id="marker8-heading">N/A</td>
              <td id="marker8-distance">N/A</td>
          </tr>
      </tbody>
  </table>
  










<p> Data Auto Navigation send to ESP32 Controller</p>
<textarea id ="data_test" style="width: 100%;">  data </textarea>




<div>

    <h1>MQTT Monitor Robot car data</h1>
      
    <script type = "text/javascript">
  //ll
  
  </script>
  
  
  <div id="status">Connection Status: Not Connected</div> <br>
  <button  onclick="display_mqtt()" style="width :200px ; background-color: gray; height: 50;"> ShowOrHideMQTT_SET</button>
  <br><br>
  
  
  
  
  <div id="mqttset_dis" style="display: none;">
  <fieldset style = "width: 330px; background-color: #f5eeee;">
  <legend>SETUP PARAMETER FIELD</legend>
    
  
  <form name="connform" action="" onsubmit="return MQTTconnect()">
    <fieldset>
    
    <legend>Mqtt Setup</legend>
  <table>
   <tr><td>MqttBroker*</td>    
   <td style="width: 400px" ><input style="font-size:15px"type="text" name="server"  size="30" maxlength="30" autofocus="autofocus" placeholder= "Mqtt Broker" value="broker.emqx.io" > </td></tr>
  
   <tr><td>Port*</td>
     <td><input style="font-size:15px; width : 170px;" type="number" name="port"   value="8083"></td></tr>
  
     <tr><td>Clean Session*</td> 
      <td><input style="font-size:15px; width : 170px;" type="checkbox" name="clean_sessions"  value="true" checked></td></tr>
  
    
   <tr><td>UserName*</td>
   <td><input style="font-size:15px"type="text" name="username" size="18" maxlength="30"placeholder= "MqttUsername" value="robot"></td></tr>
   <tr><td>Password*</td>    
   <td><input style="font-size:15px"type="password" name="password" size="18" maxlength="10" placeholder="Password" value="123456"></td></tr>
   <td><hr> </td>
     <td><hr> </td>
  
     <tr><td><input name="conn" type="submit" value="Connect">  </td> 
     <td><input TYPE="button" name="discon " value="DisConnect" onclick="disconnect()">  </td>  </tr>
    
   
  
  </table>
  </fieldset>
  </form>
  
  
  <form name="subs" action="" onsubmit="return sub_topics()">
  <fieldset>
  
  <legend>TOPIC Sub Setup</legend>
  <table>
  <tr><td>Subscribe Topic*</td>    
  <td><input style="font-size:15px"type="text" name="Stopic" value = "robotcar/feedback"  size="18" maxlength="20" autofocus="autofocus" > </td></tr>
  
  <tr><td>Subscribe QOS*</td>
   <td><input style="font-size:15px; width : 170px;" type="text" name="sqos" value="0"></td></tr>
  
   <tr><td>Clean Session*</td>
    <td><input style="font-size:15px; width : 170px;" type="checkbox" name="clean_sessions"  value="true" checked></td></tr>
  
  
  <tr><td>Submit*</td>
  <td><input type="submit" value="Subscribe" id = "autoclick_button"></td></tr>
     
  
  
  </table>
  </fieldset>
  </form>
  
  
  <form name="smessage" action="" onsubmit="return send_message()">
  <fieldset>
  
  <legend>TOPIC Pub Setup</legend>
  <table>
  <tr><td>Message*</td>    
  <td><input style="font-size:15px"type="text" name="message" value = ""  size="18" maxlength="20" autofocus="autofocus" > </td></tr>
  
  <tr><td>Publish Topic:*</td>
   <td><input style="font-size:15px; width : 170px;" type="text" name="Ptopic" value="robotcar/control"></td></tr>
  
   <tr><td>Publish QOS:*</td>
    <td><input style="font-size:15px; width : 170px;" type="text" name="pqos" value="0"></td></tr>
  
  
  
  
    <tr><td>Retain Message*</td>
      <td><input style="font-size:15px; width : 170px;" type="checkbox" name="retain" value="true"></td></tr>
  
          
  <tr><td>Submit*</td>
  <td><input type="submit" value="Submit"></td></tr>
     
  
  
  </table>
  </fieldset>
  </form>
  
  
  </fieldset>
  
  
  
  </div>
  
  <div id ="mqtt_area">
  
    Status Messages:
    <div id="status_messages">
    </div>
    <br> <hr>
    Received Messages:
    
    <label> DATA FROM MQTT</label>
  
    <textarea id="out_messages"  style="width: 100%;">  </textarea>
    
    
    </div>
  
  
  <label> feedback</label>
  <p id="demo" >  </p>
  <p id="demo1" style="visibility: hidden"> test </p>
  <input type= "checkbox" id = "mqttmode" value ="mqtt" checked hidden> 
  
  
  <hr> </hr>
  <footer style ="text-align : center; color: blue"> CopyRight:phamxuanky82@gmail.com; <br>Zalo: 0985510900 ;Date:24/11/2024 </footer>





  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <script>


        modemqtt = document.getElementById("mqttmode");


      let map = L.map('map').setView([-37.7861, 175.2900], 18); // Hamilton East, New Zealand
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  
      let markers = [];
   
      let markerCountSelect = document.getElementById("markerCount");
      let headingTableBody = document.querySelector("#headingTable tbody");
      let polyline;
      let returnLine;
  
      // Function to calculate heading from two points
      function calculateHeading(lat1, lon1, lat2, lon2) {
          let dLon = lon2 - lon1;
          let y = Math.sin(dLon) * Math.cos(lat2);
          let x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dLon);
          let heading = Math.atan2(y, x);
          heading = (heading * 180 / Math.PI + 360) % 360; // Convert to degrees and normalize
          return heading.toFixed(2); // Return heading with two decimals
      }
  
      // Function to calculate distance between two points (in meters)
      function calculateDistance(lat1, lon1, lat2, lon2) {
          let R = 6371e3; // Earth radius in meters
          let φ1 = lat1 * Math.PI / 180;
          let φ2 = lat2 * Math.PI / 180;
          let Δφ = (lat2 - lat1) * Math.PI / 180;
          let Δλ = (lon2 - lon1) * Math.PI / 180;
  
          let a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                  Math.cos(φ1) * Math.cos(φ2) *
                  Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
          let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
          let distance = R * c; // Distance in meters
          return distance.toFixed(2);
      }
  
      // Function to update table with headings, distances, and positions

    



      function updateTable() {

        
        
        
        for (let i = 0; i < markers.length - 1; i++) {
              let lat1 = markers[i].getLatLng().lat;
              let lon1 = markers[i].getLatLng().lng;
              let lat2 = markers[i + 1].getLatLng().lat;
              let lon2 = markers[i + 1].getLatLng().lng;
              let heading = calculateHeading(lat1, lon1, lat2, lon2);
              let distance = calculateDistance(lat1, lon1, lat2, lon2);


              // Update marker positions and headings in the table
              document.getElementById(`marker${i + 1}-position`).textContent = `${lat1.toFixed(10)}, ${lon1.toFixed(10)}`;
              document.getElementById(`marker${i + 2}-position`).textContent = `${lat2.toFixed(10)}, ${lon2.toFixed(10)}`;
              document.getElementById(`marker${i + 1}-heading`).textContent = heading;
              document.getElementById(`marker${i + 2}-heading`).textContent = heading;
              document.getElementById(`marker${i + 1}-distance`).textContent = distance;
              document.getElementById(`marker${i + 2}-distance`).textContent = distance;
        }

        
  
          // For the last marker, display its position (LAT, LON)
          let lastMarker = markers[markers.length - 1];
          let lastLat = lastMarker.getLatLng().lat;
          let lastLon = lastMarker.getLatLng().lng;
          document.getElementById(`marker${markers.length}-position`).textContent = `${lastLat.toFixed(14)}, ${lastLon.toFixed(14)}`;
  
          // Calculate heading and distance from last marker to the first marker
          if (markers.length > 1) {
              let firstMarker = markers[0];
              let firstLat = firstMarker.getLatLng().lat;
              let firstLon = firstMarker.getLatLng().lng;
              let lastHeading = calculateHeading(lastLat, lastLon, firstLat, firstLon);
              let lastDistance = calculateDistance(lastLat, lastLon, firstLat, firstLon);
              
              // Update last marker table with the circular heading and distance
              document.getElementById(`marker${markers.length}-heading`).textContent = lastHeading;
              document.getElementById(`marker${markers.length}-distance`).textContent = lastDistance;
          }
      }
  
      function setnavigationplan(){

        var data_nav_lat =[];
        var data_nav_lon =[];
        var data_nav_heading =[];
        var data_nav_distance =[];


        var marker_num =     parseInt(document.getElementById("markerCount").value);

        
        

        for(let i=1; i<marker_num+1; i++){
            
            data_nav_heading.push( parseFloat(document.getElementById(`marker${i}-heading`).textContent));
            data_nav_distance.push(parseFloat(document.getElementById(`marker${i}-distance`).textContent));



            var latlon_str = document.getElementById(`marker${i}-position`).textContent ;
            // find the "," and extract string

            let pos = latlon_str.indexOf(",");
            let lat = latlon_str.substr(0, pos);
            let lon = latlon_str.substr(pos+1);
            data_nav_lat.push(parseFloat(lat));
            data_nav_lon.push(parseFloat(lon));



        }

        var data_send_json = {"auto_nav": 1, "lat": data_nav_lat,"lon":data_nav_lon,"heading": data_nav_heading,"distance":data_nav_distance};

        var data_send_string = JSON.stringify(data_send_json); //String
        
        document.getElementById("data_test").value = data_send_string;

        send_message_mqtt(data_send_string);



      }












      // Function to update polyline (line connecting all markers)
      function updatePolyline() {
          let latLngs = markers.map(marker => marker.getLatLng());
          if (polyline) {
              polyline.setLatLngs(latLngs); // Update the existing polyline with new marker positions
          } else {
              polyline = L.polyline(latLngs, { color: 'blue' }).addTo(map); // Create new polyline if none exists
          }
  
          // Add a line from the last marker to the first marker to complete the loop
          if (markers.length > 1) {
              let firstLatLon = markers[0].getLatLng();
              let lastLatLon = markers[markers.length - 1].getLatLng();
              if (returnLine) {
                  returnLine.setLatLngs([firstLatLon, lastLatLon]); // Update the return line
              } else {
                  returnLine = L.polyline([firstLatLon, lastLatLon], { color: 'red' }).addTo(map); // Create a new return line
              }
          }
      }
  
      // Function to create markers
      function createMarkers(count) {
          // Remove markers if their count changes
          let currentCount = markers.length;
  
          // Remove excess markers if there are fewer markers
          if (count < currentCount) {
              for (let i = count; i < currentCount; i++) {
                  markers[i].remove();
              }
              markers = markers.slice(0, count); // Adjust the markers array to the new count
          }
  
          // Add new markers if there are more markers
          for (let i = currentCount; i < count; i++) {   //
              let lat = -37.7861 + (i * 0.0005); // Spread markers around Hamilton East
              let lon = 175.2900 + (i * 0.0005);
              let marker = L.marker([lat, lon], { draggable: true }).addTo(map);
              marker.bindPopup(`Marker ${i + 1}`);
  
              // Add marker names as labels
              marker.bindTooltip(`Marker ${i + 1}`, { permanent: true, direction: 'top' }).openTooltip();
  
              // Update the table and headings when marker is moved
              marker.on('moveend', function () {
                  updateTable(); // Update table after marker move
                  updatePolyline(); // Update polyline after marker move
              });
  
              markers.push(marker);
          }
  
          // Update polyline and table after adding/removing markers
          updatePolyline();
          updateTable();
  
          // Show or hide table rows based on the selected marker count
          for (let i = 0; i < 8; i++) {
              let row = headingTableBody.rows[i];
              if (i < count) {
                  row.style.display = ""; // Show row
              } else {
                  row.style.display = "none"; // Hide row
              }
          }
      }
  
      // Event listener for marker count change
      markerCountSelect.addEventListener('change', function () {
          let selectedCount = parseInt(markerCountSelect.value);
          createMarkers(selectedCount);
      });
  
      // Initialize with 2 markers
      createMarkers(2);





//-------------Create a Marker for CAR Navigation------------

   // Add a marker for the car
   let carMarker = L.marker([-37.7872, 175.2903], { draggable: false }).addTo(map);
        //carMarker.bindPopup("Car Position").openPopup();
        carMarker.bindTooltip(`Car Position`, { permanent: true, direction: 'top' }).openTooltip();
     

function extractdata(data){
    var jsonObject = JSON.parse(data);
    
 
  if ('gpslat' in jsonObject) {

var lat = jsonObject.gpslat;
var lon = jsonObject.gpslon;
//var gps_kmh = jsonObject.gpsspeed_kmh;
//var gps_ms = jsonObject.gpsspeed_ms;

if (lat!= 0.0 || lon!=0.0 ){

    // Update car marker position
carMarker.setLatLng([lat, lon]);
// Pan the map to the car's new position
map.panTo([lat, lon]);
console.log(`Car position updated to Lat: ${lat}, Lon: ${lon}`);
}else{
    //alert("GPS Signal Lost");
    document.getElementById("demo").textContent = "GPS Signal lost";
}



  }
    
    

}




  </script>



<script>


  var connected_flag=0	;
  var mqtt;
  var reconnectTimeout = 2000;
  var host="localhost";
  var port=9001;
  var row=0;
  var out_msg="";
  var mcount=0;


  window.onload = MQTTconnect();
  

  // Auto Subscribe, Auto Click Button Subscribe
  const button = document.getElementById('autoclick_button');
  function autoClick() {
	

	  button.click(); // Triggers the button's click event

	clearTimeout(myTimeout);
   
  }

	 
  const myTimeout = setTimeout(autoClick, 1000);


</script>







</body>
</html>
