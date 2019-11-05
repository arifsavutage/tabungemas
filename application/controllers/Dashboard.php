<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_tedagt');
        $this->load->model('model_emas');
        $this->load->model('model_transaksi');

        not_login();
    }

    public function index()
    {
        $id = $this->session->userdata('id');

        if ($this->session->userdata['role'] == 'member') {
            $page = 'pages/member/member_dashboard';
        } else {
            $page = 'pages/dashboard_pages';
        }

        $data = [
            'harga_emas' => $this->model_emas->getNewHarga(),
            'saldo_rp'  => $this->model_transaksi->getLastTranById($id, 'uang'),
            'saldo_emas'  => $this->model_transaksi->getLastTranById($id, 'emas'),
            'page' => $page
        ];
        $this->load->view('dashboard', $data);
    }
}
