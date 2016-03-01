<?php

$serv = new swoole_server("127.0.0.1", 9501);
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    sleep(10);
    $serv->send($fd, 'Swoole: '.$data);
});
$serv->start();