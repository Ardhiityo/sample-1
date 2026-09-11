<?php

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BlogModel');
        $this->load->library('session');
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
                $config['file_name'] = 'cover'.time();

                $this->load->library('upload', $config);

                if (! $this->upload->do_upload('cover')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    return $this->load->view('add-blog');
                } else {
                    $file_uploaded = $this->upload->data();
                    $data['cover'] = $file_uploaded['file_name'];
                }
            }
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['url'] = $this->input->post('url');
            $affected_row = $this->BlogModel->insert($data);
            if ($affected_row) {
                $this->session->set_flashdata('success', 'Post successfully created.');
                redirect('/');
            } else {
                $this->session->set_flashdata('failed', 'Post failed created.');
                redirect('/');
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
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    return $this->load->view('edit-blog', $data);
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
            $affected_row = $this->BlogModel->update($id, $data['blog']);
            if ($affected_row) {
                $this->session->set_flashdata('success', 'Post successfully updated.');
            } else {
                $this->session->set_flashdata('failed', 'Post failed updated.');
            }
        }

        return $this->load->view('edit-blog', $data);
    }

    public function delete($id)
    {
        $affected_row = $this->BlogModel->delete($id);

        if ($affected_row) {
            $this->session->set_flashdata('success', 'Post successfully deleted.');
        } else {
            $this->session->set_flashdata('failed', 'Post failed deleted.');
        }

        return redirect('/');
    }
}