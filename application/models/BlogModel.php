<?php

class BlogModel extends CI_Model {
    public function getBlogs() {
        //raw sql
        // return $this->db->query("SELECT * FROM blogs");
        
        return $this->db->get("blogs");
    }
    
    public function getBlog($url) {  
        $this->db->where('url', $url);
        return $this->db->get("blogs");
    }
    
    public function insert($data) {
        $this->db->insert('blogs',$data);
        return $this->db->insert_id();
    }
}