<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function save_registrants(){
      $time = strtotime($this->input->post('YY').'-'.$this->input->post('MM').'-'.$this->input->post('DD'));
      $post = array('fbid'=>$this->input->post('fbid'),
                           'lname'=>$this->input->post('lname'),
                           'fname'=>$this->input->post('fname'),
                           'gender'=>$this->input->post('gender'),
                           'mobile'=>$this->input->post('prefix').$this->input->post('mobile'),
                           'birthdate'=>date('Y-m-d',$time),
                           'email'=>$this->input->post('email'),
                           'mailing_address'=>$this->input->post('address'),
                           'variant'=>$this->input->post('variant'),

                          );
      $params = array('table'=>'tbl_registrants','post'=>$post);
      $this->mysql_queries->insert_data($params);
      $theme = $this->input->post('theme');
      echo $theme;

    }

   public function gallery(){
        if($_GET['page']){
                $page     = $_GET['page'];
                $hashtag  = $_GET['hashtag'];
                $cur_page = $page;
                $page -= 1;
                $per_page = 16; // Per page records
                $previous_btn = true;
                $next_btn = true;
                $first_btn = true;
                $last_btn = true;
                $start = $page * $per_page;
                $this->db->start_cache();
                $this->db->select();
                $this->db->from('tbl_entries');
                if($hashtag>0){
                    $this->db->where('theme_id', $hashtag);
                    $this->db->order_by('timestamp','desc');
                }
                $this->db->where('status', 1);
                $this->db->order_by('entry_id','desc');
                $this->db->limit($per_page, $start);
                $result_pag_data = $this->db->get()->result_array();
                $query_pag_num = $this->db->count_all_results();
                $pages = ceil($query_pag_num / $per_page);
                $data = array();
                $data['prev'] = 0;
                $data['next'] = 0;
                if($cur_page > 1){
                $data['prev'] = $cur_page - 1;
                }else{
                  $data['prev'] = 1;
                }
                if($page < $pages){
                    $data['next'] = $cur_page + 1;
                }
            $data['num_of_entries'] = count($result_pag_data)/16;
            $data['images'] = $result_pag_data;
            $this->db->stop_cache();
            $this->db->flush_cache();
            $this->load->view('ajax-gallery-content',$data);


        }
    }
    public function my_gallery(){
        if($_GET['page']){
                $page     = $_GET['page'];
                $hashtag  = $_GET['hashtag'];
                $fbid = $_GET['fbid'];
                $cur_page = $page;
                $page -= 1;
                $per_page = 16; // Per page records
                $previous_btn = true;
                $next_btn = true;
                $first_btn = true;
                $last_btn = true;
                $start = $page * $per_page;
                $this->db->start_cache();
                $this->db->select();
                $this->db->from('tbl_entries');
                if($hashtag>0){
                    $this->db->where('theme_id', $hashtag);
                    $this->db->order_by('timestamp','desc');
                }

                 $this->db->where('fbid', $fbid);
                $this->db->order_by('entry_id','desc');
                $this->db->limit($per_page, $start);
                $result_pag_data = $this->db->get()->result_array();
                $query_pag_num = $this->db->count_all_results();
                $pages = ceil($query_pag_num / $per_page);
                $data = array();
                $data['prev'] = 0;
                $data['next'] = 0;
                if($cur_page > 1){
                $data['prev'] = $cur_page - 1;
                }else{
                  $data['prev'] = 1;
                }
                if($page < $pages){
                    $data['next'] = $cur_page + 1;
                }
            $data['num_of_entries'] = count($result_pag_data)/16;
            $data['images'] = $result_pag_data;
            $this->db->stop_cache();
            $this->db->flush_cache();
            $this->load->view('ajax-my-gallery-content',$data);


        }
    }

    public function ajax_entry($id){
      $this->load->library('nuworks');
      $params = array('table'=>'v_entry','where'=>'entry_id='.$id);
      $entry = $this->mysql_queries->get_data($params);
      $long_url = 'https://nwshare.ph/heinz/match-up/fb/branch/popups/user_entry/'.$id;
      $short_url = $this->nuworks->get_bitly_short_url($long_url,'o_5d1crb6pte','R_8ded0ea063c5ee57c0bac20d5a700f16');
      $data['entry'] = $entry[0];
      $data['link'] = $short_url;
      $this->load->view('popups/ajax-entry-content',$data);

    }

}

?>
