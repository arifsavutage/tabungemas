<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_deposit extends CI_Model{
    private $_table = 'tb_deposit';

    public function save($data){
        return $this->db->insert($this->_table, $data);
    }

    public function update($data){
        $this->db->where('idx', "$data[idx]");
        return $this->db->update($this->_table, $data);
    }

    public function delete($idx){
        $this->db->where('idx', $idx);
        return $this->db->delete($this->_table);
    }

    public function getAll(){
        $query = $this->db->query("SELECT tb_deposit.idx, tb_deposit.tgl_deposit, tb_deposit.idted, tb_agt_ted.nama_lengkap, tb_deposit.nom_deposit, tb_bank.nm_bank, tb_bank.norek, tb_bank.an, tb_deposit.status FROM `tb_deposit`
        LEFT JOIN tb_agt_ted ON tb_agt_ted.idted = tb_deposit.idted
        LEFT JOIN tb_bank ON tb_bank.id = tb_deposit.banktrf
        ORDER BY tb_deposit.idx DESC");
        return $query->result_array();
    }

    public function getById($idx){
        $this->db->where('idx', $idx);
        return $this->db->get($this->_table)->row_array();
    }
}