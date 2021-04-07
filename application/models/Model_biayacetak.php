<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_biayacetak extends CI_Model
{

    private $_table = 'tb_biaya_cetak';

    public function getAll()
    {
        $this->db->order_by('jml_gram', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }

    public function save($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function get_by_id($id)
    {
        $this->db->where('idx', $id);
        return $this->db->get($this->_table)->row();
    }

    public function update($id, $data)
    {
        $this->db->where('idx', $id);
        $this->db->update($this->_table, $data);
    }
}
