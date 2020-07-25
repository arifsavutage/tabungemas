<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_tmpagt extends CI_Model
{

    private $_table = 'tb_agt_tmp';

    public $tgl_daftar;
    public $nm_tmp;
    public $role_id;
    public $nohp_tmp;
    public $email_tmp;
    public $ktp_tmp;
    public $password_tmp;
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
                'field' => 'jenis',
                'label' => 'Jenis Keanggotaan',
                'rules' => 'required'
            ],
            [
                'field' => 'ktp',
                'label' => 'No. KTP',
                'rules' => 'required|min_length[16]',
                'errors' => [
                    'min_length' => '%s setidaknya 16 karakter'
                ]
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
        $this->nm_tmp       = $post['nama'];
        $this->role_id      = $post['jenis'];
        $this->nohp_tmp     = $post['nohp'];
        $this->email_tmp    = $post['email'];
        $this->ktp_tmp      = $post['ktp'];
        $this->password_tmp = password_hash($post['password'], PASSWORD_DEFAULT);
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

    public function getRelationAll()
    {
        $this->db->select('tb_agt_tmp.*, tb_agt_ted.idted, tb_agt_ted.`nama_lengkap`, tb_agt_ted.`nohp`, tb_agt_ted.`alamat`, tb_agt_ted.`email`, tb_agt_ted.`role_id` AS roleref, tb_agt_ted.`foto_profil`');
        $this->db->from($this->_table);
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_agt_tmp.idreferal');
        return $this->db->get()->result_array();
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
        $this->db->where('email_tmp', "$email");
        return $this->db->get($this->_table)->row_array();
    }

    //cek ktp dari tb_agt_ted
    public function getAccountByKtp($ktp)
    {
        $this->db->where('noktp', $ktp);
        return $this->db->get('tb_agt_ted')->row_array();
    }

    public function delete($id)
    {
        $this->db->where('idtmp', $id);
        return $this->db->delete($this->_table);
    }
}
