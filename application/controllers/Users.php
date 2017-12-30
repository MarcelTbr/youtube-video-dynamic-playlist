<?php

class Users extends CI_Controller
{
    public function show()
    {
        $this->load->model('user_model');

        $result = $this->user_model->get_users();

//        foreach ( $result as $object){
//
//            echo $object->id . " " . $object->username . "<br />";
//
//        }

        $data['welcome'] = "Welcome to the users view";
        $data['results'] = $result;


        $this->load->view('users_view', $data);
    }
}