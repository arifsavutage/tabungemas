<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_tedagt');
        $this->load->model('model_jaringan');
        $this->load->model('model_verifikasi');

        $this->load->model('model_tmpagt');
        $this->load->model('model_uang');
    }

    public function index()
    {
        redirect(base_url() . 'index.php/register/new_member');
    }

    public function konfirm()
    {
        $validation     = $this->form_validation;

        $agtbaru        = $this->model_tmpagt;
        $jaringan       = $this->model_jaringan;

        $validation->set_rules($agtbaru->rules());

        if ($validation->run()) {

            //membuat id agt baru
            $refid      = $this->input->post('refid');
            $mailregis  = $this->input->post('email');
            $nameregis  = $this->input->post('nama');

            $cekuser   = $agtbaru->getAccountByEmail($mailregis);

            if ($mailregis != $cekuser['email']) {

                if (!empty($refid)) {
                    //ambil kode cabang pada ID's
                    $explode    = explode(".", $refid);
                    $cabang     = $explode[0];
                } else {

                    //cabang defautl jika tidak ada yg mereferalkan
                    $cabang = "01";
                    $refid  = "01.00001";
                }

                //start create new ID's
                //cek jumlah terdaftar
                $jmlagt = $agtbaru->getAll()->num_rows();
                $jmlagt = $agtbaru->getAllByCabang($cabang);

                if ($jmlagt == 0) {
                    $newid = $cabang . ".00001";
                    $datajar    = [
                        'idagt' => "$newid",
                        'refid' => "0",
                        'uplineid' => "0",
                        'jmldown' => 0,
                        'posjar' => '1',
                        'poslvl' => 1,
                        'tglproses' => '0000-00-00'
                    ];

                    $level = "super";
                } else {
                    $panjangId  = $agtbaru->jmlIdCabang($cabang);
                    $updatejar  = $jaringan->cekUpline($refid);

                    //echo $panjangId;

                    if (strlen($panjangId) == 1) {
                        $panjangId = $panjangId + 1;
                        $newid  = $cabang . ".0000" . $panjangId;
                    } else if (strlen($panjangId) == 2) {
                        $panjangId = $panjangId + 1;
                        $newid  = $cabang . ".000" . $panjangId;
                    } else if (strlen($panjangId) == 3) {
                        $panjangId = $panjangId + 1;
                        $newid  = $cabang . ".00" . $panjangId;
                    } else if (strlen($panjangId) == 4) {
                        $panjangId = $panjangId + 1;
                        $newid  = $cabang . ".0" . $panjangId;
                    } else {
                        $panjangId = $panjangId + 1;
                        $newid  = $cabang . "." . $panjangId;
                    }

                    $newdownline = $updatejar['jml_downline'] + 1;
                    $newposjar  = $updatejar['pos_jar'] . "" . $newdownline;
                    $newposlvl  = $updatejar['pos_level'] + 1;

                    $datajar    = [
                        'idagt' => "$newid",
                        'refid' => "$refid",
                        'uplineid' => "$refid",
                        'jmldown' => 0,
                        'posjar' => "$newposjar",
                        'poslvl' => $newposlvl,
                        'tglproses' => '0000-00-00'
                    ];

                    $level  = "member";
                }


                $agtbaru->save($newid, $level);
                $jaringan->save($datajar);

                //update jaringan untuk refid
                if ($jmlagt != 0) {
                    $updateup   = [
                        'idagt'       => $refid,
                        'jml_downline' => $newdownline
                    ];
                    $jaringan->updateUpline($updateup);
                }

                //prepare send mail
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $idexpld    = explode(".", $newid);
                $idimplode  = implode("", $idexpld);
                $token = substr(str_shuffle($permitted_chars), 0, 16) . "" . $idimplode;

                $dataemail = [
                    'mail'  => $mailregis,
                    'nama'  => ucwords($nameregis),
                    'token' => $token
                ];

                //send email
                $this->mailVerifikasi($dataemail);

                //simpan ke tabel verifikasi email
                $datasendmail   = [
                    'token' => "$token",
                    'idagt' => "$newid",
                    'status' => 'not verified'
                ];
                $this->model_verifikasi->save($datasendmail);

                $this->session->set_flashdata('info', '
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>success :</h4> Registrasi berhasil.. 
                    </div>');

                redirect(base_url() . 'index.php/register');
            } else {
                $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Maaf, </h4> Email sudah terdaftar ...
                    </div>');

                redirect(base_url() . 'index.php/register');
            }
        } else {
            $this->load->view('pages/register');
        }
    }

    public function new_member()
    {
        $validation     = $this->form_validation;
        $agtbaru        = $this->model_tmpagt;

        $validation->set_rules($agtbaru->rules());

        if ($validation->run()) {

            $refid      = $this->input->post('refid');
            $mailregis  = $this->input->post('email');
            $nameregis  = $this->input->post('nama');

            $cekjmlagt  = $this->model_tedagt->getAll()->num_rows();
            if ($cekjmlagt > 0) {
                $cekuser   = $agtbaru->getAccountByEmail($mailregis);

                if ($mailregis != $cekuser['email']) {

                    if (!empty($refid)) {
                        $ref  = $refid;
                    } else {
                        $ref  = "01.00001";
                    }

                    $nominalregis   = $this->model_uang->getValueById(1);

                    $randnom    = "";
                    for ($i = 0; $i < 3; $i++) {
                        $randnom  .= rand(1, 3);
                    }

                    $nomtransfer    = $nominalregis['registrasi'] + $randnom;

                    //prepare send mail
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $token = substr(str_shuffle($permitted_chars), 0, 16);

                    $data   = [
                        'referal'   => "$ref",
                        'nominal'   => $nomtransfer,
                        'status'    => 0,
                        'token'     => $token
                    ];

                    //save to tmp data
                    $agtbaru->save($data);

                    $dataemail = [
                        'mail'  => $mailregis,
                        'nama'  => ucwords($nameregis),
                        'token' => $token,
                        'nominal' => $data['nominal']
                    ];

                    //send email
                    $this->mailVerifikasi($dataemail);

                    $this->session->set_flashdata('info', '
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>success :</h4> Registrasi berhasil.. 
                    </div>');

                    redirect(base_url() . 'index.php/register/new_member');
                } else {
                    $this->session->set_flashdata('info', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Maaf, </h4> Email sudah terdaftar ...
                </div>');

                    redirect(base_url() . 'index.php/register/new_member');
                }
            } else {

                //kondisi dimana belumada samasekali member
                //create top level atau top perusahaan

                //prepare send mail
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $token = substr(str_shuffle($permitted_chars), 0, 16);

                $data   = [
                    'referal'   => "",
                    'nominal'   => 0,
                    'status'    => 0,
                    'token'     => $token
                ];

                //save to tmp data
                $agtbaru->save($data);

                $dataemail = [
                    'mail'  => $mailregis,
                    'nama'  => ucwords($nameregis),
                    'token' => $token,
                    'npminal' => $data['nominal']
                ];

                //send email
                $this->mailVerifikasi($dataemail);

                $this->session->set_flashdata('info', '
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>success :</h4> Registrasi berhasil.. 
                </div>');

                redirect(base_url() . 'index.php/register');
            }
        } else {
            $this->load->view('pages/register');
        }
    }

    public function verify($token = null)
    {
        if ($token == null) {
            $this->session->set_flashdata('info', '
                <div class="alert alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Opps, </h4> token verifikasi tidak di ketahui ... 
                </div>');

            redirect(base_url() . 'index.php/register/new_member');
        } else {
            $datakonfirm = [
                'token' => "$token",
                'status' => 1
            ];
            $this->load->view('pages/konfirmasi', $datakonfirm);
        }
    }

    public function post_confirmation()
    {

        $temporary  = $this->model_tmpagt;

        $this->form_validation->set_rules('token', 'Token', 'required');

        $token  = $this->input->post('token');
        $status = $this->input->post('status');

        if ($this->form_validation->run()) {
            //upload image ke server
            $this->load->library('upload');

            $breakname  = explode(".", $_FILES['struk']['name']);
            $newname    = $token . "." . $breakname[1];

            $config['file_name']        = $newname;
            $config['upload_path']      = './assets/images/bukti/';
            $config['allowed_types']    = 'jpg|jpeg';
            $config['max_size']         = 100;
            $config['max_width']        = 2048;
            $config['max_height']       = 2048;

            $this->upload->initialize($config);

            if ($_FILES['struk']['name']) {
                if (!$this->upload->do_upload('struk')) {

                    //jika gagal upload
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal konfirmasi, ' . $this->upload->display_errors() . ' 
                    </div>');

                    redirect(base_url() . 'index.php/register/verify/' . $token);
                } else {
                    //jika berhasil
                    $uploaded = $this->upload->data();

                    if ($uploaded) {
                        //kirim ke email billing
                        $data['temporary'] = $temporary->getByToken($token);

                        $to         = "billing@tabungemas.com";
                        $subject    = "Bukti transfer " . $data['temporary']['nama_lengkap'];
                        $message    = $this->load->view('email/email_konfirmasi', $data, true);
                        $attach     = './assets/images/bukti/' . $newname;

                        $this->_sendmail($to, $subject, $message, $attach);

                        $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> konfirmasi berhasil ...
                        </div>');

                        redirect(base_url() . 'index.php/register/verify/' . $token);
                    } else {
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Oops, </h4> gagal mengirim email ...
                        </div>');

                        redirect(base_url() . 'index.php/register/verify/' . $token);
                    }
                }
            }
        }
    }

    public function mailVerifikasi($mailver)
    {
        $to         = $mailver['mail'];
        $subject    = "Verifikasi email akun tabung emas";
        $message    = $this->load->view('email/email_verifikasi', $mailver, true);
        $attach     = "";

        $this->_sendmail($to, $subject, $message, $attach);
    }

    private function _sendmail($to, $subject, $message, $attach)
    {

        //konfigurasi

        $config        = array(

            'mailtype'   => 'html',
            'charset'    => 'iso-8859-1',
            'wordwrap'   => true
        );

        //$this->load->library('email');
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        $this->email->from('noreply@tabungemas.com', 'no-reply');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($attach);

        if ($this->email->send()) {
            $this->session->set_flashdata('sendmail', '
                <div class="alert alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>info :</h4> cek inbox email atau folder spam
                </div>');
        } else {
            $this->session->set_flashdata('sendmail', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>warning :</h4> ' . show_error($this->email->print_debugger()) . '
                </div>');
        }
    }
}
