<?php

require 'MQTTPHP.php';


$server="35.154.123.96";                                // MQTT broker server address (e.g.: mqtt.deepakpriyadarshi.com |OR| 13.214.25.124).
$port=1883;                                // MQTT broker port. By default it is 1883, but if you have changed it during setup you can write it here.
$username="";                              // Enter your username (If created a user in the MQTT broker).
$password="";                              // Enter your password (If created a user and set its password in the MQTT broker).
$client_id="deepak9405-publisher";         // Make sure this is unique for connecting to sever. You could use uniqid().
$topic="mqttphp";                          // Topic to which data is need to be sent
$data="I am a PHP MQTT library";           // Data Need to be sent to the broker
$qos=0;                                    // QoS:  {0 | At most once}     {1 | At least once}     {2 | Only once}


$mqtt= new mqttPHP($server, $port, $client_id);

if ($mqtt->connect(true, NULL, $username, $password))
{
	$mqtt->publish($topic, $data, $qos);
	$mqtt->close();

	echo "Data Sent";
}
else
{
    echo "Time out!\n";
}

?>