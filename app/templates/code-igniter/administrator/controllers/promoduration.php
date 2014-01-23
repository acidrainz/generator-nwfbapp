<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promoduration extends CI_Controller {

	public function index()
	{
		$data = array( 'title'			=> "Promo Duration",
					   'main_content'	=> $this->content());
		$this->load->view('main_template', $data, FALSE);
 	}
	
	public function content() {

		$params = array('table'	=> 'tbl_settings',
						'where'	=> 'type = \'promoend\'');
		$item = $this->mysql_queries->get_data($params);

		if($_POST) {
			if($item){
				$params = array('table'	=> 'tbl_settings',
							'post'	=> array('timestamp' => $_POST['end_date'],
											  'content' => $_POST['copy']),
							'where'	=> 'type = \'promoend\'');

				$this->mysql_queries->update_data($params);
			}else{
				$params = array('table'	=> 'tbl_settings',
								'post'	=> array('type' => 'promoend', 
												  'timestamp' => $_POST['end_date'],
												  'content' => $_POST['copy'])
								);

				$this->mysql_queries->insert_data($params);
			}
			
		}

		$data['item'] = @$item[0];
		return $this->load->view('promoduration-content', $data, TRUE);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */