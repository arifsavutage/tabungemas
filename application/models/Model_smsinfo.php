<?php
defined('BASEPATH') or exit('No direct access script allowed');
class Model_smsinfo extends CI_Model
{
    private $_table = "tb_sms_info";

    public $idted;
    public $nohp;
    public $pesan;
    public $is_sent;

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getAll($sent)
    {
        return $this->db->get_where($this->_table, ['is_sent' => $sent])->result_array();
    }

    public function getDetail($id)
    {
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_sms_info.idted');
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function update($data)
    {
        return $this->db->update($this->_table, $data, ['id' => $data['id']]);
    }
}
