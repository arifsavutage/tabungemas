<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_user extends CI_Model
{

    private $_table = 'tb_user';

    public function getLogin($email)
    {
        $this->db->select("tb_user.`id`, `nama_user`, `email`, `password`, `is_active`, foto, tb_user_role.role_name");
        $this->db->join('tb_user_role', 'tb_user_role.id = tb_user.role_id', 'left');
        $this->db->where('email', $email);
        return $this->db->get($this->_table)->row_array();
    }
}
