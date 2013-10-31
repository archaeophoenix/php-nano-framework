<?php
class Person extends Controller{
	function __construct(){
		parent::__construct();
		Session::start();
		if(Session::get('log')==false) {
			Session::destroy();
			?><script type="text/javascript">window.location="<?php echo X.'login'?>"</script><?php
		}
	}
	function index(){
		echo 'Hello word';
	}
	function form($id = null){
		if (!empty($id)) {
			$this->view->data = $this->model->detail($id);
		}
		$this->view->render('person/cu');
	}
	function cu($id = null){
		$this->model->cu($id);
	}
}