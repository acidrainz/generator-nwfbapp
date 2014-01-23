<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {
	 
 	public function __construct()
	{
		parent::__construct(); 
		$this->load->library('session');
		
	}
	 
 	public function index() {	
	}
	
	public function registrants() {
		/*start search function*/
		$filter = false;
		$search_filters = '1';

		if(isset($_GET['filter']) ){

			foreach($_GET as $k => $v){
				if( $v!=''){
					$filter[$k] = $v;
				}
			}
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
		/*end search function*/

		$params = array('table' => 'tbl_registrants','where' => $search_filters);

		$data = $this->mysql_queries->get_data($params);
		$data = $this->validate_promo_joiners($data);
		$row  = array(); 
		
		if($data){ 
				$row[] = array( 'ID',
								'FBID',
								'FIRST NAME',
								'LAST NAME',
								'EMAIL',
								'REG DATE'
						);
               foreach($data as $k => $v)
			   { 
					extract($v);
			   		$row[] =  array($id,
									$fbid,
									$firstname,
									$lastname,
									$email,
									date('M d, Y', strtotime($timestamp))
							);
            	 } 
         }
		
		$this->load->library('to_excel_array');
    	$this->to_excel_array->to_excel($row, 'registrants_'.date("M-d-Y"));
	}

	public function entries() {
		/*start search function*/
		$search_filters = '1';

		//add the filters to 'where'(sql) statement
		$search_filters .= isset($filter['fbid']) ? " AND user_id LIKE '".$filter['fbid']."%'" : false;
		$search_filters .= isset($filter['author']) ? " AND author LIKE '%".$filter['author']."%'" : false;
		$search_filters .= isset($filter['hashtag']) ? " AND hashtag LIKE '".$filter['hashtag']."%'" : false;
		$search_filters .= isset($filter['source']) ? " AND source LIKE '".$filter['source']."%'" : false;
		$search_filters .= isset($filter['caption']) ? " AND caption LIKE '".$filter['caption']."%'" : false;
		$search_filters .= isset($filter['status']) ? " AND status='".$filter['status']."'" : false;
		$search_filters .= isset($filter['from'])  ? " AND date(timestamp) >= '".$filter['from']."'" : false;
		$search_filters .= isset($filter['to'])  ? " AND date(timestamp) <= '".$filter['to']."'" : false;

		/*end search function*/

		$params = array('table' => 'tbl_entries',
						'where' => $search_filters
						);

		$data = $this->mysql_queries->get_data($params);
		$row  = array(); 
		
		if($data){ 
				$row[] = array( 'ID',
				                'USERID',
				                'AUTHOR',
				                'CHALLENGE ID',
				                'HASHTAG',
				                'CAPTION',
				                'URL',
				                'STATUS',
				                'TIMESTAMP'
						);
               foreach($data as $k => $v)
			   { 
					extract($v);
			   		$row[] =  array($id,
					                $user_id,
					                $author,
					                $challenge_id,
					                $hashtag,
					                $caption,
					                $url_standard,
					                $status,
					                $timestamp
							);
            	 } 
         }
		
		$this->load->library('to_excel_array');
    	$this->to_excel_array->to_excel($row, 'entries_'.date("M-d-Y"));
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

}