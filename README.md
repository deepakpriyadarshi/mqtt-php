## MQTT-PHP

## Library
This is a simple library to interact with the MQTT broker. This library is used to connect, publich message to a topic and subscribe to a topic from the MQTT broker.

## System Environment
- PHP minimum 5.6 or minimum 7.0

## Publisher

```
<?php

require 'MQTTPHP.php';


$server="";                                // MQTT broker server address (e.g.: mqtt.deepakpriyadarshi.com |OR| 13.214.25.124).
$port=1883;                                // MQTT broker port. By default it is 1883, but if you have changed it during setup you can write it here.
$username="";                              // Enter your username (If created a user in the MQTT broker).
$password="";                              // Enter your password (If created a user and set its password in the MQTT broker).
$client_id="deepak9405-publisher";         // Make sure this is unique for connecting to sever. You could use uniqid().
$topic="phpmqtt";                          // Topic to which data is need to be sent
$data="I am a PHP MQTT library";           // Data Need to be sent to the broker
$qos=0;                                    // QoS:  {0 | At most once}     {1 | At least once}     {2 | Only once}


$mqtt= new phpMQTT($server, $port, $client_id);

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
```

## Subscriber

```
<?php


require 'MQTTPHP.php';


$server="";                                // MQTT broker server address (e.g.: mqtt.deepakpriyadarshi.com |OR| 13.214.25.124).
$port=1883;                                // MQTT broker port. By default it is 1883, but if you have changed it during setup you can write it here.
$username="";                              // Enter your username (If created a user in the MQTT broker).
$password="";                              // Enter your password (If created a user and set its password in the MQTT broker).
$client_id="deepak9405-subscribe";         // Make sure this is unique for connecting to sever. You could use uniqid().
$topic="phpmqtt";                          // Topic from which data is to be received.
$qos=0;                                    // QoS:  {0 | At most once}     {1 | At least once}     {2 | Only once}


$mqtt = new phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password))
{
	exit(1);
}

$topics['air'] = array("qos" => $qos, "function" => "procmsg");

$mqtt->subscribe($topics, 0);

while($mqtt->proc()) { }

$mqtt->close();

function procmsg($topic, $msg)
{
	echo "Msg Recieved: " . date("r") . "\n";
	echo "Topic: {$topic}\n\n";
	echo "\t$msg\n\n";
}

procmsg();

?>
```
