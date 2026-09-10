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
        $query = $this->BlogModel->getBlog('url', $url);
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
    
    public function edit($id) {
        $query = $this->BlogModel->getBlog('id', $id);
        
        $data['blog'] = $query->row_array();

        if($this->input->post()){
            $data['blog']['title'] = $this->input->post('title');
            $data['blog']['content'] = $this->input->post('content');
            $row_affected = $this->BlogModel->update($id, $data['blog']);
             if($row_affected) {
                echo "Sukses";
                } else {
                echo "Gagal";
            }
        }
        
        return $this->load->view('edit-blog', $data);
    }
}