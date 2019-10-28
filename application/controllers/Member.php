<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_tmpagt');
    }

    public function member_baru()
    {
        $data   = [
            'page'  => 'pages/admin/member_baru',
            'list'  => $this->model_tmpagt->getAll()
        ];

        $this->load->view('dashboard', $data);
    }
}
