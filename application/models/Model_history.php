<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_history extends CI_Model
{
    private $_table = 'tb_history';


    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($data)
    {
        $this->db->where('idted', "$data[idted]");
        $this->db->where('tgl', "$data[tgl]");
        return $this->db->update($this->_table, $data);
    }

    public function delete($data)
    {
        $this->db->where('idted', "$data[idted]");
        $this->db->where('tgl', "$data[tgl]");
        return $this->db->delete($this->_table);
    }

    public function getAll()
    {
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.*");
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_history.idted');
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getAllBeli()
    {
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.`tgl`, 
        tb_history.`idted`, tb_history.`ket`, tb_history.`nominal_uang`, tb_history.`nominal_gram`, tb_history.`status`");
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_history.idted');
        $this->db->where('tb_history.ket', 'pembelian emas');
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getAllJual()
    {
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.`tgl`, 
        tb_history.`idted`, tb_history.`ket`, tb_history.`nominal_uang`, tb_history.`nominal_gram`, tb_history.`status`");
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_history.idted');
        $this->db->where('tb_history.ket', 'jual emas');
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();
    }
}
