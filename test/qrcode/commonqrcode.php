<?php

include '../../source/phpqrcode/qrlib.php';

$url = "http://www.baidu.com";

//1.普通输出一个链接的二维码的图片流
//QRcode::png($url);

//2.生成二维码图片
$exportPath = dirname(dirname(__DIR__)).'/public/imgs/temp/';
if(!is_dir($exportPath)) exit('Directory not exits!');
$fileName = 'test.png';
$filePath = $exportPath.$fileName;
/*
 * 容错率，也就是有被覆盖的区域还能识别
 * 可以是数组array('L','M','Q','H')中的一个,此处请按照下面的全称输入
 * L（QR_ECLEVEL_L，7%）,M（QR_ECLEVEL_M，15%）,Q（QR_ECLEVEL_Q，25%）,H（QR_ECLEVEL_H，30%）
 */
$level = QR_ECLEVEL_L;
$matrixPointSize = '3';//生成的图片大小
$margin = '2';//表示二维码周围边框空白区域间距值
$saveAndPrint = false;//$saveandprint表示是否保存二维码并显示
$outfile = false;//参数$outfile表示是否输出二维码图片 文件，默认否,如果输出图片，则为图片路径
if('' != $filePath) $outfile=$filePath;

//生成图片
//QRcode::png($url,$outfile,$level,$matrixPointSize,$margin,$saveAndPrint);//此时你会发现在指定的目录下面有一个二维码文件生成

//特别注意，最新版的代码中把saveAndPrint禁用了
//请将qrencode.php和phpqrcode里面的png返回改成这样return $enc->encodePNG($text, $outfile, $saveandprint);
//该方法在保存了图片的同时将图片流进行输出到请求
//QRcode::png($url,$outfile,$level,$matrixPointSize,$margin,true);//此时你会发现在指定的目录下面有一个二维码文件生成

//控制图片的容错率情况,也可以说是覆盖率,H为最容易识别
//QRcode::png($url,false,QR_ECLEVEL_L);
//QRcode::png($url,false,QR_ECLEVEL_M);
//QRcode::png($url,false,QR_ECLEVEL_Q);
//QRcode::png($url,false,QR_ECLEVEL_H);

//控制图片的大小
//QRcode::png($url,false,QR_ECLEVEL_L,3);
//QRcode::png($url,false,QR_ECLEVEL_L,6);

//控制图片margin量
//QRcode::png($url,false,QR_ECLEVEL_L,6,0);
//QRcode::png($url,false,QR_ECLEVEL_L,6,4);

