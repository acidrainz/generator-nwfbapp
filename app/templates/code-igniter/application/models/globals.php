<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Globals extends CI_Model {

	# Globals static variables
	public function __construct()
	{
		parent::__construct();

		$this->output->set_header('P3P: CP="NOI ADM DEV COM NAV OUR STP');
		$this->output->set_header('Cache-Control: no-cache');
		if( isset($_GET['fb_source']) && isset($_GET['ref'])  )
		{
			echo "<script type='text/javascript'>top.location.href = '" . $this->config->item('fb_url') . "';</script>";
		}

		$page = $this->uri->segment(1,'home');


	}

	# generate pagination links


	public function email_config()
	{
		$this->load->library('email');
		$config['mailtype'] = "html";
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.nuworks.ph';
		$config['smtp_port']='26';
		$this->email->initialize($config);
	}


	public function send_email($data) {

		$this->load->library('email');

		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($data['email'], $data['name']);
		$this->email->to($data['to']);
		$this->email->subject($data['subject']);
		$this->email->message($data['content']);

		if($this->email->send())
			return true;
		else
			print_r($this->email->print_debugger());
	}




	public function check_if_fan($fb_userid) {
		# get details of the logged in user
		$fql	= "SELECT uid FROM page_fan WHERE page_id = '" . $this->config->item('fan_page_id') . "' AND uid = '" . $fb_userid . "'";

		$params	= array('method'         => 'fql.query',
					 'query'		=> $fql,
					'callback'	=> ''
					);

		$fan = $this->facebook->api($params);

		if(isset($fan[0]['uid']) && $fan[0]['uid'] != '') {
			return 1;
		} else {
			return 0;
		}
	}

	public function current_theme(){
		$date = date("Y-m-d H:i:s");
		$params = array('table'=>'tbl_theme','where' => "'".$date."' >= start_date AND '".$date."' <= end_date");
		return $this->mysql_queries->get_data($params);
	}

	public function pagination($total_rows,$base_url,$per_page) {
 		$config['base_url'] = $base_url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$pagination_links = $this->pagination->create_links();
		return $pagination_links;
	}

	public function promo_duration(){
		$params = array('table'=>'tbl_settings','where' => 'type =\'duration\' AND CURDATE() > end_date');
		$duration = $this->mysql_queries->get_data($params);
		if($duration){
			return true;
		}else{
			return false;
		}
	}

	public function check_if_registered($fbid){
	        $params = array('table'=>'tbl_registrants','where'=>'fbid='.$fbid);
	        $registered  = $this->mysql_queries->get_data($params);
	        if($registered){
			return true;
		}else{
			return false;
		}

	}
	public function fb_init() {
		// header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');

		$config = array('appId'			=> $this->config->item('app_id'),
						'secret'		=> $this->config->item('secret'),
						'cookie'		=> $this->config->item('cookie'),
						'domain'		=> $this->config->item('domain'),
						'fileUpload'	=> $this->config->item('file_upload'));

		$this->fb = $this->load->library('facebook', $config);
	}

	public function fb_auth() {
		// Facebook Authentication part
		$uid = '';
		$fbme = '';
		$session	= $this->facebook->getUser();
		$login_url	= $this->facebook->getLoginUrl(array('canvas'    	=> $this->config->item('canvas'),
												   'fbconnect' 			=> $this->config->item('fbconnect'),
												   'scope'	 			=> $this->config->item('req_perms'),
												   'redirect_uri'		=> $this->config->item('fb_url')));

		if(!$session) {
			echo "<script type='text/javascript'>top.location.href = '" . $login_url . "';</script>";
			exit;
		} else {
			try {
				$uid	= $this->facebook->getUser();
				$fbme	= $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				echo "<script type='text/javascript'>top.location.href = '" . $login_url . "';</script>";
				exit;
			}
		}

		$_SESSION['fbme'] =  array(
							'userid' => $uid,
							'fname' => $fbme['first_name'],
							'lname' => $fbme['last_name'],
							'email' => @$fbme['email'],
							'gender' => @$fbme['gender'],
							'birthday' => @$fbme['birthday']
						);

	}





}
