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
}
