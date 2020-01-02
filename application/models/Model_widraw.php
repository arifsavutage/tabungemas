<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_widraw extends CI_Model
{

    private $_table = "tb_widraw";

    public $tgl_pengajuan;
    public $idted;
    public $nominal;
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

    public function save()
    {

        $post   = $this->input->post();

        $this->tgl_pengajuan = date('Y-m-d');
        $this->idted    = $post['idted'];
        $this->nominal  = $post['nominal'];
        $this->bankagt  = $post['bankagt'];
        $this->rekagt   = $post['nrkagt'];
        $this->anagt    = $post['anagt'];
        $this->status   = 0;
        $this->tgl_cair = "0000-00-00";

        $this->db->insert($this->_table, $this);
    }
}
