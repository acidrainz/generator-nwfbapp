<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
           session_start();

	}

	public function index()
      {

            $this->globals->fb_init();
            $user = $this->facebook->getUser();
            if(!$user && empty($_GET['auth'])){
              redirect(base_url('teaser'));
            }

          $this->globals->fb_auth();
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
      $limit   = 16;
      $curpage = $this->uri->segment(3, 1);
      $offset  = ($curpage-1)*$limit;
      $currentTheme= $this->globals->current_theme();
      $post = array('activated'=>1);
      $params = array('table'=>'tbl_theme','where'=>'theme_id='.$currentTheme[0]['theme_id'],'post'=>$post);
      $this->mysql_queries->update_data($params);
      $has_entry = $this->session->userdata('entry_id');
      $params = array('table'=>'v_entry','where'=>'status=1','limit'=>$limit,'offset'=>$offset,'order'=>'entry_id DESC');
      $entries = $this->mysql_queries->get_data($params);
      $params = array('table'=>'tbl_theme','where'=>'activated = 1');
      $themes = $this->mysql_queries->get_data($params);
      $user_liked = $this->globals->check_if_fan($_SESSION['fbme']['userid']);
      $data =array('themes'=>$themes,'liked'=>$user_liked,'current_theme'=>$currentTheme,'duration'=>$this->globals->promo_duration(),'entry_id'=>$has_entry,'entries'=>$entries);
      return $this->load->view('home-content', $data, TRUE);
    }

    public function theme(){
      $currentTheme= $this->globals->current_theme();
      $this->load->view('theme-content',array('data'=>$currentTheme[0]['image']));
    }








}

?>
