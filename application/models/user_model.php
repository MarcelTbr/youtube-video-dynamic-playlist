<?php

class User_model extends CI_Model
{

    public function login_user($username, $password)
    {

        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {

            return $result->row(0)->id;

        } else {
            return false;
        }

    }

    public function username_available($username)
    {

        $this->db->where('username', $username);

        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {

            return false;

        } else {
            return true;
        }
    }


    public function create_user()
    {


        $data = array(

            'username' => $this->input->post('su_username'),
            'password' => $this->input->post('su_password')

        );

        $insert_data = $this->db->insert('users', $data);


    }

}