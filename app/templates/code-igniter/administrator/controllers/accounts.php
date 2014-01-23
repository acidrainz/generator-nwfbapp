<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index() {
		$data = array( 'title'			=> "User Accounts",
					   'main_content'	=> $this->main_content());
 		$this->load->view('main_template', $data);
	}


	public function add(){
		$data = array( 'title'			=> "Add User",
					   'main_content'	=> $this->add_content());
 		$this->load->view('main_template', $data);
	}

	public function edit($id){
		$data = array( 'title'			=> "Edit User",
					   'main_content'	=> $this->edit_content($id));
 		$this->load->view('main_template', $data);
	}

	public function delete($id){
		$params['table'] = 'tbl_cms_users';
		$params['field'] = "user_id";
		$params['value'] = $id;
		$this->mysql_queries->delete_data($params);

 		redirect(site_url('accounts'),'location');
	}


	/******************************************************/

	public function main_content() {
		$params = array('table' => 'tbl_cms_users',
						'where' => "user_id!='".$this->session->userdata('user_id')."'"
						);

		$items = $this->mysql_queries->get_data($params);

		$data = array('items' => $items);

		$main = $this->load->view('accounts-content', $data, TRUE);
		return $main;
	}

	public function add_content() {

		if(isset($_POST['submit'])) {
			extract($_POST);

			$params['table'] = 'tbl_cms_users';
			$params['post']	= array('account_name' => $account, 'uname' => $username, 'pword' => md5($password), 'level' => $level);
			$this->mysql_queries->insert_data($params);
			redirect(site_url('accounts'),'location');
		}
		// $params = array('table'=>'tbl_user_levels');
		// $data['user_levels'] = $this->mysql_queries->get_data($params);
		$data['title'] = 'Add User';
		$main = $this->load->view('accounts-update-content', $data, TRUE);
		return $main;
	}

	public function edit_content($id) {
		$params['table'] = 'tbl_cms_users';
		$params['where'] = "user_id='".$id."'";

		if(isset($_POST['submit'])) {
			extract($_POST);
			$post['account_name'] = $account;
			$post['uname'] = $username;
			$post['level'] = $level;
			if($password!='oooooo'){ $post['pword'] = md5($password); }
			$params['post']	= $post;

			$this->mysql_queries->update_data($params);
			redirect(site_url('accounts'),'location');
		}

		$user = $this->mysql_queries->get_data($params);
		// $params = array('table'=>'tbl_user_levels');
		// $data['user_levels'] = $this->mysql_queries->get_data($params);
		$data['title'] = 'Edit User';
		$data['user']  = @$user[0];
		$main = $this->load->view('accounts-update-content', $data, TRUE);
		return $main;
	}

}

?>
