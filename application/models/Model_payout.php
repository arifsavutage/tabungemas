<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_payout extends CI_Model
{
    private $_table = "tb_payout";

    public function save($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function getAll()
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->_table)->result_array();
    }

    public function update($data)
    {
        return $this->db->update($this->_table, $data, ['id' => $data['id']]);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function getByArray($array)
    {
        $this->db->where_in('id', $array);
        return $this->db->get($this->_table)->result_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
    }

    public function get_where_in($str_arr)
    {
        $this->db->where_in('id', $str_arr);
        return $this->db->get($this->_table)->result();
    }
}
