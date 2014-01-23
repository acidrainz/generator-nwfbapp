<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teaser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	 {
                $params = array('table' => 'tbl_settings', 'where' => 'type = \'analytics\'');
                $analytics = $this->mysql_queries->get_data($params);
                $data = array(  'title'         => "Teaser",
                                       'analytics'  => @$analytics[0]
                                    );
                $this->load->view('landing-content', $data, FALSE);

          }






}

?>
