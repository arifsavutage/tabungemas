<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_widraw extends CI_Model
{

    private $_table = "tb_widraw";

    public $tgl_pengajuan;
    public $idted;
    public $nominal;
    public $biaya_adm;
    public $bankagt;
    public $rekagt;
    public $anagt;
    public $status;
    public $tgl_cair;

    public function rules()
    {
        return [
            [
                'field' => 'nominal',
                'label' => 'Nominal Uang',
                'rules' => 'required'
            ],
            [
                'field' => 'idted',
                'label' => 'ID Anggota',
                'rules' => 'required'
            ],
            [
                'field' => 'bankagt',
                'label' => 'Bank Transfer',
                'rules' => 'required'
            ],
            [
                'field' => 'nrkagt',
                'label' => 'No. Rek. Tujuan',
                'rules' => 'required'
            ],
            [
                'field' => 'anagt',
                'label' => 'An. Anggota',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        $this->db->select("tb_widraw.`idx`, tb_widraw.`tgl_pengajuan`, tb_widraw.`idted`, 
        tb_widraw.`nominal`, tb_widraw.`biaya_adm`, tb_widraw.`bankagt`, tb_widraw.`rekagt`, 
        tb_widraw.`anagt`, tb_widraw.`status`, tb_widraw.`tgl_cair`, tb_agt_ted.`nama_lengkap`,
        tb_agt_ted.`nohp`,tb_agt_ted.`norek`,tb_agt_ted.`bank`,tb_agt_ted.`an`");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_widraw.idted');
        $this->db->order_by('tb_widraw.tgl_pengajuan', 'DESC');

        return $this->db->get($this->_table)->result_array();
    }

    public function getByDateRange($tgl1, $tgl2)
    {
        $this->db->select("tb_widraw.`idx`, tb_widraw.`tgl_pengajuan`, tb_widraw.`idted`, 
        tb_widraw.`nominal`, tb_widraw.`biaya_adm`, tb_widraw.`bankagt`, tb_widraw.`rekagt`, 
        tb_widraw.`anagt`, tb_widraw.`status`, tb_widraw.`tgl_cair`, tb_agt_ted.`nama_lengkap`,
        tb_agt_ted.`nohp`,tb_agt_ted.`norek`,tb_agt_ted.`bank`,tb_agt_ted.`an`");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_widraw.idted');
        $this->db->where('tb_widraw.tgl_pengajuan >=', $tgl1);
        $this->db->where('tb_widraw.tgl_pengajuan <=', $tgl2);
        $this->db->order_by('tb_widraw.tgl_pengajuan', 'DESC');

        return $this->db->get($this->_table)->result_array();
    }

    public function getByIdx($idx)
    {
        $this->db->select("tb_widraw.`idx`, tb_widraw.`tgl_pengajuan`, tb_widraw.`idted`, 
        tb_widraw.`nominal`, tb_widraw.`biaya_adm`, tb_widraw.`bankagt`, tb_widraw.`rekagt`, 
        tb_widraw.`anagt`, tb_widraw.`status`, tb_widraw.`tgl_cair`, tb_agt_ted.`nama_lengkap`,
        tb_agt_ted.`nohp`,tb_agt_ted.`norek`,tb_agt_ted.`bank`,tb_agt_ted.`an`");
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_widraw.idted');
        $this->db->order_by('tb_widraw.tgl_pengajuan', 'DESC');
        $this->db->where('tb_widraw.idx', $idx);

        return $this->db->get($this->_table)->row_array();
    }

    public function save()
    {

        $post   = $this->input->post();

        $this->tgl_pengajuan = date('Y-m-d');
        $this->idted    = $post['idted'];
        $this->nominal  = $post['nominal'];
        $this->biaya_adm = $post['byadmin'];
        $this->bankagt  = $post['bankagt'];
        $this->rekagt   = $post['nrkagt'];
        $this->anagt    = $post['anagt'];
        $this->status   = 0;
        $this->tgl_cair = "0000-00-00";

        $this->db->insert($this->_table, $this);
    }

    public function update($data)
    {
        $this->db->where('idx', $data['idx']);
        return $this->db->update($this->_table, $data);
    }

    public function hapus($idx)
    {
        $this->db->where('idx', $idx);
        return $this->db->delete($this->_table);
    }
}
