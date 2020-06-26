<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_bank');

        not_login();
    }

    public function rekening()
    {
        $data = [
            'banks' => $this->model_bank->getAll(),
            'page'  => 'pages/admin/daftar_bank'
        ];

        $this->load->view('dashboard', $data);
    }

    public function add_rekening()
    {
        $this->form_validation->set_rules('namabank', 'Nama Bank', 'required');

        if ($this->form_validation->run()) {
            /*
            $bank   = $this->input->post('namabank');
            $norek  = $this->input->post('norek');
            $an     = $this->input->post('an');
            */

            $this->model_bank->save();
            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success</h4> Tambah rekening berhasil ... 
            </div>');

            redirect(base_url() . "index.php/pengaturan/rekening");
        }

        $data = [
            'page'  => 'pages/admin/add_bank'
        ];

        $this->load->view('dashboard', $data);
    }

    public function hapus_rekening($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {
            $this->model_bank->hapus($id);
            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success</h4> Hapus rekening berhasil ... 
            </div>');

            redirect(base_url() . "index.php/pengaturan/rekening");
        }
    }
}
