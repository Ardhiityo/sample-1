<?php

class Blog extends CI_Controller{
    public function index() {    
        $this->load->database();
        
        $query = $this->db->query("SELECT * FROM blogs");
    
        $data['blogs'] = $query->result_array();
        
        return $this->load->view('blog', $data);
    }
}