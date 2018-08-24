<?php
$config = array(
	//Gateway LanIP,change it when you are using in cluster.
	'lanIP'=>'127.0.0.1',
	//Register Address
	'registerAddress'=>'127.0.0.1',
	//Register Listen Port
	'registerPort'=>1238,
	//Gateway Listen Port
	'gatewayPort'=>80,
	//using wss:// or ws://
	'wss'=>false,
	//wss cert
	'wss_cert'=>'/root/server.crt',
	//wss key
	'wss_key'=>'/root/server.key',
	//Gateway Workers
	'gatewayWorkers'=>4,
	//Bussiness Workers
	'bussinessWorkers'=>4,
);
?>