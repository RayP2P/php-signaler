# php-signaler

[中文文档](README_CN.md "中文文档")

## Introduction
This is a project build with [Workerman](https://github.com/walkor/Workerman "Workerman").
Cloud support [hlsjs-p2p-engine](https://github.com/cdnbye/hlsjs-p2p-engine "hlsjs-p2p-engine") signaler service.
Technically support all WebRTC signaler service.

Written in full pure PHP. High performance and support cluster.

## Requires
1. PHP 5.3 or Higher
2. A POSIX compatible operating system (Linux, OSX, BSD)
3. POSIX and PCNTL extensions for PHP

## Install
About enviroment, you can review the webpage from [Workerman](http://www.workerman.net "Workerman")
### CentOS

	yum install php-cli php-process git gcc php-devel php-pear libevent-devel -y

Basically this is already support you to run this project,but if you are face to more than 1000 connections, please read Optimize character.

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
	wait for update.
## Configure hlsjs-p2p-engine

1.Change the signal address to your address
### Example
	var hlsjsConfig = {
        p2pConfig: {
            wsSignalerAddr: 'wss://example.com/ws',
        }
    };
More info visit [hlsjs-p2p-engine API.md](https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/English/API.md "hlsjs-p2p-engine API.md")
