<?php
class Html{
	private $alltag = array();

	function __construct(){}

	function form($action = null, $enctype = false, $param = null){
		$enctype = ($enctype==true)? "enctype='multipart/form-data'" : null ;
		$tag = implode("<br>", $this->alltag);
		$form = "<form action='$action' method='post' $enctype $param>".$tag."</form>";
		echo $form;
	}
	function button($type, $name = null, $value = null, $param = null){
		$value = (empty($value)) ? null : "value='$value'";
		$this->alltag[] = "<input type='$type' name='$name' $value $param>";
	}
	function input($type, $name = null, $value = null, $param = null){
		$this->alltag[] = "<label>$name</label> &nbsp&nbsp&nbsp <input type='$type' name='$name' value='$value' $param>";
	}
	function select($name, $values = array(), $select = null, $param = null){
		$val = null;
		if (!empty($values)) {
			foreach ($values as $key => $value) {
				$selected = ($select==$value) ? "selected='selected'" : null ;
				$val.="<option value='$value' $selected >$key</option>";
			}
		}
		$select = "<label>$name</label> &nbsp&nbsp&nbsp <select name='$name' $param>$val</select>";
		$this->alltag[] = $select;
	}
	function radio($name, $values = array(), $check = null, $param = null){
		$radio = null;
		if (!empty($values)) {
			foreach ($values as $key => $value) {
				$checked = ($check==$value) ? "checked='checked'" : null ;
				$radio.="<input type='radio' name='$name' value='$value' $checked $param> <label>$key</label> &nbsp&nbsp&nbsp";
			}
		}
		$this->alltag[] = "<label>$name</label> &nbsp&nbsp&nbsp".$radio;
	}
	function checkbox($name, $values = array(), $check = null, $param = null){
		$checkbox = null;
		if (!empty($values)) {
			foreach ($values as $key => $value) {
				$checked = null;
				if (!empty($check)) {
					foreach ($check as $k => $val) {
						if($value==$val){ 
							$checked = "checked='checked'";
							break;
						}
					}
				}
				$checkbox.="<input type='checkbox' name='{$name}[]' value='$value' $checked $param> <label>$key</label> &nbsp&nbsp&nbsp";
			}
		}
		$this->alltag[] = "<label>$name</label> &nbsp&nbsp&nbsp".$checkbox;
	}
	function image($file, $param = null){
		echo "<img src='$file' $param>";
	}
	function css($file){
	    echo "<link rel='stylesheet' href=$file type='text/css'>";
	}
	function favicon($file){
	    echo "<link rel='shorcut icon' href=$file>";
	}
	function js($file,$script = null){
	    echo "<script type='text/javascript' src=$file>$script</script>";
	}
	function meta($name, $content) {
	    echo "<meta name='$name' content='$content'>";
	}
	function direct($url){
	    echo "<script type='text/javascript'>window.location='$url';</script>";
	}
	function get($index){
		return $this->alltag[$index];
	}
	// function (){}
}