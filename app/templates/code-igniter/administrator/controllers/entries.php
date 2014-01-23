<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entries extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct(); 
	}
	 
	public function index() {
		$data = array( 'title'			=> "Entries",
					   'main_content'	=> $this->main_content());
 		$this->load->view('main_template', $data);		
	}
	
	public function main_content(){

		$limit 	 = isset($_GET['psize']) ? $_GET['psize'] : 15;
		$curpage = $this->uri->segment(3, 1);
		$offset  = ($curpage-1)*$limit;
		$paging  = 3;
		
		/*start search function*/
		$filter = false;
		$search_filters = '1';

		if( isset($_GET['search'])|| isset($_GET['filter']) ){

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
				redirect('entries/index/1'.'?'.http_build_query($filter, '', "&"), 'location');
			}
			else
			{
				//add the filters to 'where'(sql) statement
				$search_filters .= isset($filter['fbid']) ? " AND user_id LIKE '".$filter['fbid']."%'" : false;
				$search_filters .= isset($filter['author']) ? " AND author LIKE '%".$filter['author']."%'" : false;
				$search_filters .= isset($filter['hashtag']) ? " AND hashtag LIKE '".$filter['hashtag']."%'" : false;
				$search_filters .= isset($filter['source']) ? " AND source LIKE '".$filter['source']."%'" : false;
				$search_filters .= isset($filter['caption']) ? " AND caption LIKE '".$filter['caption']."%'" : false;
				$search_filters .= isset($filter['status']) ? " AND status='".$filter['status']."'" : false;
				$search_filters .= isset($filter['from'])  ? " AND date(timestamp) >= '".$filter['from']."'" : false;
				$search_filters .= isset($filter['to'])  ? " AND date(timestamp) <= '".$filter['to']."'" : false;

			}

		}
		/*end search function*/

		$params = array('table' => 'tbl_entries',
						'where' => $search_filters,
						'offset'=> $offset,
						'limit' => $limit,
						'order' => 'timestamp DESC'
						);

		$items = $this->mysql_queries->get_data($params);

		$params = array('table' => 'tbl_entries','where' => $search_filters);
		$totalrows = $this->mysql_queries->get_data($params);


		$data = array('items' => $items,
					  'total' => sizeof($totalrows),
					  'pagination'	=> $this->globals->pagination(sizeof($totalrows), $curpage ,site_url('entries/index'), $paging, $limit)
					);

		$main = $this->load->view('entries-content', $data, TRUE);
		return $main;
	}
	
	public function _remap() {
		$this->index();
	}
}

?>