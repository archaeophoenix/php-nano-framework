<?php
class Valid{
	function __construct() {}
	function minlength($field,$valid){
		return (strlen($field) < $valid)? "length $field under $valid" : NULL ;
	}
	function maxlength($field,$valid){
		return (strlen($field) > $valid)? "length $field upper $valid" : NULL ;
	}

	function numeric($field){
		return (!is_numeric($field))? "$field must numeric" : NULL ;
	}
}