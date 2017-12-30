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
}