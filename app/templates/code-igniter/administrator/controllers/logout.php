<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->logout_account();
	}

	public function logout_account()
	{
		$this->session->sess_destroy();
		redirect('login', 'location');
 	}


}
