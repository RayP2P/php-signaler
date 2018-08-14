# php-signaler
## 介绍
php-signaler 是一个基于 [Workerman](https://github.com/walkor/Workerman "Workerman") 运行的信令服务器（适用于 [hlsjs-p2p-engine](https://github.com/cdnbye/hlsjs-p2p-engine "hlsjs-p2p-engine") 的信令服务）

Workerman 是使用纯PHP原生代码编写的高性能，异步处理的Socket框架。

使用 Workerman Gateway 可以既简单的部署集群式服务，方便横向扩展。

## 运行需求
1. PHP 5.3 或更高
2. 支持 POSIX 兼容的系统 (Linux, OSX, BSD)
3. PHP 安装了 POSIX 和 PCNTL 扩展

## 安装
关于系统环境，请参阅 [Workerman](http://www.workerman.net "Workerman") 的教程

下载Workerman Gateway 框架和主程序.(该源已集成框架)

	git clone https://github.com/RayP2P/php-signaler

## 配置

### 单机配置

仅需要更改 Applications/RayP2P/start_gateway.php 中的 SSL 证书的设置项

===集群式部署===
### 前端配置


1.更改 Applications/RayP2P/start_gateway.php 中的 SSL 证书的设置项

2.更改 Applications/RayP2P/start_gateway.php 中的  $gateway->lanIp 为内网IP（公网IP亦可）

3.[可选]如果需要部署多个Gateway，可单独配置 register 服务端。$gateway->registerAddress

### 后端配置

Applications/RayP2P/start_businessworker.php 

1.更改 Applications/RayP2P/start_businessworker.php 中的 $worker->registerAddress。

## 运行

1.在Debug模式中运行（退出前台将导致程序退出）.

	php php-signaler/start.php

2.在Deamon模式中运行（程序将在后台运行）.

	php php-signaler/start.php -d
	
3.运行前端服务（不含后端）

	php php-signaler/master.php -d
	
4.运行后端服务（仅后端）

	php php-signaler/cluster.php -d

## 配置播放器

1.更改信令服务器地址为您的信令服务器地址
### 范例
	var hlsjsConfig = {
        p2pConfig: {
            wsSignalerAddr: 'wss://example.com/ws',
        }
    };
更多播放器配置项请参阅 [hlsjs-p2p-engine API.md](https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/%E4%B8%AD%E6%96%87/API.md "hlsjs-p2p-engine API.md")
