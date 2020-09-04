<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_payouttrans extends CI_Model
{
    private $_table  = 'tb_payout_trans';

    public function getDana($idpayout)
    {

        $this->db->select("tb_payout_trans.id, tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_payout.id, tb_payout.nama_payout, tb_payout_trans.nominal, tb_payout_trans.tgl_transaksi");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_payout_trans.idted', 'left');
        $this->db->join('tb_payout', 'tb_payout.id	= tb_payout_trans.payout_id', 'left');
        $this->db->where('tb_payout.id', $idpayout);
        $this->db->order_by('tb_payout_trans.tgl_transaksi', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }
}
