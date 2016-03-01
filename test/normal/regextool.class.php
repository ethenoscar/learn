<?php

class regextool {

	private $_validate = array(
							'require' => '/.+/',
							'email' => '/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/',
							'url' => '/^(https?://)?(\w+\.)+[a-zA-Z]+$/',
							'currency' => '/^d+(\.\d+)?$/',
							'number' => '/^\d+$/',
							'zip' => '/^\d{6}$/',
							'integer' => '/^[-\+]?\d+$/',
							'double' => '/^[-\+]?\d+(\.\d+)?$/',
							'english' => '/^[a-zA-Z]+$/',
							'qq' => '/^\d{5,11}$/',
							'mobile' => '/^1[34578]\d{9}$/'
						);

	private $_returnMatchResult = false;

	private $_fixMode = null;

	private $_matches = array();

	private $_isMatch = false;

	public function __construct($returnMatchResult=false,$fixMode=null){
		$this->_returnMatchResult = $returnMatchResult;
		$this->_fixMode = $fixMode;
	}

	private function _regex($pattern,$subject){
		if(array_key_exists(strtolower($pattern), $this->_validate)){
			$pattern = $this->_validate[strtolower($pattern)].$this->_fixMode;
		}
		$this->_returnMatchResult ? 
			preg_match($pattern,$subject,$this->_matches) : 
			$this->_isMatch = preg_match($pattern, $subject) === 1;

		return $this->_getRegexResult();
	}

	private function _getRegexResult(){
		if($this->returnMatchResult){
			return $this->_matches;
		}
		return $this->_isMatch;
	}

	public function toggleReturnType($bool = null){
		if($bool === null){
			$this->_returnMatchResult = !$this->returnMatchResult;
		}else{
			$this->_returnMatchResult = is_bool($bool) ? $bool : (bool)$bool;
		}
	}

	public function setFixMode($fixMode){
		$this->_fixMode = $fixMode;
	}

}