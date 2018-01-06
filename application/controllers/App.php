<?php

class App extends CI_Controller
{

    function get_title($url)
    {
        $str = file_get_contents($url);
        if (strlen($str) > 0) {
            $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
            preg_match("/\<title\>(.*)\<\/title\>/i", $str, $title); // ignore case
            return $title[1];
        }
    }

    public function video()
    {


        $this->form_validation->set_rules('yt_url', 'Video URL', 'trim|required|min_length[4]');


        if ($this->form_validation->run() == TRUE) {

            $url = $this->input->post('yt_url');
            $video_src = 'https://www.youtube.com/embed/' . substr($url, 32, 11);


            $video_title = $this->get_title($url);


            $data = array(

                'url' => $this->input->post('yt_url'),
                'video_src' => $video_src,
                'video_title' => $video_title

            );


            $this->session->set_flashdata($data);


            $this->app_model->add_video();
        }

        //redirect to app view
        $admin = $this->session->userdata('username');
        $user = $this->session->userdata('password');

        if (($admin != 'admin') || ($user != 'admin') ) {
            $data['main'] = "user_view";
        } else {
            $data['main'] = "app_view";
        }
        $this->load->view('layouts/main', $data);

    }

    function playlist()
    {
        /**
         * @var $admin if it's the admin go to the back-office
         *  else display a plain user view without the extra features
         */
        $admin = $this->session->userdata('username');
        $user = $this->session->userdata('password');
        $login = $this->session->userdata('logged_in');

        if (($admin != 'admin') || ($user != 'admin') ) {
            $data['main'] = "user_view";
        } else {
            $data['main'] = "app_view";
        }
        $this->load->view('layouts/main', $data);

    }

    public function get_all_songs()
    {


        $data = $this->app_model->get_all_songs();


        return $this->output->set_output(json_encode($data));

    }

    public function song_up($id)
    {

        $this->app_model->update_votes('up', $id);

    }

    public function song_down($id)
    {

        $this->app_model->update_votes('down', $id);

    }

    public function get_top_video_url($id)
    {

        $src = $this->app_model->get_top_video_url($id);

        return $this->output->set_output($src);
    }

    public function reset_top_video_votes($id){

        $this->app_model->reset_top_video_votes($id);
    }

    public function get_playing_video_id(){

        $id = $this->app_model->get_playing_video_id();

        return $this->output->set_output($id);
    }

    public function set_playing_video($id){

        $this->app_model->set_playing_video($id);

    }

    public function get_current_song(){

        $current = $this->app_model->get_current_song();

        return $this->output->set_output(json_encode($current));
    }

    public function get_number_of_videos(){

        $num_vids = $this->app_model->get_number_of_videos();

        return  $this->output->set_output($num_vids);

    }

    public function get_song_by_id($id){

        $song = $this->app_model->get_song_by_id($id);

        $this->output->set_output(json_encode($song));
    }
}