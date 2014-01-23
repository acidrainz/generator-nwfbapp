<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends CI_Controller {

	public function index()
	{
		$data = array( 'title'			=> "analytics",
					   'main_content'	=> $this->content());
		$this->load->view('main_template', $data, FALSE);
 	}
	
	public function content() {
		
		if($_POST) {
			$post['content'] = $_POST['content'];

			$params = array('table'	=> 'tbl_settings',
							'post'	=> $post,
							'where'	=> 'type = \'analytics\'');

			$this->mysql_queries->update_data($params);
		}
		
		$params = array('table'	=> 'tbl_settings',
						'where'	=> 'type = \'analytics\'');

		$analytics = $this->mysql_queries->get_data($params);
		
		$data['analytics'] = @$analytics[0];
		return $this->load->view('analytics-content', $data, TRUE);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */