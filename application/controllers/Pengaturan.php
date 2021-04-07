<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_bank');
        $this->load->model('Model_biayacetak');

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

    public function hadiah_reward_poin($page = null)
    {
        if ($page == null) {
            $dbs = $this->db->get('tb_hadiah_poin')->result_array();
            $data = [
                'reward' => $dbs,
                'page'  => 'pages/admin/reward_poin_list'
            ];

            $this->load->view('dashboard', $data);
        } else {

            switch ($page) {
                case 'add':
                    $this->form_validation->set_rules('jmlpoin', 'Jumlah Poin', 'trim|required');
                    $this->form_validation->set_rules('judul', 'Judul Hadiah', 'trim|required');

                    if ($this->form_validation->run()) {

                        $judul  = $this->input->post('judul');
                        $poin   = $this->input->post('jmlpoin');
                        $ket    = $this->input->post('ket');

                        //upload image ke server
                        $this->load->library('upload');

                        $breakname  = explode(".", $_FILES['gambar']['name']);
                        $newname    = str_replace(" ", "_", $judul) . "." . $breakname[1];

                        $config['file_name']        = $newname;
                        $config['upload_path']      = './assets/images/reward/';
                        $config['allowed_types']    = 'jpg|jpeg|png';
                        $config['overwrite']        = TRUE;
                        $config['max_size']         = 3000;
                        $config['max_width']        = 1024;
                        $config['max_height']       = 760;

                        $this->upload->initialize($config);

                        if ($_FILES['gambar']['name']) {
                            if (!$this->upload->do_upload('gambar')) {

                                //jika gagal upload
                                $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                                </div>');

                                redirect(base_url() . 'index.php/pengaturan/hadiah_reward_poin/');
                            } else {
                                //jika berhasil
                                $uploaded = $this->upload->data();

                                $data   = [
                                    'judul' => $judul,
                                    'target_poin' => $poin,
                                    'keterangan' => $ket,
                                    'gambar' => $uploaded['file_name']
                                ];

                                //$updated = $this->model_tedagt->update($data);
                                $updated = $this->db->insert('tb_hadiah_poin', $data);

                                if ($updated) {
                                    $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4>Success, </h4> upload berhasil ...
                                    </div>');

                                    redirect(base_url() . 'index.php/pengaturan/hadiah_reward_poin/');
                                } else {
                                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                                    </div>');

                                    redirect(base_url() . 'index.php/pengaturan/hadiah_reward_poin/');
                                }
                            }
                        }
                    }
                    $data = [
                        'reward' => $this->model_bank->getAll(),
                        'page'  => 'pages/admin/reward_poin_add'
                    ];

                    break;
            }

            $this->load->view('dashboard', $data);
        }
    }

    public function biaya_cetak($page = null, $id = null)
    {
        if ($page == null) {
            $data = [
                'biaya' => $this->Model_biayacetak->getAll(),
                'page'  => 'pages/admin/biaya_cetak_list'
            ];

            $this->load->view('dashboard', $data);
        } else {
            switch ($page) {
                case 'add':
                    $data = [
                        'action' => 'index.php/pengaturan/biaya_cetak_add',
                        'title' => 'Tambah Biaya Cetak',
                        'idx'   => set_value('idx'),
                        'jml_gram' => set_value('jml_gram'),
                        'biaya' => set_value('biaya'),
                        'ket' => set_value('ket'),
                        'page'  => 'pages/admin/biaya_cetak_form'
                    ];

                    $this->load->view('dashboard', $data);
                    break;
                case 'edit':
                    if ($id == null) {
                        $this->session->set_flashdata('info', ' <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>WARNING: </h4> Data tidak ditemukan ...
                        </div>');

                        redirect(base_url('index.php/pengaturan/biaya_cetak'));
                    } else {
                        $detail = $this->Model_biayacetak->get_by_id($id);
                        //print_r(var_dump($detail));
                        $data = [
                            'action' => 'index.php/pengaturan/biaya_cetak_edit',
                            'title' => 'Ubah Biaya Cetak',
                            'idx'   => set_value('idx', $detail->idx),
                            'jml_gram' => set_value('jml_gram', $detail->jml_gram),
                            'biaya' => set_value('biaya', $detail->biaya),
                            'ket' => set_value('ket', $detail->ket),
                            'page'  => 'pages/admin/biaya_cetak_form'
                        ];

                        $this->load->view('dashboard', $data);
                    }

                    break;
            }
        }
    }

    public function biaya_cetak_add()
    {
        $this->form_validation->set_rules('jml_gram', 'Jumlah Gram', 'trim|required');
        $this->form_validation->set_rules('biaya', 'Biaya Cetak', 'trim|required');

        $this->form_validation->set_message('required', 'tidak boleh kosong');

        if ($this->form_validation->run()) {
            $gram   = $this->input->post('jml_gram');
            $biaya  = $this->input->post('biaya');
            $ket    = $this->input->post('ket');

            $data_in = [
                'jml_gram'  => $gram,
                'biaya' => $biaya,
                'ket' => $ket
            ];

            $this->Model_biayacetak->save($data_in);

            $this->session->set_flashdata('info', ' <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>SUCCESS: </h4> Tambah biaya cetak berhasil ...
            </div>');

            redirect(base_url('index.php/pengaturan/biaya_cetak'));
        }
    }

    public function biaya_cetak_edit()
    {
        $this->form_validation->set_rules('jml_gram', 'Jumlah Gram', 'trim|required');
        $this->form_validation->set_rules('biaya', 'Biaya Cetak', 'trim|required');

        $this->form_validation->set_message('required', 'tidak boleh kosong');

        if ($this->form_validation->run()) {
            $id     = $this->input->post('idx');
            $gram   = $this->input->post('jml_gram');
            $biaya  = $this->input->post('biaya');
            $ket    = $this->input->post('ket');

            $data_up = [
                'jml_gram'  => $gram,
                'biaya' => $biaya,
                'ket' => $ket
            ];

            $this->Model_biayacetak->update($id, $data_up);

            $this->session->set_flashdata('info', ' <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>SUCCESS: </h4> Ubah biaya cetak berhasil ...
            </div>');

            redirect(base_url('index.php/pengaturan/biaya_cetak'));
        }
    }
}
