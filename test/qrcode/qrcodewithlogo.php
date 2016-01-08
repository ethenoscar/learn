<?php

include '../../source/phpqrcode/qrlib.php';

//思路是先生成二维码图片，再往图片上面加入logo

$url = 'http://m.wukey.cn';
$exportPath = dirname(dirname(__DIR__)).'/public/imgs/temp/';
if(!is_dir($exportPath)) exit('Directory not exits!');
$fileName = 'test1.png';
$filePath = $exportPath.$fileName;
$level = QR_ECLEVEL_H;
$matrixPointSize = '5';//生成的图片大小
$margin = '1';//表示二维码周围边框空白区域间距值
$saveAndPrint = false;//$saveandprint表示是否保存二维码并显示
$logoPath = dirname(dirname(__DIR__)).'/public/imgs/baidu.jpg';
$withLogoPath =  dirname(dirname(__DIR__)).'/public/imgs/temp/logoqr.jpg';

//先生成二维码图片
QRcode::png($url,$filePath,$level,$matrixPointSize,$margin,$saveAndPrint);
if(!is_file($filePath)) exit('Qrcode creates failed !');

if($logoPath){
    $qr = imagecreatefromstring(file_get_contents($filePath));
    $logo = imagecreatefromstring(file_get_contents($logoPath));
    $qrWidth = imagesx($qr);//二维码宽度
    $qrHeight = imagesy($qr);//二维码高度
    $logoWidth = imagesx($logo);//logo宽度
    $logoHeight = imagesy($logo);//logo高度
    $logoQrWidth = $qrWidth/5;//logo要占用的宽度
    $scale = $logoWidth/$logoQrWidth;//二维码上面的logo和原来的logo大小比例
    $logoQrHeight = $logoHeight/$scale;//算出二维码上面的logo高度
    $fromWidth = ($qrWidth - $logoQrWidth) / 2;//计算出二维码logo的边距
    //重新组合图片并调整大小
    imagecopyresampled($qr, $logo, $fromWidth, $fromWidth, 0, 0, $logoQrWidth,$logoQrHeight,$logoWidth ,$logoHeight);
    imagepng($qr,$withLogoPath);
    header('Content-type: image/png');
    echo file_get_contents($withLogoPath);
}