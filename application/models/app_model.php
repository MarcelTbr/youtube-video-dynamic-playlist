<?php

class app_model extends CI_Model
{

public function add_video(){



    $data = array(

        'video_title' => $this->session->flashdata('video_title'),
        'video_url' => $this->session->flashdata('video_src')

    );

    $insert_data = $this->db->insert('playlist', $data);

}



}