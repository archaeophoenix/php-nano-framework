<?php
class Index extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();
		if(Session::get('log') == false) {
			Session::destroy();
			$this->direct(X.'login');
		}
	}
	function index(){
		$data['hai'] = $this->model->test();
		$today = date("Y-m-d", time());
		$data['date'] = $this->view->tanggal($today,true);
		$data['ok'] = "asdas asdas asdrw podfntr gsdifs sodfnsfs ifsf";
		$this->view->render('index/index',$data);
	}
	function read(){
		if (Session::get('role') != 'owner') {
			$this->direct(X);
		}else{
			$data['datas'] = $this->model->read();
			$this->view->render('index/read',$data);
		}
	}
	function coba($id = ''){
		if (Session::get('role') != 'owner'){
			$this->direct(X);
		}else{
			$data['data'] = (empty($id)) ? null : $this->model->detail($id);
			$this->view->render('index/cu',$data);
		}
	}
	function delete($id){
		if (Session::get('role') != 'owner') {
			$this->direct(X);
		}else{
			$this->model->delete($id);
		}
	}
	function cu($id=''){
		if (Session::get('role') != 'owner') {
			$this->direct(X);
		}else{
			$this->model->cu($id);
		}
	}
	function logout(){
		Session::destroy();
		$this->direct(X.'login');
	}
}