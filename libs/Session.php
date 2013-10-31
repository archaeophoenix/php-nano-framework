<?php
class Session{
	function __construct(){
	}
	public static function start(){
		@session_start();
	}
	public static function set($key,$val){
		$_SESSION[$key]=$val;
	}
	public static function get($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}
	}
	public static function unsession(){
		session_unset();
	}
	public static function destroy(){
		session_destroy();
	}
}