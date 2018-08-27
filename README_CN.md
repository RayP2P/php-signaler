# php-signaler
## 介绍
php-signaler 是一个基于 [Workerman](https://github.com/walkor/Workerman "Workerman") 运行的信令服务器

适用于 [hlsjs-p2p-engine](https://github.com/cdnbye/hlsjs-p2p-engine "hlsjs-p2p-engine") 的信令服务

理论上适用于所有的WebRTC信令服务

Workerman 是使用纯PHP原生代码编写的高性能，异步处理的Socket框架。

使用 Workerman Gateway 可以简单的部署集群式服务，方便横向扩展。

## 运行需求
1. PHP 5.3 或更高
2. 支持 POSIX 兼容的系统 (Linux, OSX, BSD)
3. PHP 安装了 POSIX 和 PCNTL 扩展

## 安装
### CentOS

	yum install php-cli php-process git gcc php-devel php-pear libevent-devel -y

当你安装完成这些依赖后，已经可以正常运行本项目了
但是如果您需要提供高于1000个连接数的服务，请参阅 优化 篇章

### 优化

如果您使用的是 PHP 5.3.3, 只能安装 libevent 扩展.

	pecl install channel://pecl.php.net/libevent-0.1.0 
	
	//安装提示: "libevent installation [autodetect]:" 按回车
	
	echo extension=libevent.so > /etc/php.d/libevent.ini
	
如果您的PHP 版本大于 5.3.3, 安装 event 会更好.

	pecl install event
	
	//安装提示: Include libevent OpenSSL support [yes] : 输入 "no" 按回车
	
	//安装提示: PHP Namespace for all Event classes :输入 "yes" 按回车
	
	//其它的按回车即可.
	
	echo extension=event.so > /etc/php.d/event.ini
	
下载主程序. （请勿更新Workerman，官方版本的Workerman不支持RFC标准的心跳）

	git clone https://github.com/RayP2P/php-signaler

## 配置

您只需要关注于 [config.php](https://github.com/RayP2P/php-signaler/blob/master/config.php "config.php")
	
	//Gateway的内网IP.(公网IP也可以, 但并不推荐)
	'lanIP'=>'127.0.0.1',
	//Register 服务器地址
	'registerAddress'=>'127.0.0.1',
	//Register 监听端口
	'registerPort'=>1238,
	//Gateway 监听端口 [如果使用wss需要改成443]
	'gatewayPort'=>80,
	//使用wss还是ws协议，wss协议需要部署ssl
	'wss'=>false,
	//ssl的证书
	'wss_cert'=>'/root/server.crt',
	//ssl的私钥
	'wss_key'=>'/root/server.key',
	//Gateway 进程数量[推荐根据CPU核心数进行调整]
	'gatewayWorkers'=>4,
	//Worker 进程数量[推荐根据CPU核心数进行调整]
	'bussinessWorkers'=>4,

## 仅在一台服务器部署.
	
	php php-signaler/start_all.php
	
	//测试信令服务是否正常. 
	//如果测试通过，请添加 " -d" 指令来后台运行
	
	php php-signaler/start_all.php -d
	
## 集群模式部署.(至少2台服务器，推荐至少3台服务器部署)

	// 请保持所有服务器的config.php参数一致，lanIP除外
	// lanIP 是一个在部署Gateway服务器时 必须 修改的参数
	
	//1. 运行register服务.[整个集群仅需要部署1台]
	//该服务用于连接Gateway和Worker的协作，正常运行中将处于低负载状态
	
	php php-signaler/start_register.php
	
	//2. 运行worker服务.[当负载高于预期时，需要增加服务器]
	//该服务用于处理事务
	
	php php-signaler/start_worker.php
	
	//3. 运行gateway服务.[当负载高于预期时，需要增加服务器]
	//该服务用于维护用户的连接，需要有公网IP来提供服务 或者 内网转外网的负载均衡服务（具体查阅阿里云的负载均衡服务）
	
	php php-signaler/start_gateway.php
	
	//测试信令服务是否正常. 
	//如果测试通过，请添加 " -d" 指令来后台运行
	
	php php-signaler/start_register.php -d
	php php-signaler/start_worker.php -d
	php php-signaler/start_gateway.php -d
	
## 配置播放器

1.更改信令服务器地址为您的信令服务器地址
### 范例
	var hlsjsConfig = {
        p2pConfig: {
            wsSignalerAddr: 'wss://example.com/ws',
        }
    };
更多播放器配置项请参阅 [hlsjs-p2p-engine API.md](https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/%E4%B8%AD%E6%96%87/API.md "hlsjs-p2p-engine API.md")
