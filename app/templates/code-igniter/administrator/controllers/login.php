<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $CI;

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if(isset($_POST['username'])) {
			if(!empty($_POST['username']) && !empty($_POST['password']))
			{
				$params = array('table' => 'tbl_cms_users',
								'where' => "uname='".$_POST['username']."' and pword='".md5($_POST['password'])."'"
								);

			 	$valid = $this->mysql_queries->get_data($params);

 				if( $valid ){
 					$newdata = array(
						'user_name' => $valid[0]['uname'],
						'user_id'  => $valid[0]['user_id'],
						'user_level' => $valid[0]['level'],
						'user_account' => $valid[0]['account_name'],
						'user_email' => $valid[0]['email'],
						'logged_in' => TRUE
              		 );

 			   		$this->session->set_userdata($newdata);
					redirect('home', 'location');
 				}

 				 else
					$return = "Invalid username/password.";

			} else {
				$return =  "Invalid username/password.";
			}
		} else {
			$return = "";
 		}
		$data['error_msg'] = $return;

		 $this->load->view('login_template', $data, FALSE);
 	}



}

