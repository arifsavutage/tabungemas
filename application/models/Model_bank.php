<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_bank extends CI_Model
{

    private $_table = 'tb_bank';

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row_array();
    }
}
