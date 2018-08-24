<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;

// 自动加载类
require_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config.php';


// gateway 进程，这里使用Text协议，可以用telnet测试
if($config['wss']){
	$context = array(
		'ssl' => array(
			'local_cert'                 => $config['cert'],
			'local_pk'                   => $config['key'],
			'verify_peer'                => false,
			// 'allow_self_signed' => true, //If you are using self signed certification. please remove the comment.
		)
	);
	$gateway = new Gateway("websocket://0.0.0.0:{$config['gatewayPort']}",$context);
	$gateway->transport = 'ssl';
}else{
	$gateway = new Gateway("websocket://0.0.0.0:{$config['gatewayPort']}");
}
// gateway名称，status方便查看
$gateway->name = 'Signaler GateWay';
// gateway进程数
$gateway->count = $config['gatewayWorkers'];
// 本机ip，分布式部署时使用内网ip
$gateway->lanIp = $config['lanIP'];
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口 
$gateway->startPort = 2900;
// 服务注册地址
$gateway->registerAddress = $config['registerAddress'].':'.$config['registerPort'];
// 心跳间隔
$gateway->pingInterval = 10;
// RFC格式心跳
$gateway->pingRfc = true;
// 心跳无响应限制
$gateway->pingNotResponseLimit = 0;
// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

