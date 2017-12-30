<?php

class app_model extends CI_Model
{
    function not_repeated($src){

        $this->db->where('video_url', $src);

        $result = $this->db->get('playlist');

        if ($result->num_rows() > 0) {

            return false;

        } else {
            return true;
        }

    }
    public function add_video()
    {
        $src = $this->session->flashdata('video_src');

        if($this->not_repeated($src)) {
            $data = array(

                'video_title' => $this->session->flashdata('video_title'),
                'video_url' => $src

            );

            $insert_data = $this->db->insert('playlist', $data);
        }else{

            $this->session->set_flashdata('login_failed', 'Sorry this song is already on the playlist...');
        }
    }

    public function get_all_songs()
    {

        $query = $this->db->get('playlist');

        $array = $query->result();

        return $array;

    }


}