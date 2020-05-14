<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class node_model extends CI_Model
{
    public function getBlock($id=null)
    {
        if ($id==null){
            return $this->db->get('blockchain')->result_array();
        }
        else{
            return $this->db->get_where('blockchain',['id'=>$id])->result_array();
        }
        
    }

    public function getLast()
    {
        $this->load->database();
        $last = $this->db->order_by('id',"desc")->limit(1)->get('blockchain')->row();
        return $last;
    }

    public function createBlock($data)
    {
        $this->db->insert('blockchain', $data);
        return $this->db->affected_rows();
    }

    public function updateData($data,$id)
    {
        $this->db->update('blockchain', $data,['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function deleteTable()
    {
        $this->db->truncate('blockchain'); 
    }    

}