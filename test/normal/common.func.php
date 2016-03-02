<?php


/**
 * 判断是否手机号码
 * @param  string  $mobile    手机号码
 * @param  boolean $with_code 是否带有区号
 * @return boolean         
 */
function is_mobile($mobile,$with_code=false){
	$pattern = '/^1[34578]\d{9}$/';
	if($with_code){
		$pattern = '/^((\(\d{2,3}\))|(\d{3}\-))?1[34578]\d{9}$/';
	}
	return is_meet_pattern($pattern,$mobile);
}

/**
 * 是否固定电话
 * @param  string  $telephone 固定电话
 * @return boolean            
 */
function is_telephone($telephone){
	$pattern = '/^((\+?[0-9]{2,4}\-[0-9]{3,4}\-)|([0-9]{3,4}\-))?([0-9]{7,8})(\-[0-9]+)?$/';
	return is_meet_pattern($pattern,$telephone);
}

/**
 * 判断是否邮箱地址
 * @param  string  $email 邮箱地址
 * @return boolean        
 */
function is_email($email){
	$pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
	return is_meet_pattern($pattern,$email);
}

/**
 * 判断是否是url地址
 * @param  string  $url url链接
 * @return boolean      
 */
function is_url($url){
	$pattern = '/^(https?://)?(\w+\.)+[a-zA-Z]+$/';
	return is_meet_pattern($pattern,$url);
}

/**
 * 判断是否正整数
 * @param  string  $integer   整数
 * @param  boolean $with_zero 是否包含0
 * @return boolean            
 */
function is_positive_int($integer,$with_zero=false){
	$pattern = '/^[0-9]*[1-9][0-9]*$/';
	if($with_zero){
		$pattern = '/^\d+$/';
	}
	return is_meet_pattern($pattern,$integer);
}

/**
 * 判断是否负整数
 * @param  string  $integer    整数
 * @param  boolean $witch_zero 是否包含0
 * @return boolean             
 */
function is_negetive_int($integer,$witch_zero=false){
	$pattern = '/^-[0-9]*[1-9][0-9]*$/';
	if($with_zero){
		$pattern = '^((-\d+)|(0+))$';
	}
	return is_meet_pattern($pattern,$integer);
}

/**
 * 判断是否腾讯qq
 * @param  string  $qq qq号码
 * @return boolean     
 */
function is_qq($qq){
	$pattern = '/^[1-9][0-9]{4,}$/';
	return is_meet_pattern($pattern,$qq);
}

/**
 * 判断是否符合某个正则表达式
 * @param  string  $pattern 正则表达式内容
 * @param  string  $subject 检验的主体
 * @return boolean          
 */
function is_meet_pattern($pattern,$subject){
	return preg_match($pattern,$subject) === 1;
}

