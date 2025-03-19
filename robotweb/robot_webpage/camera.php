<!DOCTYPE html>
<html>
<head>
<title> Robot Data monitor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
 
<style>
.menu > a:link {
    position: absolute;
    display: inline-block;
    right: 12px;
    padding: 0 6px;
    text-decoration: none;
    }
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .0s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #326C88;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #326C88;
  cursor: pointer;
}

/* Rounded switch */

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider1 {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider1:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .2s;
  transition: .2s;
}

input:checked + .slider1 {
  background-color: #326C88;
}

input:focus + .slider1 {
  box-shadow: 0 0 1px #326C88;
}

input:checked + .slider1:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider1.round {
  border-radius: 34px;
}

.slider1.round:before {
  border-radius: 50%;
}
/*------------------Button----------------------*/
.led{
  font-weight : bold;
}

             ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;

        
                
              }

              li {
                float: left;
        width: 50%;
        text-align: center;   
              }

      
         h3{
              text-align: center;
              color: white;
              background-color:teal;
            padding:0px;
            margin: 0px;
              
              }
            h5{
              text-align: center;
              color: white;
              background-color:teal;
            padding:0px;
            margin: 0px;
              }

/*------------------NAV-----------------------*/
body {font-family: Arial, Helvetica, sans-serif;}

.navbar {
  width: 100%;
  background-color: #555;
  overflow: auto;
 
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #000;
}

.active {
  background-color: #4CAF50;
}

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
  }
  /*Progress Bar */
  .loadbar
    {
         width:50px;
         height:200px;
         background-color:#fff;
         border:1px solid #ccc;
         position:relative; 
		 left: 45%;
    }
    .bar
    {
        width:100%;
        display:block;        
        font-family:arial;
        font-size:12px; 
        background-color:#bb9319;
        color:#fff;       
        position:absolute;
        bottom:0px        
    }
  button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 10px;
  width:80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px
  }
  button:hover {
  background-color: blue;
	
	}
input {
   text-align :center;
   width: 60px;
   height: 20px;
   font-weight: bold;
   font-size: 16px;
   }
 .com{
	font-weight: bold;
    font-size: 16px;
   }
 

   body {
      min-width: 310px;
    	max-width: 100%;
    	height: 100%;
      margin: 0 auto;
   }
   
    h2 {
      font-family: Arial;
      font-size: 2.5rem;
      text-align: center;
    }

    .container{
      width: 50%;
      height: 5%;
      float :left;
    }
</style>
</head>
<body>


<div class="navbar">
      <div class="dropdown">
	
    <button class="dropbtn"style="font-size:20px"><i class="fa fa-bars"></i> Menu </button>
    <div class="dropdown-content" >
      <a class="active" href="/robotweb/index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
      <a class="fa fa-cog" aria-hidden="true" href="/robotweb/setup.html">  Setup</a>
      <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/datamonitor.html"> data</a>
       <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/wsdata.html"> wsdata</a>
       <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/map_control.html"> Mapcontrol</a>
     <a class="fa fa-credit-card" aria-hidden="true" href="/robotweb/mqttdata.html"> mqttdata</a>
     <a class="fa fa-address-book-o" aria-hidden="true" href="/robotweb/about.html"> About</a>
     <a class="fa fa-address-book-o" aria-hidden="true" href="/robotweb/help.html"> help</a>

	  
    </div>
</div>

<p style="color:tomato"> <i class="fa fa-fw fa-user"></i> XuankyAutomation| <span id="wifilogo"> <i class="fa fa-wifi" style="color: lime" aria-hidden="true"></i> </span>   <span id="wifirssi"> 0 </span>%</p>
</div>

<br>

<!-----------------MAIN PROGRAM-------------------->

<?php
  $serverIP = $_SERVER['SERVER_ADDR'];

  //echo $serverIP;

?>
<p>  <?php  $serverIP   ?>  </p>
  
  
  <h3>FRONT CAMERA MONITOR</h3>

  <iframe src=
" http://<?php echo $serverIP ?>:8000" 
          height="700px" width="1000px">
  </iframe>

<br>
<label> IP Local Network Remote Access ADDRESS</label> <br>
  <input id = "ip" type="text"  value = "http://<?php echo $serverIP ?>:8000"   placeholder="https://192.168.1.8" style="font-size:20px;color:blue;font-weight:bold; width: 500px" readonly> </input>






</body>


<script>


	


</script>
</html>

