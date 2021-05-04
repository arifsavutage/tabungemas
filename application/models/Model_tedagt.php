<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_tedagt extends CI_Model
{
    private $_table = 'tb_agt_ted';

    public $idted;
    public $tgl_gabung;
    public $nama_lengkap;
    public $noktp;
    public $nohp;
    public $alamat;
    public $email;
    public $password;
    public $role_id;
    public $scan_ktp;
    public $scan_npwp;
    public $foto_profil;
    public $jenis;
    public $aktif;

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
            ],
            [
                'field' => 'agreement',
                'label' => 'Persetujuan',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        $this->db->order_by('tgl_gabung', 'DESC');
        return $this->db->get($this->_table);
    }

    public function newUser()
    {
        $this->db->order_by('tgl_gabung', 'DESC');
        $this->db->limit(20);
        return $this->db->get($this->_table);
    }

    public function jmlIdCabang($idcabang)
    {
        $this->db->like('idted', "$idcabang", 'after');
        $this->db->order_by('tgl_gabung', 'DESC');
        return $this->db->get($this->_table)->num_rows();
    }

    public function akunAktif($data)
    {
        $this->db->update($this->_table, $data, ['idted' => $data['idted']]);
    }

    public function getAccountByEmail($email)
    {
        $this->db->select("`idted`,`nama_lengkap`,`password`,`foto_profil`,`aktif`, role_name, tb_agt_ted.role_id");
        $this->db->join('tb_user_role', 'tb_user_role ON tb_user_role.id = tb_agt_ted.role_id', 'left');
        $this->db->where('email', "$email");
        return $this->db->get($this->_table)->row_array();
    }

    public function getAccountById($id)
    {
        $this->db->where('idted', "$id");
        return $this->db->get($this->_table)->row_array();
    }

    public function numAccountByKtp($ktp)
    {
        $this->db->where('noktp', $ktp);
        return $this->db->get($this->_table);
    }

    public function update($data)
    {
        return $this->db->update($this->_table, $data, ['idted' => "$data[idted]"]);
    }

    public function save($id = null, $level = null)
    {
        $post   = $this->input->post();
        if ($id != null && $level != null) {
            $this->idted        = $id;
            $this->tgl_gabung   = date('Y-m-d');
            $this->nama_lengkap = ucwords($post['nama']);
            $this->noktp        = $post['noktp'];
            $this->nohp         = $post['nohp'];
            $this->alamat       = "";
            $this->email        = $post['email'];
            $this->password     = $post['password'];
            $this->role_id      = $level;
            $this->scan_ktp     = "noimage.jpg";
            $this->scan_npwp    = "noimage.jpg";
            $this->foto_profil  = "noimage.jpg";
            $this->jenis        = $post['jenis'];
            $this->aktif        = 1;

            $this->db->insert($this->_table, $this);
        }
    }
}
