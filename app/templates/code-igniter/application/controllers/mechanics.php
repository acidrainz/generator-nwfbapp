<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mechanics extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        session_start();



    }

    public function index()
      {

          $params = array('table' => 'tbl_settings','where' => 'type = \'analytics\'');
          $analytics = $this->mysql_queries->get_data($params);
          $data = array(  'title'          => "Mechanics",
                                  'analytics'  => @$analytics[0],
                                  'content'    => $this->content()
                               );
          $this->load->view('main-template', $data, FALSE);

    }


    public function content()
    {
        $params = array('table' => 'tbl_settings','where' => 'type = \'mechanics\'');
        $mechanics = $this->mysql_queries->get_data($params);
        $data =array('mechanics'=>$mechanics[0]);
        return $this->load->view('mechanics-content', $data, TRUE);

    }






}

?>
