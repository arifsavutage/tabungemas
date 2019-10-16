<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_tedagt extends CI_Model
{
    private $_table = 'tb_agt_ted';

    public $idted;
    public $tgl_gabung;
    public $nama_lengkap;
    public $nohp;
    public $alamat;
    public $email;
    public $password;
    public $level_user;
    public $scan_ktp;
    public $scan_npwp;
    public $foto_profil;

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama sesuai KTP',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'nohp',
                'label' => 'No. Handphone',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]'
            ],
            [
                'field' => 'password2',
                'label' => 'Repeat Password',
                'rules' => 'trim|required|matches[password]'
            ]
        ];
    }

    public function getAll()
    {
        $this->db->order_by($this->tgl_gabung, 'DESC');
        return $this->db->get($this->_table);
    }

    public function save()
    {
        $post   = $this->input->post();
    }
}
