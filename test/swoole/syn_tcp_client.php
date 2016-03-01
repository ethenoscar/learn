<?php

/**
 *
 * 创建一个TCP的同步客户端，此客户端可以用于连接到我们第一个示例的TCP服务器。
 * 向服务器端发送一个hello world字符串，服务器会返回一个 Server: hello world字符串。
 *
 * 这个客户端是同步阻塞的，connect/send/recv 会等待IO完成后再返回。同步阻塞操作并不消耗CPU资源，
 * IO操作未完成当前进程会自动转入sleep模式，当IO完成后操作系统会唤醒当前进程，继续向下执行代码。
 *
 * - 如果建立连接到服务器需要100ms，那么$client->connect就会耗时100ms，因为TCP需要进行3次握手，所以connect至少需要3次网络通信。
 * - 在发送少量数据时$client->send都是可以立即返回的。发送大量数据时，socket缓存区可能会塞满，send操作会阻塞。
 * - recv操作会阻塞等待服务器返回数据，recv耗时等于服务器处理时间+网络传输耗时之合。
 * 
 */

$client = new swoole_client(SWOOLE_SOCK_TCP);

//连接到服务器
if (!$client->connect('127.0.0.1', 9501, 0.5))
{
    die("connect failed.");
}
//向服务器发送数据
if (!$client->send("hello world"))
{
    die("send failed.");
}
//从服务器接收数据
$data = $client->recv();
if (!$data)
{
    die("recv failed.");
}
echo $data;
//关闭连接
$client->close();