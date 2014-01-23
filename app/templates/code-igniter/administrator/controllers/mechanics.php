<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mechanics extends CI_Controller {

	public function index()
	{
		$data = array( 'title'			=> "Mechanics",
					   'main_content'	=> $this->content());
		$this->load->view('main_template', $data, FALSE);
 	}
	
	public function content() {
		
		if($_POST) {
			$post['content'] = $_POST['content'];

			$params = array('table'	=> 'tbl_settings',
							'post'	=> $post,
							'where'	=> 'type = \'mechanics\'');

			$this->mysql_queries->update_data($params);
		}
		
		$params = array('table'	=> 'tbl_settings',
						'where'	=> 'type = \'mechanics\'');
		$mechanics = $this->mysql_queries->get_data($params);
		$data['mechanics'] = @$mechanics[0];
		return $this->load->view('mechanics-content', $data, TRUE);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */