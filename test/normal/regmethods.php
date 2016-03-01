<?php

//--------------------------------------------------------------------------------------------------
// 常用的正式表达式函数汇总说明
//--------------------------------------------------------------------------------------------------

//----------------------------- BEGIN : preg_match 和 preg_match_all -----------------------------------------

// preg_match($pattern,$subject[,array &$matches])
// preg_match_all($pattern,$subject,array &$matches)
// 这两个函数的第三个参数是引用传递，第一函数只会匹配符合条件的内容一次，而第二个函数会把所有符合条件的结果都匹配出来
// 两个函数都把匹配的结果放到第三个参数的matches中，而且两个参数都返回整型数据，表示匹配到的次数，0则表示没有匹配到

echo '------------- preg_match 和 preg_match_all ----------------<br/>';
$pattern = '/[0-9]/';//表示匹配0-9的数字
$subject = 'fgfdsgd8dfgdfgdf9788dfgdfg';
$m1 = $m2 = array();
$i1 = preg_match($pattern,$subject,$m1);// 1
$i2 = preg_match_all($pattern,$subject,$m2); // 5
echo '<br/>preg_match 返回: '.$i1.' <br/> preg_match_all 返回: '.$i2.'<br/>';
echo '<br/>preg_match 匹配值:<br/>';
print_r($m1); // Array ( [0] => 8 ) 
echo '<br/><br/>preg_match_all 匹配值:<br/>';
print_r($m2); // Array ( [0] => Array ( [0] => 8 [1] => 9 [2] => 7 [3] => 8 [4] => 8 ) ) 

//----------------------------- END   : preg_match 和 preg_match_all -----------------------------------------



//----------------------------- BEGIN : preg_replace 和 preg_filter -----------------------------------------

// preg_replace($pattern,$replacement,$subject)
// preg_filter($pattern,$replacement,$subject)
// 功能基本一致，只是返回结果有些许区别，跟str_replace基本一致，str_replace 是preg_replace子集
// preg_filter 只保留发生替换后的值，而preg_match　全部保留，主要体现在subject 为数组的情况

echo '<br/><br/>------------- preg_replace 和 preg_filter ----------------<br/>';
$pattern = '/[0-9]/';//表示匹配0-9的数字
$subject = 'fgfdsgd8dfgdfgdf9788dfgdfg';
$replacement = '女神';
$str1 = preg_replace($pattern,$replacement,$subject); // fgfdsgd女神dfgdfgdf女神女神女神女神dfgdfg
$str2 = preg_filter($pattern,$replacement,$subject); // fgfdsgd女神dfgdfgdf女神女神女神女神dfgdfg
echo '<br/>preg_replace 返回: '.$str1;
echo '<br/><br/>preg_filter 返回: '.$str2;

// preg_replace 也是支持数组替换的
echo '<br/><br/>进行数组替换:<br/>';
$pattern = array('/[0123]/','/[456]/','/[789]/');
$subject = 'fgfdsgd8dfg2fgdf9788dfgdfg';
$replacement = array('女','神','经');
$str1 = preg_replace($pattern,$replacement,$subject); // fgfdsgd经dfg女fgdf经经经经dfgdfg
$str2 = preg_filter($pattern,$replacement,$subject); // fgfdsgd经dfg女fgdf经经经经dfgdfg
echo '<br/>preg_replace 返回: '.$str1;
echo '<br/><br/>preg_filter 返回: '.$str2;

// 拆分subject
echo '<br/><br/>拆分subject为数组后替换:<br/>';
$subject = array('fgfdsg','d8dfg','2fgd','f978','8dfgdfg');
$pattern = array('/[0123]/','/[456]/','/[789]/');
$replacement = array('女','神','经');
$str1 = preg_replace($pattern,$replacement,$subject); // Array ( [0] => fgfdsg [1] => d经dfg [2] => 女fgd [3] => f经经经 [4] => 经dfgdfg ) 
$str2 = preg_filter($pattern,$replacement,$subject); // Array ( [1] => d经dfg [2] => 女fgd [3] => f经经经 [4] => 经dfgdfg )
echo '<br/>preg_replace 返回: <br/>';
print_r($str1);
echo '<br/><br/>preg_filter 返回: <br/>';
print_r($str2);



//----------------------------- END   : preg_replace 和 preg_filter -----------------------------------------


//----------------------------- BEGIN : preg_grep -----------------------------------------

// preg_grep($pattern,$subject)
// preg_grep 是阉割版的 preg_filter ，只做匹配功能，不做替换
echo '<br/><br/>------------- preg_grep ----------------<br/>';
$subject = array('fgfdsg','d8dfg','2fgd','f978','8dfgdfg');
$pattern = '/[0-9]/';//表示匹配0-9的数字
$arr = preg_grep($pattern,$subject); // Array ( [1] => d8dfg [2] => 2fgd [3] => f978 [4] => 8dfgdfg )
echo '<br/>只获取匹配到的值:<br/><br/>';
print_r($arr); 

//----------------------------- END   : preg_grep -----------------------------------------


//----------------------------- BEGIN : preg_split -----------------------------------------

// preg_split($pattern,$subject)
// 用匹配到的作为分隔点切割成函数，explode 是 preg_split 的子集
echo '<br/><br/>------------- preg_split ----------------<br/>';
$subject = '我2是3天使，8你敢约吗？';
$pattern = '/[0-9]/';
$arr = preg_split($pattern,$subject); // Array ( [0] => 我 [1] => 是 [2] => 天使， [3] => 你敢约吗？ )
echo '<br/>preg_split 返回如下:<br/>';
print_r($arr);

//----------------------------- END   : preg_split -----------------------------------------


//----------------------------- BEGIN : preg_quote -----------------------------------------

// preg_quote($str)
// 正则运算符转义
echo '<br/><br/>------------- preg_quote ----------------<br/>';
$str = 'qsdfsd{as}[1234]';
$str = preg_quote($str);
echo '<br/>转义结果为: '.$str;

//----------------------------- END   : preg_quote -----------------------------------------


