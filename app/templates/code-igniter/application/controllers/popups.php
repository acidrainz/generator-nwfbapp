<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popups extends CI_Controller {

public function __construct()
    {
        parent::__construct();
          session_start();

    }

public function  force_liked(){
    $this->load->view('popups/force-liked');
}

public function  register(){

    $data = array('firstname'=>$_SESSION['fbme']['fname'],
                         'lastname'=>$_SESSION['fbme']['lname'],
                         'email'=>$_SESSION['fbme']['email'],
                         'theme'=>$this->input->get('theme'),
                         'bdate'=>explode('/',$_SESSION['fbme']['birthday']),
                         'fbid'=>$_SESSION['fbme']['userid'],

                        );
    $is_registered = $this->globals->check_if_registered($_SESSION['fbme']['userid']);
    $is_ended = $this->globals->promo_duration();
    if(!$is_registered){
        $this->load->view('popups/registration-content',$data);
    }else{
        $this->load->view('popups/upload-content',$data);

    }

}
public function upload(){

    $data['theme'] = $this->input->get('theme');
    $this->load->view('popups/upload-content',$data);
}
public function show($id){
    $this->session->set_userdata('entry_id',$id);
    redirect($this->config->item('fb_url'));
}

public function thankyou(){
    $this->load->view('popups/thank-you-content');
}
public function user_entry($id){
    $this->load->library('nuworks');
    $params = array('table'=>'v_entry','where'=>'entry_id='.$id);
    $entry = $this->mysql_queries->get_data($params);
    $long_url = 'https://nwshare.ph/heinz/match-up/fb/branch/popups/show/'.$id;
    $short_url = $this->nuworks->get_bitly_short_url($long_url,'o_5d1crb6pte','R_8ded0ea063c5ee57c0bac20d5a700f16');
    $data['entry'] = $entry[0];
    $data['link'] = $short_url;
    $this->load->view('popups/single-entry-content',$data);
}

public function promo_end(){
    $params = array('table'=>'tbl_settings','where' => 'type =\'duration\' AND CURDATE() > end_date');
    $duration = $this->mysql_queries->get_data($params);
    $is_registered = $this->globals->check_if_registered($_SESSION['fbme']['userid']);
    $data['duration'] = $duration[0];
    $data['is_registered'] = $is_registered;
    $this->load->view('popups/promo-duration-content',$data);

}




















}

?>
