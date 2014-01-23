<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function __construct() {

		parent::__construct(); 
			$this->db1 = $this->load->database('actual', TRUE);
			$this->db2 = $this->load->database('birthday', TRUE);

	}
	 
	public function index() {
			
	}

	public function nuworks() {

		$results = $this->db2->get('tbl_clientcontacts')->result_array();
		$items = array();
			foreach($results as $k => $v) {
				$items['id'] = $v['id'];
			}

		print_r(json_encode($items));
		
	}

	public function client() {

		$results = $this->db2->get('tbl_clientcontacts')->result_array();
		$items = array();
			foreach($results as $result) {
				$items[] = $result;
			}
		echo json_encode($items);

	}
	
}

?>