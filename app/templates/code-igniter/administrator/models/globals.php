<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Globals extends CI_Model {

 	public function __construct()
	{
		parent::__construct();

		if($this->uri->segment(1) != 'login' && $this->uri->segment(1) != 'validate' && $this->uri->segment(1) != 'data') {
			$this->check_user_login();
		}
	}

	# check if user is logged in
	private function check_user_login() {
		if(!$this->session->userdata('logged_in')) {
			redirect('login', 'location');
		}
	}

	# generate pagination links
	public function pagination($total_rows, $cur_page, $base_url, $uri_segment=false, $per_page = false) {
 		$settings = array("total_rows"	=> $total_rows,
						  "base_url"	=> $base_url,
						  "cur_page"	=> $cur_page,
						  "uri_segment" => $uri_segment ? $uri_segment : 3,
						  "per_page"	=> $per_page ?  $per_page : 10,
						  "suffix"		=> '?'.http_build_query($_GET, '', "&"),
						  "full_tag_open" => '<ul>',
						  "full_tag_close" => '</ul>',
						  "num_tag_open" => '<li>',
						  "num_tag_close" => '</li>',
						  "cur_tag_open" => '<li class="active"><a>',
						  "cur_tag_close" => '</a></li>',
						  "next_link" => 'Next',
						  "next_tag_open" => '<li>',
						  "next_tag_close" => '</li>',
						  "prev_link" => 'Prev',
						  "prev_tag_open" => '<li>',
						  "prev_tag_close" => '</li>',
						  "first_link" => 'First',
						  "first_tag_open" => '<li>',
						  "first_tag_close" => '</li>',
						  "last_link" => 'Last',
						  "last_tag_open" => '<li>',
						  "last_tag_close" => '</li>',
						   );

		$this->pagination->initialize($settings);
		$pagination_links = $this->pagination->create_links();
		return $pagination_links;
	}

	public function get_weeks($start_date,$end_date=false){
		$data = array();

		$current_date = $end_date ? $end_date : date("Y-m-d");

		$first_week   = $this->globals->get_week_range($start_date);
		$current_week = $this->globals->get_week_range($current_date);

		$diff = strtotime($current_week[1]) - strtotime($first_week[0]);
		

		$week_count	   = ceil($diff / 604800);
		$data[] = array($first_week[0],$first_week[1]);

		for( $i = 1 ; $i < $week_count; $i++)
		{
			$start = date("Y-m-d",strtotime($first_week[0] . " +".(7*$i)." day"));
			$end   = date("Y-m-d",strtotime($start . " +6 day"));


			$data[] = array($start,$end);
		}

		return $data;
	}

	
	public function get_week_range($date) {
            $ts = strtotime($date);
            $start = date("l", $ts)=='Sunday' ? strtotime($date) : strtotime('sunday this week -1 week', $ts);
            $end = strtotime('saturday this week', $ts);
            return array(date('Y-m-d', $start), date('Y-m-d', $end));
    }

}
