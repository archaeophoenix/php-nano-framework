<?php
class Index_Model extends Model{
	function __construct(){
		parent::__construct();
	}
	function test(){
		return $this->db->read('data');
	}
	function detail($id){
		return $this->db->one('users',"WHERE id = '$id'",'*');
	}
	function read(){
		return $this->db->read('users');
	}
	function delete($id){
		$id=intval($id);
		$this->db->delete('users',"id='{$id}' AND role != 'owner'");
		?><script type="text/javascript">window.location="<?php echo X.'index/read'?>"</script><?php
	}
	function cu($id=''){
		if (empty($id)) {
			$this->db->create('users');
		}else{
			if (!empty($_POST['password'])) {
				$this->post->set('password');
			}
			$this->post->set('id',$id);
			$this->post->set('username');
			$this->post->set('role');
			$data = $this->post->get();
			$this->db->update('users','id=:id',$data);
		}
		?><script type="text/javascript">window.location="<?php echo X.'index/read'?>"</script><?php
	}
}