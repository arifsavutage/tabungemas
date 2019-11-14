<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_transaksi extends CI_Model
{
    private $_table = "tb_transaksi";

    public $tgl;
    public $idted;
    public $uraian;
    public $masuk;
    public $keluar;
    public $saldo;


    public function getTransactionById($id, $jenis)
    {
        /**
         * SELECT tb_transaksi.`id`, tb_transaksi.`tgl`, tb_transaksi.`idted`, 
         * tb_transaksi.`uraian`, tb_transaksi.`masuk`, tb_transaksi.`keluar`, 
         * tb_transaksi.`saldo`, tb_agt_ted.nama_lengkap, tb_agt_ted.bank, tb_agt_ted.norek 
         * FROM `tb_transaksi` 
         * JOIN tb_agt_ted ON tb_agt_ted.idted = tb_transaksi.idted 
         * WHERE tb_transaksi.idted = '01.00001'
         */

        $this->db->select("tb_transaksi.`id`, tb_transaksi.`tgl`, tb_transaksi.`idted`, tb_transaksi.`uraian`, tb_transaksi.`masuk`, tb_transaksi.`keluar`, tb_transaksi.`saldo`, tb_agt_ted.nama_lengkap, tb_agt_ted.bank, tb_agt_ted.norek");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_transaksi.idted');
        $this->db->where('tb_transaksi.idted', "$id");
        $this->db->where('tb_transaksi.jenis', "$jenis");
        $this->db->order_by('tb_transaksi.id', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getFirstTransaction($id, $jenis)
    {
        $this->db->select("tb_transaksi.`id`, tb_transaksi.`tgl`, tb_transaksi.`idted`, tb_transaksi.`uraian`, tb_transaksi.`masuk`, tb_transaksi.`keluar`, tb_transaksi.`saldo`, tb_agt_ted.nama_lengkap, tb_agt_ted.bank, tb_agt_ted.norek");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_transaksi.idted');
        $this->db->where('tb_transaksi.idted', "$id");
        $this->db->where('tb_transaksi.jenis', "$jenis");
        $this->db->order_by('tb_transaksi.id', 'ASC');
        $this->db->limit(1);
        return $this->db->get($this->_table)->row_array();
    }

    public function getLastTranById($id, $jenis)
    {
        $this->db->select("tb_transaksi.`id`, tb_transaksi.`tgl`, tb_transaksi.`idted`, tb_transaksi.`uraian`, tb_transaksi.`masuk`, tb_transaksi.`keluar`, tb_transaksi.`saldo`, tb_agt_ted.nama_lengkap, tb_agt_ted.bank, tb_agt_ted.norek");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_transaksi.idted');
        $this->db->where('tb_transaksi.idted', "$id");
        $this->db->where('tb_transaksi.jenis', "$jenis");
        $this->db->order_by('tb_transaksi.id', 'DESC');
        $this->db->limit(1);
        return $this->db->get($this->_table)->row_array();
    }

    public function allTransaction()
    {
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get($this->_table);
    }

    public function topTransaction()
    {
        $this->db->order_by('tgl', 'DESC');
        $this->db->limit(20);
        return $this->db->get($this->_table);
    }

    public function save($data)
    {
        $this->db->insert($this->_table, $data);
    }
}
