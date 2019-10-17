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
    }

    public function index()
    {
        $validation     = $this->form_validation;

        $agtbaru        = $this->model_tedagt;
        $jaringan       = $this->model_jaringan;

        $validation->set_rules($agtbaru->rules());

        if ($validation->run()) {

            //membuat id agt baru
            $refid  = $this->input->post('refid');

            if (!empty($refid)) {
                $explode    = explode(".", $refid);
                $cabang     = $explode[0];
            } else {
                $cabang = "01";
                $refid  = "01.00001";
            }

            $jmlagt = $agtbaru->getAll()->num_rows();

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
                'mail'  => $this->input->post('email'),
                'nama'  => ucwords($this->input->post('nama')),
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

            redirect(base_url() . 'index.php/register');
        } else {
            $data = [
                'token' => "$token",
                'status' => 'verified'
            ];

            $verifiying = $this->model_verifikasi->verify($data);

            if ($verifiying) {
                $idactivated = $this->model_verifikasi->getID("$token");
                $dataactive = [
                    'idted' => $idactivated->idagt,
                    'aktif' => 1
                ];
                //aktivasi akun
                //echo $idactivated->idagt;
                $this->model_tedagt->akunAktif($dataactive);

                $this->session->set_flashdata('info', '
                <div class="alert alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Selamat, </h4> akun Anda sudah aktif ... 
                </div>');

                redirect(base_url() . 'index.php/auth/login');
            } else {
                $this->session->set_flashdata('info', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Maaf, </h4> aktifasi akun gagal ... 
                </div>');

                redirect(base_url() . 'index.php/auth/login');
            }
        }
    }

    public function mailVerifikasi($mailver)
    {
        $to         = $mailver['mail'];
        $subject    = "Verifikasi email akun tabung emas";
        $message    = $this->load->view('email/email_verifikasi', $mailver, true);

        $this->_sendmail($to, $subject, $message);
    }

    private function _sendmail($to, $subject, $message)
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
