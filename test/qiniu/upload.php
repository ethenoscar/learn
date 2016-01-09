<?php

require '../../vendor/autoload.php';
require 'qiniu.conifg.php';
require 'common.func.php';

use Qiniu\Auth;//引入鉴权类
use Qiniu\Storage\UploadManager;//引用上传类

$accessKey = QINIU_AK;
$secretKey = QINIU_SK;
$zone = QINIU_ZONE;
//生成七牛认证对象
$auth = new Auth($accessKey, $secretKey);
//生成上传的token
$token = $auth->uploadToken($zone);
//要上传的文件路径
$filePath = '../../public/imgs/baidu.jpg';
//上传到七牛后保存的文件名
$destFileName = 'test.jpg';
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();
$result = $uploadMgr->putFile($token, $destFileName, $filePath);
list($ret, $err) = $result;

$logContent = "========= Get token ========\r\n";
$logContent .= "token : $token\r\n";
$logContent .= "========= Upload file ========\r\n";
$logContent .= "response : ".json_encode($result)." \r\n";
$logContent .= "result : ".json_encode($ret)."\r\n";
$logContent .= "error : ".json_encode($err)."\r\n\r\n";

log_msg($logContent,QINIU_LOG,2);

if(!$err){
    echo "<img src='http://".QINIU_DOMAIN."/{$destFileName}'/>";
}

/*
 * 还有很多图片处理功能，视频功能等
 */