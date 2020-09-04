<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_jaringan extends CI_Model
{
    private $_table = 'tb_jaringan';

    public $idagt;
    public $idreferal;
    public $idupline;
    public $jml_downline;
    public $pos_jar;
    public $pos_level;
    public $tgl_proses;

    public function cekUpline($idupline)
    {
        return $this->db->get_where($this->_table, ['idagt' => $idupline])->row_array();
    }

    public function updateUpline($dataup)
    {
        $this->db->update($this->_table, $dataup, ['idagt' => $dataup['idagt']]);
    }

    public function daftarReferalId($idted)
    {
        $this->db->select('tb_agt_ted.idted, tb_agt_ted.tgl_gabung, tb_agt_ted.nama_lengkap, tb_jaringan.pos_level');
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_jaringan.idagt', 'left');
        $this->db->where('tb_jaringan.idreferal', $idted);
        $this->db->order_by('tb_agt_ted.tgl_gabung', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }

    public function myReferalId($idted)
    {
        $this->db->where('idagt', $idted);
        return $this->db->get($this->_table)->row();
    }

    public function save($data)
    {
        $this->idagt        = $data['idagt'];
        $this->idreferal    = $data['refid'];
        $this->idupline     = $data['uplineid'];
        $this->jml_downline = $data['jmldown'];
        $this->pos_jar      = $data['posjar'];
        $this->pos_level    = $data['poslvl'];
        $this->tgl_proses   = $data['tglproses'];

        $this->db->insert($this->_table, $this);
    }

    public function ambilPosJar($id)
    {
        $this->db->where('idagt', "$id");
        return $this->db->get($this->_table)->row_array();
    }

    public function ambilJaringan($posjar, $id, $poslvl)
    {
        $query  = $this->db->query("SELECT tb_agt_ted.idted, tb_agt_ted.nama_lengkap, 
        tb_jaringan.pos_jar, (tb_jaringan.pos_level - $poslvl) AS new_lvl 
        FROM tb_agt_ted, tb_jaringan
        WHERE
        tb_agt_ted.idted = tb_jaringan.idagt
        AND
        tb_jaringan.pos_jar LIKE '$posjar%'
        AND
        tb_agt_ted.idted <> '$id'
        ORDER BY tb_jaringan.pos_level ASC
        ");

        return $query->result_array();
    }
}
