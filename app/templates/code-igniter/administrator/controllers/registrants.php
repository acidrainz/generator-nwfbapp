<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrants extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct(); 
	}
	 
	public function index() {
		$data = array( 'title'			=> "Registrants",
					   'main_content'	=> $this->main_content());
 		$this->load->view('main_template', $data);		
	}
	
	public function main_content() {
		$limit 	 = isset($_GET['psize']) ? $_GET['psize'] : 15;
		$curpage = $this->uri->segment(3, 1);
		$offset  = ($curpage-1)*$limit;
		$paging  = 3;
		
		/*start search function*/
		$filter = false;
		$search_filters = '1';

		if( isset($_GET['search']) || isset($_GET['filter']) ){

			foreach($_GET as $k => $v){
				if( $v!=''){
					$filter[$k] = $v;
				}
			}

			//reset pagination by redirecting to page 1
			if(isset($filter['search']))
			{
				/* 
				'search' is the trigger for reseting ng pagination
				we unset 'search' to avoid inifinite redirect and add
				'filter' to the array to retrigger the search
				*/
				unset($filter['search']);
				$filter['filter']=1;

				//here goes the reset
				redirect('registrants/index/1'.'?'.http_build_query($filter, '', "&"), 'location');
			}
			else
			{
				//add the filters to 'where'(sql) statement
				$search_filters .= isset($filter['fbid']) ? " AND fbid LIKE '".$filter['fbid']."%'" : false;
				$search_filters .= isset($filter['name']) ? " AND concat(lname,', ',fname) LIKE '%".$filter['name']."%'" : false;
				$search_filters .= isset($filter['gender']) ? " AND gender LIKE '".$filter['gender']."%'" : false;
				$search_filters .= isset($filter['bmonth']) ? " AND month(birthdate) = '".$filter['bmonth']."'" : false;
				$search_filters .= isset($filter['email']) ? " AND email LIKE '%".$filter['email']."%'" : false;
				$search_filters .= isset($filter['mobile']) ? " AND mobile LIKE '".$filter['mobile']."%'" : false;
				$search_filters .= isset($filter['address']) ? " AND address LIKE '".$filter['address']."%'" : false;
				$search_filters .= isset($filter['from'])  ? " AND date(timestamp) >= '".$filter['from']."'" : false;
				$search_filters .= isset($filter['to'])  ? " AND date(timestamp) <= '".$filter['to']."'" : false;

			}

		}
		/*end search function*/

		$params = array('table' => 'tbl_registrants',
						'fields' => '*, concat(lname,", ",fname) as name',
						'where' => $search_filters,
						'offset'=> $offset,
						'limit' => $limit
						);

		$registrants = $this->mysql_queries->get_data($params);

		$params = array('table' => 'tbl_registrants','where' => $search_filters);
		$totalrows = $this->mysql_queries->get_data($params);

		$registrants = $this->validate_promo_joiners($registrants);
		

		$data = array('registrants' => $registrants,
					  'total'	=> sizeof($totalrows),
					  'pagination'	=> $this->globals->pagination(sizeof($totalrows), $curpage ,site_url('registrants/index'), $paging, $limit)
					);

		$main = $this->load->view('registrants-content', $data, TRUE);
		return $main;
	}
	
	function validate_promo_joiners($registrants){
		set_time_limit(0);
		ini_set('memory_limit', '512M');

		if($registrants){
			
			$result =  json_decode(file_get_contents('http://nwshare.ph/internal-settings/admin/validate/get_ids'),true);

			foreach ($registrants as $key => $val)
			{	
				if( in_array($val['fbid'], $result) ){
					$registrants[$key]['joiner'] = 1; 
				}else{
					$registrants[$key]['joiner'] = 0; 
				}
				
			}

			return $registrants;
		}
		else{
			return false;
		}
	}

	public function _remap() {
		$this->index();
	}
}

?>