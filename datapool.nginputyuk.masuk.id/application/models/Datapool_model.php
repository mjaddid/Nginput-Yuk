<?php

class datapool_model extends CI_Model
{
    public function getData($id=null)
    {
        if ($id==null){
            return $this->db->get('pool')->result_array();
        }
        else{
            return $this->db->get_where('pool',['id'=>$id])->result_array();
        }
    }
    
    public function createData($data)
    {
        $this->db->insert('pool', $data);
        return $this->db->affected_rows();
    }

    public function getPending()
    {
        return $this->db->get_where('pool',['status'=>'Menunggu'])->result_array();
    }

    public function updateData($data,$id)
    {
        $this->db->update('pool', $data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function createDataVerifikasi($data)
    {
        $this->db->insert('verifikasi', $data);
        return $this->db->affected_rows();
    }

    public function getDataVerifikasi()
    {
        
        return $this->db->get('verifikasi')->result_array();
    }
}