
//---------------MQTT------------------------


	function onConnectionLost(){
	console.log("connection lost");
	document.getElementById("status").innerHTML = "Connection Lost";
	document.getElementById("status_messages").innerHTML ="Connection Lost";
	document.getElementById("status").style.backgroundColor='red';
	connected_flag=0;
	}
	function onFailure(message) {
		console.log("Failed");
		document.getElementById("status_messages").innerHTML = "Connection Failed- Retrying";
        setTimeout(MQTTconnect, reconnectTimeout);
        }
	
	
	//---------------------------------------------------------
	
		function onMessageArrived(r_message){

        out_msg= r_message.payloadString;
		//out_msg="Message received "+r_message.payloadString;
		//out_msg=out_msg+"      Topic "+r_message.destinationName +"<br/>";
		//out_msg="<b>"+out_msg+"</b>";
		//console.log(out_msg+row);
		try{
			document.getElementById("out_messages").innerHTML=out_msg;

			if (modemqtt.checked){
				//document.getElementById("out_messages").innerHTML=out_msg;
				extractdata(out_msg);


			}



		}
		catch(err){
		document.getElementById("out_messages").innerHTML=err.message;
		}
	
		

		}

		//------------------------------------------------------------
		
	function onConnected(recon,url){
	console.log(" in onConnected " +reconn);
	}
	function onConnect() {
	  // Once a connection has been made, make a subscription and send a message.
	document.getElementById("status_messages").innerHTML ="Connected to "+ host +" on port "+port;
	connected_flag=1;
	document.getElementById("status").innerHTML = "MQTT Connected Successfull";
	document.getElementById("status").style.backgroundColor='green';
	console.log("on Connect "+connected_flag);

	  }
	  function disconnect()
	  {
		if (connected_flag==1)
			mqtt.disconnect();
	  }

    function MQTTconnect() {
	var clean_sessions=document.forms["connform"]["clean_sessions"].value;
	var user_name=document.forms["connform"]["username"].value;
	console.log("clean= "+clean_sessions);
	var password=document.forms["connform"]["password"].value;
	
	if (clean_sessions=document.forms["connform"]["clean_sessions"].checked)
		clean_sessions=true
	else
		clean_sessions=false

	document.getElementById("status_messages").innerHTML ="";
	var s = document.forms["connform"]["server"].value;
	var p = document.forms["connform"]["port"].value;
	if (p!="")
	{
		port=parseInt(p);
		}
	if (s!="")
	{
		host=s;
		console.log("host");
		}

	console.log("connecting to "+ host +" "+ port +"clean session="+clean_sessions);
	console.log("user "+user_name);
	document.getElementById("status_messages").innerHTML='connecting';
	var x=Math.floor(Math.random() * 10000); 
	var cname="orderform-"+x;
	mqtt = new Paho.MQTT.Client(host,port,cname);
	//document.write("connecting to "+ host);
	var options = {
        timeout: 3,
		cleanSession: clean_sessions,
		onSuccess: onConnect,
		onFailure: onFailure,
      
     };
	 if (user_name !="")
		options.userName=document.forms["connform"]["username"].value;
	if (password !="")
		options.password=document.forms["connform"]["password"].value;
	
        mqtt.onConnectionLost = onConnectionLost;
        mqtt.onMessageArrived = onMessageArrived;
		mqtt.onConnected = onConnected;

	mqtt.connect(options);

    

	return false;
  
 
	}
	function sub_topics(){
		document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		out_msg="<b>Not Connected so can't subscribe</b>"
		console.log(out_msg);
		document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
	var stopic= document.forms["subs"]["Stopic"].value;
	console.log("here");
	var sqos=parseInt(document.forms["subs"]["sqos"].value);
	if (sqos>2)
		sqos=0;
	console.log("Subscribing to topic ="+stopic +" QOS " +sqos);
	document.getElementById("status_messages").innerHTML = "Subscribing to topic ="+stopic;
	var soptions={
	qos:sqos,
	};
	mqtt.subscribe(stopic,soptions);


	return false;
	}
	function send_message(){
		document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		out_msg="<b>Not Connected so can't send</b>"
		console.log(out_msg);
		document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
		var pqos=parseInt(document.forms["smessage"]["pqos"].value);
		if (pqos>2)
			pqos=0;
		var msg = document.forms["smessage"]["message"].value;
		console.log(msg);
		document.getElementById("status_messages").innerHTML="Sending message  "+msg;

		var topic = document.forms["smessage"]["Ptopic"].value;
		//var retain_message = document.forms["smessage"]["retain"].value;
		if (document.forms["smessage"]["retain"].checked)
			retain_flag=true;
		else
			retain_flag=false;
		message = new Paho.MQTT.Message(msg);
		if (topic=="")
			message.destinationName = "test-topic";
		else
			message.destinationName = topic;
		message.qos=pqos;
		message.retained=retain_flag;
		mqtt.send(message);
		return false;
	}


  


	function send_message_mqtt(message_sent ){
		//document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		//out_msg="<b>Not Connected so can't send</b>"
		//console.log(out_msg);
		//document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
		var pqos=parseInt(document.forms["smessage"]["pqos"].value);
		if (pqos>2)
			pqos=0;
		var msg =   message_sent;  //document.forms["smessage"]["message"].value;
		//console.log(msg);
		//document.getElementById("status_messages").innerHTML="Sending message  "+msg;

		var topic = document.forms["smessage"]["Ptopic"].value;
		//var retain_message = document.forms["smessage"]["retain"].value;
		if (document.forms["smessage"]["retain"].checked)
			retain_flag=true;
		else
			retain_flag=false;
		message = new Paho.MQTT.Message(msg);
		if (topic=="")
			message.destinationName = "test-topic";
		else
		message.destinationName = topic;
		message.qos=pqos;
		message.retained=retain_flag;
		mqtt.send(message);
		return false;
	}












         function display_mqtt() {
            var x = document.getElementById("mqttset_dis");
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
          }

    