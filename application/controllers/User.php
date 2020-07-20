<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->model('model_usermenu');

        not_login();
    }

    public function menu_management()
    {
        $data = [
            'role' => $this->model_user->getRole(),
            'access' => $this->model_usermenu->getAll(),
            'page' => 'pages/admin/user_menu_management'
        ];

        $this->load->view('dashboard', $data);
    }
}
