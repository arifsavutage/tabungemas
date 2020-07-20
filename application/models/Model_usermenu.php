<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Model_usermenu extends CI_Model
{
    private $_table = 'tb_user_menu';

    public $title;
    public $url;
    public $icon;
    public $parent_menu;
    public $is_active;

    public function rules()
    {
        return [
            [
                'field' => 'title',
                'label' => 'Title Menu',
                'rules' => 'required'
            ],
            [
                'field' => 'url',
                'label' => 'URL Menu',
                'rules' => 'required'
            ]
        ];
    }

    public function save()
    {
        $post = $this->input->post();

        $this->title        = $post['title'];
        $this->url          = $post['url'];
        $this->icon         = $post['icon'];
        $this->parent_menu  = $post['parent'];
        $this->is_active    = $post['status'];

        return $this->db->insert($this->_table, $this);
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getParent()
    {
        return $this->db->get_where($this->table, ['parent_menu' => 0, 'is_active' => 1])->result_array();
    }

    public function getAccessMenu()
    {
        $this->db->select("SELECT tb_user_menu_access.`id`, `role_id`, `menu_id`, tb_user_role.role_name, tb_user_menu.title, tb_user_menu.url, tb_user_menu.icon, tb_user_menu.parent_menu, tb_user_menu.is_active");
        $this->db->join('tb_user_role', 'tb_user_role.id = tb_user_menu_access.role_id', 'left');
        $this->db->join($this->_table, 'tb_user_menu.id = tb_user_menu_access.menu_id', 'left');
        return $this->db->get('tb_user_menu_access')->result_array();
    }
}
