<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_titipan extends CI_Model
{

    private $_table = 'tb_titipan_emas';

    public $idted;
    public $tgl_ikut;
    public $tgl_berakhir;
    public $tenor;
    public $gram;
    public $harga_ikut;
    public $jml_uang;

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function getById($idted)
    {
        $this->db->where('idted', $idted);
        $this->db->order_by('idx', 'DESC');
        return $this->db->get($this->_table)->result_array();
    }

    public function getAll()
    {
        $this->db->select("`tb_titipan_emas`.`idx`, `tb_titipan_emas`.`idted`, `tb_titipan_emas`.`tgl_ikut`, `tb_titipan_emas`.`tgl_berakhir`, `tb_titipan_emas`.`tenor`, `tb_titipan_emas`.`gram`, `tb_titipan_emas`.`harga_ikut`, `tb_titipan_emas`.`jml_uang`, `tb_titipan_emas`.`status`, tb_agt_ted.nama_lengkap");
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_titipan_emas.idted', 'left');
        return $this->db->get()->result_array();
    }

    public function approve($idx)
    {
        $this->db->where('idx', $idx);
        return $this->db->update($this->_table, ['status' => 'aktif']);
    }
}
