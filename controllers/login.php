<?php
class Login extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();
		if(Session::get('log')==true) {
			?><script type="text/javascript">window.location="<?php echo X?>"</script><?php
		}
	}
	function index(){
		$this->view->render('login/index');
	}
	function logon(){
		$this->model->logon();
	}
	function coba($data=''){
		echo "string ".$data;
	}
}