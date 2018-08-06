# hlsjs-p2p-signaler
## Introduction
This is an object build with [Workerman](https://github.com/walkor/Workerman "Workerman") to support [hlsjs-p2p-engine](https://github.com/cdnbye/hlsjs-p2p-engine "hlsjs-p2p-engine") signaler service.

Written in full pure PHP. High performance and support cluster.

## Requires
1. PHP 5.3 or Higher
2. A POSIX compatible operating system (Linux, OSX, BSD)
3. POSIX and PCNTL extensions for PHP

## Install
About enviroment, you can review the webpage from [Workerman](http://www.workerman.com "Workerman")

1.Running in Debug mode.

    git clone https://github.com/RayP2P/hlsjs-p2p-signaler
	php hlsjs-p2p-signaler/start.php

2.Running in Daemon mode.

    git clone https://github.com/RayP2P/hlsjs-p2p-signaler
	php hlsjs-p2p-signaler/start.php -d
	
3.Running in Master mode.(exclude bussniess worker)

    git clone https://github.com/RayP2P/hlsjs-p2p-signaler
	php hlsjs-p2p-signaler/master.php -d
	
4.Running in Cluster mode.

    git clone https://github.com/RayP2P/hlsjs-p2p-signaler
	php hlsjs-p2p-signaler/cluster.php -d