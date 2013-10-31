<?php
class Person_Model extends Model{
	function __construct(){
		parent::__construct();
	}
	function detail($id){
		return $this->db->one('person',"WHERE id = '$id'",'*');
	}
	function cu($id = null){
		$this->post->set('id',$id);
		$this->post->set('nama');
		$this->post->set('alamat');
		$this->post->set('tanggal');
		$this->post->set('kelamin');
		$data = $this->post->get();
		$data['tanggal'] = date("Y-m-d",strtotime($this->post->get('tanggal')));
		$this->post->set('photo1');
		$photo1=$this->post->get('photo1');
		if (!empty($_FILES['photo']['name'])) {
			if(!empty($id)){
				if(file_exists($photo1)){
					unlink($photo1);
				}
			}
			$photo = $this->db->upload('photo',"gambar");
			$data['photo'] = "gambar/".$photo['name'];
		}
		if (empty($id)) {
			$this->db->create('person',$data);
		} else {
			$this->db->update('person','id = :id',$data);
		}
	}
	function read(){
		return $this->db->read('person');
	}
}