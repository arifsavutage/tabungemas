<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_verifikasi extends CI_Model
{
    private $_table = 'tb_verifikasi_email';

    public $token;
    public $idagt;
    public $status;

    public function save($data)
    {

        $this->token = $data['token'];
        $this->idagt = $data['idagt'];
        $this->status = $data['status'];

        $this->db->insert($this->_table, $this);
    }

    public function verify($data)
    {
        return $this->db->update($this->_table, $data, ['token' => $data['token']]);
    }

    public function getID($token)
    {
        $this->db->where('token', "$token");
        return $this->db->get($this->_table)->row();
    }
}
