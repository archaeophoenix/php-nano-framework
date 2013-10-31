<?php
class Login_Model extends Model{
	function __construct(){
		parent::__construct();
	}
	function logon(){

		$result=$this->db->one('users',"WHERE username = '$_POST[username]' AND password = '$_POST[password]' ",'role');
		if(!empty($result)){
			Session::start();
			Session::set('log',true);
			Session::set('role',$result['role']);
			?><script type="text/javascript">window.location="<?php echo X?>"</script><?php
		}else{
			?><script type="text/javascript">window.location="<?php echo X.'login'?>"</script><?php
		}
	}
}