<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_emas extends CI_Model
{

    private $_table = "t_update_ubs";

    public $UPDATE_AT;
    public $HRG_BELI;
    public $HRG_JUAL;

    public function getNewHarga()
    {
        $this->db->order_by('UPDATE_AT', 'DESC');
        $this->db->limit(2);
        return $this->db->get($this->_table)->result_array();
    }

    public function getLastUpdate()
    {
        $this->db->order_by('UPDATE_AT', 'DESC');
        $this->db->limit(1);
        return $this->db->get($this->_table)->row_array();
    }

    public function getHargaEmas()
    {
        $this->db->order_by('UPDATE_AT', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }
}
