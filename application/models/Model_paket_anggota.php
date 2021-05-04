<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_paket_anggota extends CI_Model
{

    private $_table = 'tb_agt_paket';

    function save($data)
    {
        $this->db->insert($this->_table, $data);
    }

    //get all
    function get_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->_table)->result();
    }

    //get all active
    function get_all_active()
    {
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->_table)->result();
    }

    //get by id
    function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row();
    }

    //update
    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
    }
}
