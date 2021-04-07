<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_tedagt');
        $this->load->model('model_user');
    }

    public function index()
    {
        already_login();

        $this->form_validation->set_rules('email', 'Email Pegawai', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('pages/login-new');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {

        $email  = $this->input->post('email', true);
        $pass   = $this->input->post('password', true);

        $user   = $this->model_tedagt->getAccountByEmail($email);
        //print_r(var_dump($user));

        if ($user) {

            if ($user['aktif'] == 1) {

                if (password_verify($pass, $user['password'])) {

                    $exname = explode(" ", $user['nama_lengkap']);
                    if (count($exname) > 1) {
                        $nameview   = $exname[0];
                    } else {
                        $nameview   = $user['nama_lengkap'];
                    }

                    $data = [
                        'id'    => $user['idted'],
                        'nama'  => $nameview,
                        'role'  => $user['role_name'],
                        'roleid' => $user['role_id'],
                        'foto'  => $user['foto_profil']
                    ];

                    $this->session->set_userdata($data);
                    //echo "$user[ID], $user[EMAIL], $user[ROLE_ID]";
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Password salah ...
                    </div>');

                    redirect(base_url() . 'index.php/auth');
                }
            } else {
                $this->session->set_flashdata('info', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Akun belum aktif, silahkan verifikasi email Anda ...
                </div>');

                redirect(base_url() . 'index.php/auth');
            }
        } else {

            //ambil data administrator
            $admin  = $this->model_user->getLogin($email);

            if ($admin) {
                if ($admin['is_active'] == 1) {
                    if (password_verify($pass, $admin['password'])) {

                        $exname = explode(" ", $admin['nama_user']);
                        if (count($exname) > 1) {
                            $nameview   = $exname[0];
                        } else {
                            $nameview   = $admin['nama_user'];
                        }

                        $data = [
                            'id'    => $admin['id'],
                            'nama'  => $nameview,
                            'role'  => $admin['role_name'],
                            'roleid' => $admin['role_id'],
                            'foto'  => $admin['foto']
                        ];

                        $this->session->set_userdata($data);
                        //echo "$user[ID], $user[EMAIL], $user[ROLE_ID]";
                        redirect(base_url());
                    } else {
                        $this->session->set_flashdata('info', '
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            Password salah ...
                        </div>');

                        redirect(base_url() . 'index.php/auth');
                    }
                } else {
                    $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Akun belum aktif, silahkan hubungi administrator untuk aktivasi akun Anda ...
                    </div>');

                    redirect(base_url() . 'index.php/auth');
                }
            } else {
                $this->session->set_flashdata('info', '
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Email belum terdaftar ...
                </div>');

                redirect(base_url() . 'index.php/auth');
            }
        }
    }

    public function logout()
    {
        //$params = ['id', 'email', 'role_id'];

        // $this->session->unset_userdata($params);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', '
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Anda telah logout...
            </div>');

        redirect(base_url() . 'index.php/auth');
    }
}
