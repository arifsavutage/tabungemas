<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_bank extends CI_Model
{

    private $_table = 'tb_bank';

    public $nm_bank;
    public $norek;
    public $an;

    public function save()
    {
        $post   = $this->input->post();

        $this->nm_bank  = $post['namabank'];
        $this->norek    = $post['norek'];
        $this->an       = $post['an'];

        return $this->db->insert($this->_table, $this);
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }
}
