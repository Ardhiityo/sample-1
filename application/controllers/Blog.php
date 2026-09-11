<?php

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BlogModel');
    }

    public function index($offset = 0)
    {
        $this->load->library('pagination');
        
        $config['base_url'] = '/blog/index/';
        $config['total_rows'] = $this->BlogModel->getTotalBlogs();
        $config['per_page'] = 3;

        $this->pagination->initialize($config);

        $query = $this->BlogModel->getBlogs($config['per_page'], $offset);

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
        $this->form_validation->set_rules([
            ['field' => 'title', 'label' => 'Title', 'rules' => 'required'],
            ['field' => 'url', 'label' => 'URL', 'rules' => 'required|alpha_dash'],
            ['field' => 'content', 'label' => 'Content', 'rules' => 'required']
        ]);

        if ($this->form_validation->run()) {
            if ($_FILES['cover']['name']) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 100;
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
        $this->form_validation->set_rules([
            ['field' => 'title', 'label' => 'Title', 'rules' => 'required'],
            ['field' => 'url', 'label' => 'URL', 'rules' => 'required|alpha_dash'],
            ['field' => 'content', 'label' => 'Content', 'rules' => 'required']
        ]);

        $query = $this->BlogModel->getBlog('id', $id);

        $data['blog'] = $query->row_array();

        if ($this->form_validation->run()) {
            if ($_FILES['cover']['name']) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 100;
                $config['file_name'] = 'cover'.time();

                $this->load->library('upload', $config);
                if (! $this->upload->do_upload('cover')) {
                    echo $this->upload->display_errors();
                    exit;
                }

                if ($data['blog']['cover']) {
                    $file = './uploads/'.$data['blog']['cover'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                $file_uploaded = $this->upload->data();
                $data['blog']['cover'] = $file_uploaded['file_name'];
            }

            $data['blog']['title'] = $this->input->post('title');
            $data['blog']['content'] = $this->input->post('content');
            $this->BlogModel->update($id, $data['blog']);
        }

        return $this->load->view('edit-blog', $data);
    }

    public function delete($id)
    {
        $this->BlogModel->delete($id);

        return redirect('/');
    }
}