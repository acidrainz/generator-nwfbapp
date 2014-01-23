<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('parser');
	}

	public function index() {

		$data = array( 'title'			=> 'My Account',
					   'main_content'	=> $this->main_content());

		$this->load->view('main_template', $data, FALSE);
	}

	public function main_content() {


		if(isset($_POST['submit'])) {

			extract($_POST);
			$error = false;
			$userid = $this->session->userdata('user_id');
			$params['table'] = 'tbl_cms_users';

			$params['where'] = "account_name = '".$account."' AND user_id!='".$userid."'";
			$account_name = $this->mysql_queries->get_data($params);

			$params['where'] = "uname = '".$username."' AND user_id!='".$userid."'";
			$user_name = $this->mysql_queries->get_data($params);

			$params['where'] = "pword = '".md5($password)."' AND user_id='".$userid."'";
			$validate = $this->mysql_queries->get_data($params);

			if(!$validate){
				$error = 'Invalid password.';
			}
			elseif($account_name){
				$error = 'Account name already exist.';
			}
			elseif($user_name){
				$error = 'Username already exist.';
			}
			else{
				$post['account_name'] = $account;
				$post['uname']	= $username;
				if($new_password!=''){ $post['pword'] = md5($new_password); }

				$params['post'] = $post;
				$params['where'] = "user_id='".$userid."'";

				$this->mysql_queries->update_data($params);
				redirect(site_url('logout'),'location');
			}

			if($error){
				redirect(site_url('myaccount?error='.$error),'location');
			}

		}

		$data = array();

		$main = $this->load->view('myaccount-content', $data, TRUE);
		return $main;
	}

}
?>
