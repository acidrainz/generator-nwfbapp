<?php

class Matchup extends CI_Controller
{

       public function __construct()
        {
            parent::__construct();

        }

        public function create_jpeg($jpg,$fbid)
        {
                 # create jpg image

                $jpg = $jpg->data;
                $jpg = gzuncompress($jpg);
                $file = md5(uniqid(mt_rand(), true));
                $f_jpg = $file.'.jpg';
                # create user directory
                $root_folder    =getcwd() .'/uploads/entries/';
                if(!is_dir($root_folder)){
                    mkdir($root_folder, 0755, true);
                }
                if(!is_dir($root_folder.$fbid->fbid)){
                    mkdir($root_folder.$fbid->fbid, 0755, true);
                }

                $root_folder = $root_folder.$fbid->fbid.'/';
                $put_jpg = file_put_contents($root_folder.$f_jpg , $jpg) or trigger_error("Unable to create jpeg file.");
                $current_theme = $this->globals->current_theme();
                $post = array('fbid'=>$fbid->fbid,
                                     'theme_name'=>$current_theme[0]['name'],
                                     'theme_id'=>$current_theme[0]['theme_id'],
                                     'image'=>$f_jpg,
                                     'caption'=>$fbid->caption

                                   );
                $params = array('table'=>'tbl_entries','post'=>$post);
                $this->mysql_queries->insert_data($params);




        }



}
