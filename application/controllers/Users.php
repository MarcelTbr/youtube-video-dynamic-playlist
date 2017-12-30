<?php

class Users extends CI_Controller
{

    public function login()
    {
        /** just in case the uri fails to load properly */
//        if($this->uri->total_segments() === 0){
//            redirect('users/login','refresh');
//        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[4]|matches[password]');

        if ($this->form_validation->run() == FALSE) {

            $data = array(

                'errors' => validation_errors()

            );

            $this->session->set_flashdata($data);

            redirect('home');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');


            $user_id = $this->user_model->login_user($username, $password);

            if ($user_id) {

                $user_data = array(

                    'user_id' => $user_id,
                    'username' => $username,
                    'password' => $password,
                    'logged_in' => true

                );

                $this->session->set_userdata($user_data);

                $this->session->set_flashdata('login_success', 'You are now logged-in');


                redirect('app/playlist');

            } else {

                $this->session->set_flashdata('login_failed', 'Sorry you could not log in');

                redirect('home');

            }
        }


    }

    public function register(){

        $data['main'] = "signup_view";

        $this->load->view('layouts/main', $data);
    }

    public function signup()
    {

        $this->form_validation->set_rules('su_username', 'New Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('su_password', 'New Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('confirm_su_password', 'Confirm Password', 'trim|required|min_length[4]|matches[su_password]');

        if ($this->form_validation->run() == FALSE) {

            $data = array(

                'su_errors' => validation_errors()

            );

            $this->session->set_flashdata($data);

            redirect('home');
        } else {

            $username = $this->input->post('su_username');
            $password = $this->input->post('su_password');


            $user_free = $this->user_model->username_available($username);

            if ($user_free) {


                $this->user_model->create_user();


//                log the user in
                $signup_data = array(

                    'username' => $username,
                    'logged_in' => true

                );

                $this->session->set_userdata($signup_data);

                $this->session->set_flashdata('login_success', 'You are now logged-in');

                $data['main'] = "app_view";

                $this->load->view('layouts/main', $data);

            } else {

                $this->session->set_flashdata('signup_failed', 'Sorry this username is in use. Try another one.');

                $data['main'] = "signup_view";

                $this->load->view('layouts/main', $data);
            }
        }

        //echo $_POST['username'];
        //$this->input->post('username');


    }

    public function logout()
    {

        $this->session->sess_destroy();

        redirect('home');

    }

//    public function show()
//    {
//        $this->load->model('user_model');
//
//        $result = $this->user_model->get_users();
//
////        foreach ( $result as $object){
////
////            echo $object->id . " " . $object->username . "<br />";
////
////        }
//
//        $data['welcome'] = "Welcome to the users view";
//        $data['results'] = $result;
//
//
//        $this->load->view('users_view', $data);
//    }
}