<?php

class Blog extends CI_Controller{
    public function index() {
        $data['blogs'] = [
            [
                'title' => "Pertama",
                'description' => "Lorem ipsum dolor"
            ],
            [
                'title' => "Kedua",
                'description' => "Lorem ipsum dolor"
            ],
            [
                'title' => "Tiga",
                'description' => "Lorem ipsum dolor"
            ]
        ];
        
        return $this->load->view('blog', $data);
    }
}