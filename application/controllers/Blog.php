<?php

class Blog extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }    

    public function index() {   
        // raw sql
        // $query = $this->db->query("SELECT * FROM blogs");
        
        // query builder
        $query = $this->db->get("blogs");
        
        $data['blogs'] = $query->result_array();
        
        return $this->load->view('blog', $data);
    }
    
    public function detail($url) {
        $this->db->where('url', $url);
        $query = $this->db->get("blogs");
        $data['blog'] = $query->row_array();
        
        return $this->load->view('blog-detail', $data);
    }
}