<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ajax extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct(); 
		$this->load->library('email');
	}
	
	function update(){
		extract($_POST);
		
		$where = isset($wherec) ? $wherec."='".$wheref."'" : false;
		
		$post = array();
				
		if(isset($items)){
			foreach($items as $k => $v){
				$post[$k]=$v;
			}
		}
		
		if($table=='challenge'){
			if($post['status']=='1'){
				$params = array('table' => 'tbl_'.$table,
						'where' => '1',
						'post'	=> array('status' => 0 ));
				$this->mysql_queries->update_data($params);	
			}
		} 

		$params = array('table' => 'tbl_'.$table,
						'where' => $where,
						'post'	=> $post);
		$this->mysql_queries->update_data($params);	
	}
	
	function delete(){
		extract($_POST);
		
		$params = 	array('table' => 'tbl_'.$table,
						  'field' => "id",
						  'value' => $id);
						
		$this->mysql_queries->delete_data($params);
	}

	function promojoiner(){

		$data = '?';
		foreach ($_POST as $k => $v) {
			$data .= $k.'='.$v.'&';
		}
		print_r(file_get_contents('http://nwshare.ph/internal-settings/admin/validate/deem'.$data));
	}

	
}

?>
