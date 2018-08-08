# php-signaler

[中文文档](README_CN.md "中文文档")

## Introduction
This is a project build with [Workerman](https://github.com/walkor/Workerman "Workerman") to support [hlsjs-p2p-engine](https://github.com/cdnbye/hlsjs-p2p-engine "hlsjs-p2p-engine") signaler service.

Written in full pure PHP. High performance and support cluster.

## Requires
1. PHP 5.3 or Higher
2. A POSIX compatible operating system (Linux, OSX, BSD)
3. POSIX and PCNTL extensions for PHP

## Install
About enviroment, you can review the webpage from [Workerman](http://www.workerman.net "Workerman")

Download programe. 

	git clone https://github.com/RayP2P/php-signaler

## Configure

### Full package

Don't really need to change anything. 
You just need to change the ssl settings in Applications/RayP2P/start_gateway.php

### Master

Applications/RayP2P/start_gateway.php 

1.Change the ssl settings. 

2.Change the $gateway->lanIp to Lan interface IP. 


### Cluster

Applications/RayP2P/start_businessworker.php 

1.Change $worker->registerAddress To Register IP. 

## Running as service

1.Running in Debug mode.

	php php-signaler/start.php

2.Running in Daemon mode.

	php php-signaler/start.php -d
	
3.Running in Master mode.(exclude bussniess worker)

	php php-signaler/master.php -d
	
4.Running in Cluster mode.(only bussniess worker)

	php php-signaler/cluster.php -d

## Configure hlsjs-p2p-engine

1.Change the signal address to your address
### Example
	var hlsjsConfig = {
        p2pConfig: {
            wsSignalerAddr: 'wss://example.com/ws',
        }
    };
More info visit [hlsjs-p2p-engine API.md](https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/English/API.md "hlsjs-p2p-engine API.md")