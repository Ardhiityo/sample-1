<?php

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BlogModel');
    }

    public function index()
    {
        $find = $this->input->get('find');

        $query = $this->BlogModel->getBlogs($find);

        $data['blogs'] = $query->result_array();

        return $this->load->view('blog', $data);
    }

    public function detail($url)
    {
        $query = $this->BlogModel->getBlog('url', $url);
        $data['blog'] = $query->row_array();

        return $this->load->view('blog-detail', $data);
    }

    public function add()
    {
        if ($this->input->post()) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 100;
            $config['max_width'] = 1024;
            // Nama file custom
            $config['file_name'] = 'cover'.time();

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('cover')) {
                echo $this->upload->display_errors();
                exit;
            } else {
                $file_uploaded = $this->upload->data();
                $data['cover'] = $file_uploaded['file_name'];
            }
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['url'] = $this->input->post('url');
            $id = $this->BlogModel->insert($data);
            if ($id) {
                redirect('/');
                // echo "Sukses";
            } else {
                echo "Gagal";
            }
        }

        return $this->load->view('add-blog');
    }

    public function edit($id)
    {
        $query = $this->BlogModel->getBlog('id', $id);

        $data['blog'] = $query->row_array();

        if ($this->input->post()) {
            $data['blog']['title'] = $this->input->post('title');
            $data['blog']['content'] = $this->input->post('content');
            $row_affected = $this->BlogModel->update($id, $data['blog']);
            if ($row_affected) {
                // echo "Sukses";
            } else {
                echo "Gagal";
            }
        }

        return $this->load->view('edit-blog', $data);
    }

    public function delete($id)
    {
        $this->BlogModel->delete($id);

        return redirect('/');
    }
}