<?php
class Index extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();
		if(Session::get('log')==false) {
			Session::destroy();
			?><script type="text/javascript">window.location="<?php echo X.'login'?>"</script><?php
		}
	}
	function index(){
		$this->view->hai=$this->model->test();
		$today=date("Y-m-d", time());
		$this->view->date=$this->view->tanggal($today,true);
		$this->view->ok="asdas asdas asdrw podfntr gsdifs sodfnsfs ifsf";
		$this->view->render('index/index');
	}
	function read(){
		if (Session::get('role')!='owner') {
			?><script type="text/javascript">window.location="<?php echo X?>"</script><?php
		}else{
			$this->view->data=$this->model->read();
			$this->view->render('index/read');
		}
	}
	function coba($id=''){
		if (Session::get('role')!='owner'){
			?><script type="text/javascript">window.location="<?php echo X?>"</script><?php
		}else{
			if (isset($id)) {
				$this->view->data=$this->model->detail($id);
			}
			$this->view->render('index/cu');
		}
	}
	function delete($id){
		if (Session::get('role')!='owner') {
			?><script type="text/javascript">window.location="<?php echo X?>"</script><?php
		}else{
			$this->model->delete($id);
		}
	}
	function cu($id=''){
		if (Session::get('role')!='owner') {
			?><script type="text/javascript">window.location="<?php echo X?>"</script><?php
		}else{
			$this->model->cu($id);
		}
	}
	function logout(){
		Session::destroy();
		?><script type="text/javascript">window.location="<?php echo X.'login'?>"</script><?php
	}
}