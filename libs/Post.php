<?php
class Post{
	
	private $item  = null;
	private $post  = array();
	private $error = array();
	
	function __construct(){
		$this->valid = new Valid();
	}

	function set($field,$value = null){
		$this->post[$field]= (is_null($value)) ? $_POST[$field] : $value;
		$this->item=$field;
		return $this;
	}

	function get($field = false){
		return ($field) ? $this->post[$field] : $this->post ;
	}

	function valid($validator,$valid = null){
		$error=null;
		if(is_null($valid)){
			$error=$this->valid->{$validator}($this->post[$this->item]);
		} else {
			$error=$this->valid->{$validator}($this->post[$this->item],$valid);
		}
		if ($error) {
			$this->error[$this->item] = $error;
		}
		return $this;
	}
	function exception(){
		if (!empty($this->error)){
			return true;
		}
	}
}