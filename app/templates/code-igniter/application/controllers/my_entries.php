<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Entries extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
          session_start();
	}

	public function index()
      {
          $params = array('table' => 'tbl_settings','where' => 'type = \'analytics\'');
          $analytics = $this->mysql_queries->get_data($params);
          $data = array(  'title'          => "Home",
                                  'analytics'  => @$analytics[0],
                                  'content'    => $this->content()
                               );
          $this->load->view('main-template', $data, FALSE);

    }


    public function content()
    {

      $params = array('table'=>'v_entry','where'=>'fbid='.$_SESSION['fbme']['userid']);
      $my_entries = $this->mysql_queries->get_data($params);
      $params = array('table'=>'tbl_registrants','where'=>'fbid='.$_SESSION['fbme']['userid']);
      $user_details = $this->mysql_queries->get_data($params);
      $params = array('table'=>'tbl_theme','where'=>'activated = 1');
      $themes = $this->mysql_queries->get_data($params);
      $data=array('my_entries'=>$my_entries,'themes'=>$themes,'user_details'=>$user_details[0]);
      return $this->load->view('my-entries-content', $data, TRUE);
    }






}

?>
