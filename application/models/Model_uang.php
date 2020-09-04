<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_uang extends CI_Model
{
    private $_table = 'tb_bonus';

    public $registrasi;
    public $referal;
    public $royalti;
    public $royalti_target;
    public $gram_pokok;
    public $selisih_hrg_emas;

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getValueById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function update($data)
    {
        return $this->db->update($this->_table, $data, ['id' => $data['id']]);
    }
}
