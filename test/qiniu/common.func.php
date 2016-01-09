<?php


function log_msg($content,$destination,$log_type=1){
    $dirname = dirname($destination);
    if(!is_dir($dirname)){
        mkdir($dirname,0755,true);
    }
    switch($log_type){
        case 1://覆盖
            file_put_contents($destination,$content);
            break;
        case 2://追加
        default://追加
            file_put_contents($destination,$content,FILE_APPEND);
            break;
    }
    if(is_file($destination)){
        chmod($destination,0666);
    }
}