<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_biayacetak extends CI_Model
{

    private $_table = 'tb_biaya_cetak';

    public $jml_gram;
    public $biaya;

    public function getAll()
    {
        $this->db->order_by('idx', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }
}
