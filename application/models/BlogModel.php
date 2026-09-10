<?php

class BlogModel extends CI_Model {
    public function getBlogs() {
        //raw sql
        // return $this->db->query("SELECT * FROM blogs");
        
        return $this->db->get("blogs");
    }
    
    public function getBlog($field, $value) {  
        $this->db->where($field, $value);
        return $this->db->get("blogs");
    }
    
    public function insert($data) {
        $this->db->insert('blogs',$data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
         $this->db->where('id', $id);
         $this->db->update('blogs', $data);
         return $this->db->affected_rows();
    }
         
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('blogs');
        return $this->db->affected_rows();
    }
}