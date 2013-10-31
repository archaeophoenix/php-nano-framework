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
		$url=count($this->x);
		if ($url > 1) {
			if(!method_exists($this->controller,$this->x[1])){
				$url=1;
			}
		}
		switch ($url) {
			case 6: $this->controller->{$this->x[1]}($this->x[2],$this->x[3],$this->x[4],$this->x[5]);
			break;			
			case 5: $this->controller->{$this->x[1]}($this->x[2],$this->x[3],$this->x[4]);
			break;
			case 4: $this->controller->{$this->x[1]}($this->x[2],$this->x[3]);
			break;
			case 3: $this->controller->{$this->x[1]}($this->x[2]);
			break;
			case 2: $this->controller->{$this->x[1]}();
			break;
			default: 
				if(method_exists($this->controller,'index')){
					$this->controller->index();
				}else{
					$this->notfound($url);
				}
			break;
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