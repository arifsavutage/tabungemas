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

    public function updatebyID($data)
    {
        $this->db->where('idx', "$data[idx]");
        return $this->db->update($this->_table, $data);
    }

    public function delete($idx)
    {
        $this->db->where('idx', $idx);
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
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.idx, tb_history.`tgl`, 
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
        $this->db->like('tb_history.ket', 'jual emas');
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getAllTarik()
    {
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.idx, tb_history.`tgl`, 
        tb_history.`idted`, tb_history.`ket`, tb_history.`nominal_uang`, tb_history.`nominal_gram`, tb_history.`status`");
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_history.idted');
        $this->db->where('tb_history.ket', 'tarik fisik');
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getJualAntarID($id)
    {
        $this->db->select("tb_history.idx, tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.`tgl`, 
        tb_history.`idted`, tb_history.`ket`, tb_history.`nominal_uang`, tb_history.`nominal_gram`, tb_history.`status`");
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_history.idted');
        $this->db->where('tb_history.tujuan_jual', $id);
        $this->db->where('tb_history.status', '0');
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();
    }

    public function jualanID($id)
    {
        /*$this->db->select("tb_agt_ted.nama_lengkap, tb_agt_ted.nohp, tb_history.`tgl`, 
        tb_history.`tujuan_jual`, tb_history.`ket`, tb_history.`nominal_uang`, 
        tb_history.`nominal_gram`, tb_history.`status`, tb_history.idx");

        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_history.tujuan_jual', 'left');
        $this->db->where('tb_history.tujuan_jual !=', 'TED');
        $this->db->where('tb_agt_ted.idted', $id);
        $this->db->order_by('tb_history.tgl', 'DESC');
        return $this->db->get()->result_array();*/

        $qry = $this->db->query("SELECT tb_history.idx, tb_history.tgl, tb_history.idted, tb_history.tujuan_jual, tb_agt_ted.nama_lengkap, tb_history.nominal_uang, tb_history.nominal_gram, tb_history.status FROM `tb_history` LEFT JOIN tb_agt_ted ON tb_agt_ted.idted = tb_history.tujuan_jual WHERE tb_history.tujuan_jual != 'TED' AND tb_history.idted = '$id' ORDER BY tb_history.tgl DESC");

        return $qry->result_array();
    }

    public function getjualanByIdx($idx)
    {
        return $this->db->get_where($this->_table, ['idx' => $idx])->row_array();
    }
}
