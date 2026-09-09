<?php

class Blog extends CI_Controller{
    public function index($name, $blood_type, $address) {
        $data['name'] = $name;
        $data['blood_type'] = $blood_type;
        $data['address'] = $address;
        
        return $this->load->view('blog', $data);
    }
}