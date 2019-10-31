<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_tedagt');

        not_login();
    }

    public function index()
    {
        if ($this->session->userdata['role'] == 'member') {
            $page = 'pages/member/member_dashboard';
        } else {
            $page = 'pages/dashboard_pages';
        }

        $data = [
            'page' => $page
        ];
        $this->load->view('dashboard', $data);
    }
}
