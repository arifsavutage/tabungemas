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

    public function loadAktif()
    {
        $this->db->where('status', 'aktif');
        $this->db->order_by('idx', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }

    public function updateBerhenti($idx)
    {
        $this->db->where('idx', $idx);
        return $this->db->update($this->_table, ['status' => 'berhenti']);
    }

    public function approve($idx)
    {
        $this->db->where('idx', $idx);
        return $this->db->update($this->_table, ['status' => 'aktif']);
    }

    //Tabel Titipan Detail
    public function adddetail($data)
    {
        return $this->db->insert('tb_titipan_emas_detail', $data);
    }

    public function totalProfitById($idted)
    {
        $this->db->select("tb_titipan_emas_detail.`id_titipan`, tb_titipan_emas.tgl_ikut, tb_titipan_emas.tgl_berakhir, tb_titipan_emas.tenor, tb_titipan_emas.gram, tb_titipan_emas.harga_ikut, tb_titipan_emas.idted, tb_titipan_emas.status, SUM(tb_titipan_emas_detail.`profit_persen`) AS totalpersen");
        $this->db->from('tb_titipan_emas_detail');
        $this->db->join($this->_table, 'tb_titipan_emas.idx = tb_titipan_emas_detail.id_titipan', 'left');
        $this->db->where('tb_titipan_emas.idted', $idted);
        $this->db->group_by('tb_titipan_emas_detail.id_titipan');
        $this->db->order_by('tb_titipan_emas_detail.id_titipan', 'DESC');
        return $this->db->get()->result_array();
    }
    //Pivot Detail Profit Titipan Emas
    /*SELECT `idted`, 
SUM(IF(DATE_FORMAT(`periode`, '%m') = '01', `profit_persen`, 0)) AS jan,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '02', `profit_persen`, 0)) AS feb,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '03', `profit_persen`, 0)) AS mar,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '04', `profit_persen`, 0)) AS apr,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '05', `profit_persen`, 0)) AS mei,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '06', `profit_persen`, 0)) AS jun,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '07', `profit_persen`, 0)) AS jul,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '08', `profit_persen`, 0)) AS agt,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '09', `profit_persen`, 0)) AS sep,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '10', `profit_persen`, 0)) AS okt,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '11', `profit_persen`, 0)) AS nov,
SUM(IF(DATE_FORMAT(`periode`, '%m') = '12', `profit_persen`, 0)) AS des,
SUM(profit_persen) AS total_profit
FROM `tb_titipan_emas_detail` 
WHERE YEAR(`periode`) = '2020' GROUP By id_titipan ORDER By idted ASC
*/
}
