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
            $video_src = 'https://www.youtube.com/embed/' . substr($url, 32);


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
        $data['main'] = "app_view";

        $this->load->view('layouts/main', $data);

    }

    function playlist()
    {

        $data['main'] = "app_view";

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
}