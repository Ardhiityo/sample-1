<?php

class Blog extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('BlogModel');
    }    

    public function index() {   
        $query = $this->BlogModel->getBlogs();
        
        $data['blogs'] = $query->result_array();
        
        return $this->load->view('blog', $data);
    }
    
    public function detail($url) {
        $query = $this->BlogModel->getBlog($url);
        $data['blog'] = $query->row_array();
        
        return $this->load->view('blog-detail', $data);
    }
    
    public function add() {
        if($this->input->post()){
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $id = $this->BlogModel->insert($data);
            if($id) {
                echo "Sukses";
                } else {
                echo "Gagal";
            }
        }

        return $this->load->view('add-blog');
    }
}