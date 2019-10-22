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

    public function jmlIdCabang($idcabang)
    {
        $this->db->like('idted', "$idcabang", 'after');
        $this->db->order_by('tgl_gabung', 'DESC');
        return $this->db->get($this->_table)->num_rows();

        // $query  = $this->db->query("SELECT * FROM " . $this->_table . " WHERE idted LIKE '$idcabang%' ORDER BY tgl_gabung DESC");
        // return $query->num_rows();
    }

    public function akunAktif($data)
    {
        $this->db->update($this->_table, $data, ['idted' => $data['idted']]);
    }

    public function getAccountByEmail($email)
    {
        $this->db->where('email', "$email");
        return $this->db->get($this->_table)->row_array();
    }

    public function getAccountById($id)
    {
        $this->db->where('idted', "$id");
        return $this->db->get($this->_table)->row_array();
    }

    public function save($id = null, $level = null)
    {
        $post   = $this->input->post();
        if ($id != null && $level != null) {
            $this->idted        = $id;
            $this->tgl_gabung   = date('Y-m-d');
            $this->nama_lengkap = ucwords($post['nama']);
            $this->nohp         = $post['nohp'];
            $this->alamat       = "";
            $this->email        = $post['email'];
            $this->password     = password_hash($post['password'], PASSWORD_DEFAULT);
            $this->level_user   = $level;
            $this->scan_ktp     = "noimage.jpg";
            $this->scan_npwp    = "noimage.jpg";
            $this->foto_profil  = "noimage.jpg";
            $this->aktif        = 0;

            $this->db->insert($this->_table, $this);
        }
    }
}
