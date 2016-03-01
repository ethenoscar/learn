<?php

/**
 * 在Server程序中如果需要执行一下很耗时的操作，比如一个聊天服务器发送广播，Web服务器中发送邮件。
 * 如果直接去执行这些函数就会阻塞当前进程，导致服务器响应变慢。
 *
 * Swoole提供了异步任务处理的功能，可以投递一个异步任务到TaskWorker进程池中执行，不影响当前请求的处理速度。
 *
 * 基于第一个TCP服务器，只需要增加onTask和onFinish2个事件回调函数即可。
 * 另外需要设置task进程数量，可以根据任务的耗时和任务量配置适量的task进程。
 *
 * 调用$serv->task()后，程序立即返回，继续向下执行代码。onTask回调函数Task进程池内被异步执行。
 * 执行完成后调用$serv->finish()返回结果。
 * finish操作是可选的，也可以不返回任何结果
 * 
 */

$serv = new swoole_server("127.0.0.1", 9501);

//设置异步任务的工作进程数量
$serv->set(array('task_worker_num' => 4));

//监听连接进入事件
$serv->on('connect', function ($serv, $fd) {  
    echo "Client: Connect.\n";
});

$serv->on('receive', function($serv, $fd, $from_id, $data) {
    //投递异步任务
    $task_id = $serv->task($data);
    echo "Dispath AsyncTask: id=$task_id\n";
});

//处理异步任务
$serv->on('task', function ($serv, $task_id, $from_id, $data) {
    echo "New AsyncTask[id=$task_id]".PHP_EOL;
    //返回任务执行的结果
    $serv->finish("$data -> OK");
});

//处理异步任务的结果
$serv->on('finish', function ($serv, $task_id, $data) {
    echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

$serv->start();