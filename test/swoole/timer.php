<?php

/**
 * swoole提供了类似JavaScript的setInterval/setTimeout异步高精度定时器，粒度为毫秒级。使用也非常简单。
 *
 * - swoole_timer_tick函数就相当于setInterval，是持续触发的
 * - swoole_timer_after函数相当于setTimeout，仅在约定的时间触发一次
 * - swoole_timer_tick/swoole_timer_after函数会返回一个整数，表示定时器的ID
 * - 可以使用 swoole_timer_clear 清除此定时器，参数为定时器ID
 * 
 */


$i = 0;

//每隔2000ms触发一次
swoole_timer_tick(2000, function ($timer_id) {
	global $i;
	if($i == 4){
		swoole_timer_clear($timer_id);
		echo "关闭循环计时器\n";
		return;
	}
	++$i;
    echo "tick-2000ms\n";
});

//3000秒后执行此函数
swoole_timer_after(3000, function () {
    echo "after 3000ms.\n";
});