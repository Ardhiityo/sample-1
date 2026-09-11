<?php

class BlogModel extends CI_Model
{
    public function getBlogs($limit, $offset)
    {
        $find = $this->input->get('find');
        $this->db->order_by('title', 'date');
        $this->db->like("title", $find);

        return $this->db->get('blogs', $limit, $find ? 0 : $offset);
    }

    public function getTotalBlogs()
    {
        $find = $this->input->get('find');
        $this->db->like("title", $find);

        return $this->db->count_all_results('blogs');
    }

    public function getBlog($field, $value)
    {
        $this->db->where($field, $value);

        return $this->db->get("blogs");
    }

    public function insert($data)
    {
        $this->db->insert('blogs', $data);

        return $this->db->affected_rows();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('blogs', $data);

        return true;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('blogs');

        return $this->db->affected_rows();
    }
}