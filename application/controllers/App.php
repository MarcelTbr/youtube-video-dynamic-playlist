<?php

class App extends CI_Controller
{

    public function video()
    {


        $this->form_validation->set_rules('yt_url', 'Video URL', 'trim|required|min_length[4]');


        if ($this->form_validation->run() == TRUE) {

            $url = $this->input->post('yt_url');
            $video_src = 'https://www.youtube.com/embed/' . substr($url, 32);


            $data = array(

                'url' => $this->input->post('yt_url'),
                'video_src' => $video_src

            );


            $this->session->set_flashdata($data);
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
}