<?php
class Bootstrap {
	
	private $x=null;
	private $controller=null;
	
	private function geturl(){
		$x=isset($_GET['x'])?$_GET['x']:NULL;
		$x=rtrim($x,'/');
		$x=filter_var($x,FILTER_SANITIZE_URL);
		$this->x=explode('/', $x);
	}

	private function load($url){
		$file='controllers/'.$url.'.php';
		if (file_exists($file)) {
			require $file;
			$this->controller = new $url;
			$this->controller->useModel($url);
		}else{
			require 'controllers/index.php';
			$this->controller = new Index();
			$this->controller->useModel('index');
		}
	}
	private function methodcontroller(){

		$func = $this->x[1];
		array_shift($this->x);
		array_shift($this->x);

		if (!empty($this->x)) {
			call_user_func_array(array($this->controller,$func),$this->x);
		} elseif(method_exists($this->controller,$func)){
			$this->controller->{$func}();
		}

		if(!method_exists($this->controller,$func)){
			if(method_exists($this->controller,'index')){
				$this->controller->index();
			}else{
				$this->notfound($func);
			}
		}
	}

	function start() {
		$this->geturl();
		$this->load($this->x[0]);
		$this->methodcontroller();
	}

	private function notfound($data){
		echo "404<br>page ".$data." not found";
	}
}