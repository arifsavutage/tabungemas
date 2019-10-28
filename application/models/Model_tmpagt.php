<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_tmpagt extends CI_Model
{

    private $_table = 'tb_agt_tmp';

    public $tgl_daftar;
    public $nama_lengkap;
    public $nohp;
    public $email;
    public $password;
    public $idreferal;
    public $nominal;
    public $konfirm_status;
    public $token;

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

    public function save($data)
    {
        $post = $this->input->post();

        $this->tgl_daftar   = date('Y-m-d');
        $this->nama_lengkap = $post['nama'];
        $this->nohp         = $post['nohp'];
        $this->email        = $post['email'];
        $this->password     = password_hash($post['password'], PASSWORD_DEFAULT);
        $this->idreferal    = "$data[referal]";
        $this->nominal      = $data['nominal'];
        $this->konfirm_status = $data['status'];
        $this->token        = $data['token'];

        $this->db->insert($this->_table, $this);
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function konfirm($data)
    {
        return $this->db->update($this->_table, $data, ['token' => $data['token']]);
    }

    public function getByToken($token)
    {
        $this->db->where('token', "$token");
        return $this->db->get($this->_table)->row_array();
    }

    public function getAccountByEmail($email)
    {
        $this->db->where('email', "$email");
        return $this->db->get($this->_table)->row_array();
    }
}
