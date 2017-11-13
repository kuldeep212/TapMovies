<?php
	$RecentMovie= array("Function"=>"RecentMovie");

	$data = json_encode($RecentMovie);

	require_once __DIR__ . '/vendor/autoload.php';

	use PhpAmqpLib\Connection\AMQPConnection;

	use PhpAmqpLib\Message\AMQPMessage;

	$connection = new AMQPConnection('10.0.2.15', 5672, 'admin', 'admin');

	$channel = $connection->channel();

	$channel->queue_declare('WWW_T_API', true, false, false, false);

	$msg = new AMQPMessage($data, array('delivery_mode' => 2));

	$channel->basic_publish($msg, '', 'WWW_T_API');

	$channel->close();

	$connection->close();

	include 'Webserver_API_T_WWW.php';
?>


