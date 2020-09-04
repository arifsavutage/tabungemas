<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_tmpagt');
        $this->load->model('model_tedagt');
        $this->load->model('model_jaringan');
        $this->load->model('model_transaksi');
        $this->load->model('model_history');
        $this->load->model('model_emas');
        $this->load->model('model_uang');
        $this->load->model('model_payout');

        not_login();
    }

    public function member_baru()
    {
        $data   = [
            'page'  => 'pages/admin/member_baru',
            'list'  => $this->model_tmpagt->getRelationAll()
        ];

        $this->load->view('dashboard', $data);
    }

    public function member_list()
    {
        $data   = [
            'page'  => 'pages/admin/member_list',
            'list'  => $this->model_tedagt->getAll()->result_array()
        ];

        $this->load->view('dashboard', $data);
    }

    public function delRegistration($id = null)
    {
        if ($id == null) {
            redirect(base_url() . 'index.php/member/member_baru');
        } else {
            $delete = $this->model_tmpagt->delete($id);

            if ($delete) {
                $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Hapus data member berhasil ... 
            </div>');
                redirect(base_url() . 'index.php/member/member_baru');
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oops :</h4> Hapus data member gagal ... 
            </div>');
                redirect(base_url() . 'index.php/member/member_baru');
            }
        }
    }

    public function profile($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {
            $idreferal  = $this->model_jaringan->myReferalId($id)->idreferal;

            $data = [
                'referalku' => $this->model_tedagt->getAccountById($idreferal),
                'detail' => $this->model_tedagt->getAccountById($id),
                'saldo_rp'  => $this->model_transaksi->getLastTranById($id, 'uang'),
                'saldo_emas'  => $this->model_transaksi->getLastTranById($id, 'emas'),
                'page' => 'pages/member/member_profile'
            ];
            $this->load->view('dashboard', $data);
        }
    }

    public function edit_profile($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('idted', 'No ID', 'required');
            $this->form_validation->set_rules('nmwaris', 'Nama Waris', 'required');
            $this->form_validation->set_rules('hubwaris', 'Hubungan Waris', 'required');
            $this->form_validation->set_rules('hpwaris', 'No. HP Waris', 'required');

            if ($this->form_validation->run()) {
                $idted  = $this->input->post('idted');
                $nohp   = $this->input->post('nohp');
                $alamat = $this->input->post('alamat');
                $norek  = $this->input->post('norek');
                $bank   = $this->input->post('bank');
                $an     = $this->input->post('an');
                $nmwaris    = strtolower($this->input->post('nmwaris'));
                $hubwaris   = strtolower($this->input->post('hubwaris'));
                $hpwaris    = $this->input->post('hpwaris');

                $data = [
                    'idted' => "$idted",
                    'nohp'  => "$nohp",
                    'alamat' => "$alamat",
                    'norek ' => "$norek",
                    'bank'  => "$bank",
                    'an'    => "$an",
                    'nmwaris' => "$nmwaris",
                    'hubwaris' => "$hubwaris",
                    'hpwaris'  => "$hpwaris"
                ];

                $update = $this->model_tedagt->update($data);

                if ($update) {
                    $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Update berhasil ... 
            </div>');

                    redirect(base_url('index.php/member/profile/'));
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oops :</h4> Update gagal ... 
            </div>');

                    redirect(base_url('index.php/member/profile/'));
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page' => 'pages/member/member_profile_edit'
                ];
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function profil_anggota($id = null)
    {
        $idreferal  = $this->model_jaringan->myReferalId($id)->idreferal;
        $data = [
            'referalku' => $this->model_tedagt->getAccountById($idreferal),
            'detail' => $this->model_tedagt->getAccountById($id),
            'saldo_rp'  => $this->model_transaksi->getLastTranById($id, 'uang'),
            'saldo_emas'  => $this->model_transaksi->getLastTranById($id, 'emas'),
            'page' => 'pages/admin/member_profile_admin'
        ];
        $this->load->view('dashboard', $data);
    }

    public function edit_profil_anggota($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('idted', 'No ID', 'required');
            $this->form_validation->set_rules('nmwaris', 'Nama Waris', 'required');
            $this->form_validation->set_rules('hubwaris', 'Hubungan Waris', 'required');
            $this->form_validation->set_rules('hpwaris', 'No. HP Waris', 'required');

            if ($this->form_validation->run()) {
                $idted  = $this->input->post('idted');
                $noktp  = $this->input->post('noktp');
                $nohp   = $this->input->post('nohp');
                $alamat = $this->input->post('alamat');
                $norek  = $this->input->post('norek');
                $bank   = $this->input->post('bank');
                $an     = $this->input->post('an');

                $nmwaris    = strtolower($this->input->post('nmwaris'));
                $ktpwaris   = $this->input->post('ktpwaris');
                $hubwaris   = strtolower($this->input->post('hubwaris'));
                $hpwaris    = $this->input->post('hpwaris');

                $data = [
                    'idted' => "$idted",
                    'noktp'  => "$noktp",
                    'nohp'  => "$nohp",
                    'alamat' => "$alamat",
                    'norek ' => "$norek",
                    'bank'  => "$bank",
                    'an'    => "$an",
                    'nmwaris' => "$nmwaris",
                    'ktpwaris' => $ktpwaris,
                    'hubwaris' => "$hubwaris",
                    'hpwaris'  => "$hpwaris"
                ];

                $update = $this->model_tedagt->update($data);

                if ($update) {
                    $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Update berhasil ... 
            </div>');

                    redirect(base_url() . "index.php/member/profil_anggota/" . $idted);
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oops :</h4> Update gagal ... 
            </div>');

                    redirect(base_url() . "index.php/member/profil_anggota/" . $idted);
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page' => 'pages/admin/edit_profil_admin'
                ];
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function photo_profile($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('idted', 'No ID', 'required');

            if ($this->form_validation->run()) {

                $idted  = $this->input->post('idted');

                //upload image ke server
                $this->load->library('upload');

                $breakname  = explode(".", $_FILES['foto']['name']);
                $newname    = $idted . "." . $breakname[1];

                $config['file_name']        = $newname;
                $config['upload_path']      = './assets/images/avatars/';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['overwrite']        = TRUE;
                $config['max_size']         = 5120;
                $config['max_width']        = 2048;
                $config['max_height']       = 2048;

                $this->upload->initialize($config);

                if ($_FILES['foto']['name']) {
                    if (!$this->upload->do_upload('foto')) {

                        //jika gagal upload
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                        redirect(base_url() . 'index.php/member/photo_profile/' . $idted);
                    } else {
                        //jika berhasil
                        $uploaded = $this->upload->data();

                        $data   = [
                            'idted' => "$idted",
                            'foto_profil' => $uploaded['file_name']
                        ];

                        $updated = $this->model_tedagt->update($data);

                        if ($updated) {
                            $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> upload berhasil ...
                        </div>');

                            redirect(base_url() . 'index.php/member/profile/' . $idted);
                        } else {
                            $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                            redirect(base_url() . 'index.php/member/photo_profile/' . $idted);
                        }
                    }
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page' => 'pages/member/member_upload_photo'
                ];
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function edit_photo_anggota($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('idted', 'No ID', 'required');

            if ($this->form_validation->run()) {

                $idted  = $this->input->post('idted');

                //upload image ke server
                $this->load->library('upload');

                $breakname  = explode(".", $_FILES['foto']['name']);
                $newname    = $idted . "." . $breakname[1];

                $config['file_name']        = $newname;
                $config['upload_path']      = './assets/images/avatars/';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['overwrite']        = TRUE;
                $config['max_size']         = 5120;
                $config['max_width']        = 2048;
                $config['max_height']       = 2048;

                $this->upload->initialize($config);

                if ($_FILES['foto']['name']) {
                    if (!$this->upload->do_upload('foto')) {

                        //jika gagal upload
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                        redirect(base_url() . 'index.php/member/edit_photo_anggota/' . $idted);
                    } else {
                        //jika berhasil
                        $uploaded = $this->upload->data();

                        $data   = [
                            'idted' => "$idted",
                            'foto_profil' => $uploaded['file_name']
                        ];

                        $updated = $this->model_tedagt->update($data);

                        if ($updated) {
                            $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> upload berhasil ...
                        </div>');

                            redirect(base_url() . 'index.php/member/profil_anggota/' . $idted);
                        } else {
                            $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                            redirect(base_url() . 'index.php/member/edit_photo_anggota/' . $idted);
                        }
                    }
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page' => 'pages/admin/member_photo_admin'
                ];
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function berkas_ktp($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('idted', 'No ID', 'required');

            if ($this->form_validation->run()) {

                $idted  = $this->input->post('idted');

                //upload image ke server
                $this->load->library('upload');

                $breakname  = explode(".", $_FILES['ktp']['name']);
                $newname    = "ktp_" . $idted . "." . $breakname[1];

                $config['file_name']        = $newname;
                $config['upload_path']      = './assets/images/berkas/';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['overwrite']        = TRUE;
                $config['max_size']         = 5120;
                $config['max_width']        = 2048;
                $config['max_height']       = 2048;

                $this->upload->initialize($config);

                if ($_FILES['ktp']['name']) {
                    if (!$this->upload->do_upload('ktp')) {

                        //jika gagal upload
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                        redirect(base_url() . 'index.php/member/berkas_ktp/' . $idted);
                    } else {
                        //jika berhasil
                        $uploaded = $this->upload->data();

                        $data   = [
                            'idted' => "$idted",
                            'scan_ktp' => $uploaded['file_name']
                        ];

                        $updated = $this->model_tedagt->update($data);

                        if ($updated) {
                            $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> upload berhasil ...
                        </div>');

                            redirect(base_url() . 'index.php/member/berkas_ktp/' . $idted);
                        } else {
                            $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                            redirect(base_url() . 'index.php/member/berkas_ktp/' . $idted);
                        }
                    }
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page' => 'pages/member/member_upload_ktp'
                ];
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function berkas_npwp($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('idted', 'No ID', 'required');

            if ($this->form_validation->run()) {

                $idted  = $this->input->post('idted');

                //upload image ke server
                $this->load->library('upload');

                $breakname  = explode(".", $_FILES['npwp']['name']);
                $newname    = "npwp_" . $idted . "." . $breakname[1];

                $config['file_name']        = $newname;
                $config['upload_path']      = './assets/images/berkas/';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['overwrite']        = TRUE;
                $config['max_size']         = 5120;
                $config['max_width']        = 2048;
                $config['max_height']       = 2048;

                $this->upload->initialize($config);

                if ($_FILES['npwp']['name']) {
                    if (!$this->upload->do_upload('npwp')) {

                        //jika gagal upload
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                        redirect(base_url() . 'index.php/member/berkas_npwp/' . $idted);
                    } else {
                        //jika berhasil
                        $uploaded = $this->upload->data();

                        $data   = [
                            'idted' => "$idted",
                            'scan_npwp' => $uploaded['file_name']
                        ];

                        $updated = $this->model_tedagt->update($data);

                        if ($updated) {
                            $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> upload berhasil ...
                        </div>');

                            redirect(base_url() . 'index.php/member/berkas_npwp/' . $idted);
                        } else {
                            $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal upload, ' . $this->upload->display_errors() . ' 
                    </div>');

                            redirect(base_url() . 'index.php/member/berkas_npwp/' . $idted);
                        }
                    }
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page' => 'pages/member/member_upload_npwp'
                ];
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function update_pass($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('pass1', 'Password Baru', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('pass2', 'Re-type Password', 'trim|required|matches[pass1]');
            $this->form_validation->set_rules('idted', 'ID Ted', 'required');

            if ($this->form_validation->run()) {

                $idted      = $this->input->post('idted');
                $password   = password_hash($this->input->post('pass2'), PASSWORD_DEFAULT);

                $data = [
                    'idted' => "$idted",
                    'password' => "$password"
                ];

                $updates = $this->model_tedagt->update($data);

                if ($updates) {
                    $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> ubah password berhasil ...
                        </div>');

                    redirect(base_url() . 'index.php/member/update_pass/' . $idted);
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Oops, </h4> ubah password gagal ...
                        </div>');

                    redirect(base_url() . 'index.php/member/update_pass/' . $idted);
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page'  => 'pages/member/member_ubah_password'
                ];

                $this->load->view('dashboard', $data);
            }
        }
    }

    public function update_pass_anggota($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('pass1', 'Password Baru', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('pass2', 'Re-type Password', 'trim|required|matches[pass1]');
            $this->form_validation->set_rules('idted', 'ID Ted', 'required');

            if ($this->form_validation->run()) {

                $idted      = $this->input->post('idted');
                $password   = password_hash($this->input->post('pass2'), PASSWORD_DEFAULT);

                $data = [
                    'idted' => "$idted",
                    'password' => "$password"
                ];

                $updates = $this->model_tedagt->update($data);

                if ($updates) {
                    $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> ubah password berhasil ...
                        </div>');

                    redirect(base_url() . 'index.php/member/update_pass_anggota/' . $idted);
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Oops, </h4> ubah password gagal ...
                        </div>');

                    redirect(base_url() . 'index.php/member/update_pass_anggota/' . $idted);
                }
            } else {
                $data = [
                    'detail' => $this->model_tedagt->getAccountById($id),
                    'page'  => 'pages/admin/edit_pass_admin'
                ];

                $this->load->view('dashboard', $data);
            }
        }
    }

    public function pohon_jaringan($id = null)
    {

        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {
            $ambilposjar    = $this->model_jaringan->ambilPosJar($id);

            $data = [
                'jaringan'  => $this->model_jaringan->ambilJaringan($ambilposjar['pos_jar'], $id, $ambilposjar['pos_level']),
                'page' => 'pages/member/member_pohon_jaringan'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function daftar_referal($id = null)
    {
        //untuk menampilkan referal ID di bawahnya saja bukan level jaringan nasional
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {
            $data = [
                'referals'  => $this->model_jaringan->daftarReferalId($id),
                'page' => 'pages/member/member_daftar_referal'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function daftar_referal_member($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $data = [
                'referals'  => $this->model_jaringan->daftarReferalId($id),
                'page' => 'pages/admin/member_daftar_referal_admin'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function upgrade($id = null)
    {
        $id = $this->session->userdata('id');
        if ($id == null) {
            redirect(base_url());
        } else {

            $data   = [
                'idted' => "$id",
                'jenis' => 'agen'
            ];

            $upgrade = $this->model_tedagt->update($data);

            if ($upgrade) {
                $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Selamat! </h4> Anda sudah menjadi Agen TED ...
                        </div>');

                redirect(base_url() . 'index.php/member/profile/' . $id);
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Oops, </h4> Upgrade gagal ...
                        </div>');

                redirect(base_url() . 'index.php/member/profile/' . $id);
            }
        }
    }

    public function anggotaAjax($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $data = ['member' => $this->model_tedagt->getAccountById($id)];

            if ($data['member'] == null) {
                $data['status'] = 404;
            } else {
                $data['status'] = 200;
            }

            $encode = json_encode($data, JSON_PRETTY_PRINT);
            echo $encode;
        }
    }
}
