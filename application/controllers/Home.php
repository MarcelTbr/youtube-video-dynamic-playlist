<?php


class Home extends CI_Controller
{
public function index(){

    $data['main'] = "home_view";

    $this->load->view('layouts/main', $data);


}
}