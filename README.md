# php-signaler

[中文文档](README_CN.md "中文文档")

## Introduction
This is a project build with [Workerman](https://github.com/walkor/Workerman "Workerman").

Cloud support [hlsjs-p2p-engine](https://github.com/cdnbye/hlsjs-p2p-engine "hlsjs-p2p-engine") signaler service.

Technically support all WebRTC signaler service.

Written in full pure PHP. High performance and support cluster.

## Free Public Signal Service

Websocket Address: wss://free.freesignal.net

We are maintain a public and free signal service for everybody.

Currently we use 

2 servers for gateway

2 servers for worker

1 server for register

We invite you to use our service, we will do the best as we can.

Websocket Address: wss://free.freesignal.net

## Requires
1. PHP 5.3 or Higher
2. A POSIX compatible operating system (Linux, OSX, BSD)
3. POSIX and PCNTL extensions for PHP

## Install
### CentOS

	yum install php-cli php-process git gcc php-devel php-pear libevent-devel -y

Basically this is already support you to run this project.
But if you are face to more than 1000 connections, please read Optimize character.

### Optimize

If you are using PHP 5.3.3, you can only install libevent extension.

	pecl install channel://pecl.php.net/libevent-0.1.0 
	
	//Attention: "libevent installation [autodetect]:" message Enter
	
	echo extension=libevent.so > /etc/php.d/libevent.ini
	
If your PHP version is higher than 5.3.3, install event extension will better.

	pecl install event
	
	//Attention: Include libevent OpenSSL support [yes] : type "no" then Enter，
	
	//Attention: PHP Namespace for all Event classes :type "yes" then Enter
	
	//Otherwise just Enter.
	
	echo extension=event.so > /etc/php.d/event.ini
	
Download programe. 

	git clone https://github.com/RayP2P/php-signaler

## Configure

all you need to focus is [config.php](https://github.com/RayP2P/php-signaler/blob/master/config.php "config.php")
	
	//Gateway LanIP,change it when you are using in cluster.(public IP is also could be use, but not suggested.)
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

## Run in single server.
	
	php php-signaler/start_all.php
	
	//test your signaler service. 
	//if the test is success, add " -d" argument to running the service in daemon mode.
	
	php php-signaler/start_all.php -d
	
## Run in cluster mode.(at least need 2 servers,suggest at least 3 servers.)

	// Keep all server have the same content in config.php expect "lanIP"
	// lanIP is only thing you must to change when you setting up Gateway Server.
	
	//1. run register server.[only need setup one server]
	//This server is connecting gateway and worker.it will just a low loadAvg server.
	
	php php-signaler/start_register.php
	
	//2. run worker server.[when the loadAvg is higher than expect, you need add more.]
	//This server is working to process all the logical.
	
	php php-signaler/start_worker.php
	
	//3. run gateway server.[when the loadAvg is higher than expect, you need add more.]
	//This server is face to user, it needs public IP address.
	
	php php-signaler/start_gateway.php
	
	//4. Finally , test your signaler service. 
	//if the test is success, add " -d" argument to running the service in daemon mode.
	
	php php-signaler/start_register.php -d
	php php-signaler/start_worker.php -d
	php php-signaler/start_gateway.php -d
	
## Configure hlsjs-p2p-engine

1.Change the signal address to your address
### Example
	var hlsjsConfig = {
        p2pConfig: {
            wsSignalerAddr: 'wss://example.com/ws',
        }
    };
More info visit [hlsjs-p2p-engine API.md](https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/English/API.md "hlsjs-p2p-engine API.md")
