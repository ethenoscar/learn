<?php

/**
 * UDP服务器与TCP服务器不同，UDP没有连接的概念。
 * 启动Server后，客户端无需Connect，直接可以向Server监听的9502端口发送数据包。对应的事件为onPacket。
 *
 * - $clientInfo是客户端的相关信息，是一个数组，有客户端的IP和端口等内容
 * - 调用 $server->send 方法向客户端发送数据
 *
 * 执行程序 	: /usr/local/php5.3.29/bin/php udp_server.php
 * 查看端口占用 : sudo netstat -aq | grep 9502
 * 测试链接 	: netcat -u 127.0.0.1 9502
 * 
 */

//创建Server对象，监听 127.0.0.1:9502端口，类型为SWOOLE_SOCK_UDP
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP); 

//监听数据发送事件
$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
});

//启动服务器
$serv->start(); 