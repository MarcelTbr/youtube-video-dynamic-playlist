<?php

class app_model extends CI_Model
{
    function not_repeated($src)
    {

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

        if ($this->not_repeated($src)) {
            $data = array(

                'video_title' => $this->session->flashdata('video_title'),
                'video_url' => $src

            );

            $insert_data = $this->db->insert('playlist', $data);
        } else {

            $this->session->set_flashdata('login_failed', 'Sorry this song is already on the playlist...');
        }
    }

    public function get_all_songs()
    {

        $query = $this->db->get('playlist');

        $array = $query->result();

        /**
         * Pre-sort videos from top-voted to worst-ranking.
         */

        function sort_data($a, $b)
        {
            if ($a->votes == $b->votes) {
                return 0;
            }
            return ($a->votes > $b->votes) ? -1 : 1;
        }

        usort($array, 'sort_data');


        return $array;

    }

    public function update_votes($up_or_down, $id)
    {
        $this->db->where(['id' => $id]);
        $query = $this->db->get('playlist');

        $count = $query->row(0)->votes;

        if ($up_or_down == 'up') {
            $count = $count + 1;
        } else {
            $count = $count - 1;
        }

        $data = array(
            'votes' => $count
        );

        $this->db->where(['id' => $id]);
        $this->db->update('playlist', $data);

    }

    public function get_top_video_url($id)
    {

        $this->db->where(['id' => $id]);
        $query = $this->db->get('playlist');
        $src = $query->row(0)->video_url;

        return $src;
    }

    public function reset_top_video_votes($id){

        $data = array(
            'votes' => 0
        );
        $this->db->where(['id' => $id]);
        $this->db->update('playlist', $data);
    }

    public function get_playing_video_id(){

        $this->db->where(['playing' => 1]);
        $query = $this->db->get('playlist');
        $id = $query->row(0)->id;
        return $id;
    }


    public function set_playing_video($id){
        /**
         * first reset all playing to 0 (false)
         */
        $data = array(
            'playing' => 0
        );
        $this->db->update('playlist', $data);

        $playing = array(
            'playing' => 1
        );

        $this->db->where(['id'=>$id]);
        $this->db->update('playlist', $playing);
    }

    public function get_current_song(){


        $this->db->where(['playing'=> 1]);
        $query = $this->db->get('playlist');
        return $query->row(0);
    }

    public function get_number_of_videos(){

        $result = $this->db->get('playlist');

        return $result->num_rows();
    }
}