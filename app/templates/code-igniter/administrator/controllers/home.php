<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();


	}

	public function index() {

		$data = array( 'title'			=> "Dashboard",
					   'main_content'	=> $this->main_content());
 		$this->load->view('main_template', $data);
	}

	public function main_content() {
		
		$start_date = '2013-04-22';
		$end_date = '2013-06-22';

		$weeks_count = $this->globals->get_weeks($start_date, $end_date);

		$params 	 = array('table' => 'tbl_registrants','fields' => 'count(fbid) as total');
		$items   	 = $this->mysql_queries->get_data($params);

		$registrants = array();
		$registrants['total'] = $items[0]['total'];
				
		for( $i=0 ; $i < sizeof($weeks_count); $i++ ){
			
			$params = array('table'  => 'tbl_registrants',
							'fields' => 'count(fbid) as total',
							'where'  => "date(timestamp) between '".$weeks_count[$i][0]."' AND '".$weeks_count[$i][1]."' ");
			$items   = $this->mysql_queries->get_data($params);
			if($items)  $registrants['weekly'][] = array($weeks_count[$i][0], $items[0]['total']);
			else $registrants['weekly'][] = array($weeks_count[$i][0], 0);
		}





		$params 	 = array('table' => 'tbl_entries','fields' => 'count(id) as total');
		$items   	 = $this->mysql_queries->get_data($params);

		$entries = array();
		$entries['total'] = $items[0]['total'];
				
		for( $i=0 ; $i < sizeof($weeks_count); $i++ ){
			
			$params = array('table'  => 'tbl_entries',
							'fields' => 'count(id) as total',
							'where'  => "date(timestamp) between '".$weeks_count[$i][0]."' AND '".$weeks_count[$i][1]."' ");
			$items   = $this->mysql_queries->get_data($params);
			if($items)  $entries['weekly'][] =array($weeks_count[$i][0], $items[0]['total']);
			else $entries['weekly'][] = array($weeks_count[$i][0], 0);
		}


		$data['user'] = $this->session->userdata('user_account');
		$data['registrants'] = $registrants;
		$data['entries'] = $entries;
		$main = $this->load->view('home-content', $data, TRUE);
		return $main;
	}

	public function _remap() {
		$this->index();
	}

}

?>
