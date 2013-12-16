<?php
class Controller{
	
	function __construct(){
		$this->view = new View();
		$this->post = new Post();
	}
	function direct($url){
	    echo "<script type='text/javascript'>window.location='$url';</script>";
	}
	function useModel($file){
		$load= "models/".$file."_model.php";
		if(file_exists($load)){
			require $load;
			$file=str_pad($file, 0);
			$model=$file.'_Model';
			$this->model = new $model();
		}
	}
	function getModel($file){
		$load= "models/".$file."_model.php";
		if(file_exists($load)){
			require $load;
			$file=str_pad($file, 0);
			$model=$file.'_Model';
			$this->$file = new $model();
		}
	}
}