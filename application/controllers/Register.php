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
        $this->load->model('model_transaksi');
        $this->load->model('model_bank');
        $this->load->model('model_emas');
    }

    public function index()
    {
        redirect(base_url() . 'index.php/register/new_member');
    }

    public function add_to_jaringan()
    {
        $agtbaru        = $this->model_tedagt;
        $jaringan       = $this->model_jaringan;

        //membuat id agt baru
        $refid      = $this->input->post('refid');
        $mailregis  = $this->input->post('email');
        $nameregis  = $this->input->post('nama');
        $idtmp      = $this->input->post('idtmp');

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
            $panjangId = $panjangId + 1;
            if (strlen($panjangId) == 1) {
                $newid  = $cabang . ".0000" . $panjangId;
            } else if (strlen($panjangId) == 2) {
                $newid  = $cabang . ".000" . $panjangId;
            } else if (strlen($panjangId) == 3) {
                $newid  = $cabang . ".00" . $panjangId;
            } else if (strlen($panjangId) == 4) {
                $newid  = $cabang . ".0" . $panjangId;
            } else {
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

        //ambil nominal uang untuk pembanding dengan harga beli emas terbaru
        $nomvar  = $this->model_uang->getValueById(3);
        $emasnow = $this->model_emas->getLastUpdate();
        $vselisih = $this->model_uang->getValueById(1);

        $xemas   = explode(",", $emasnow['HRG_BELI']);
        $inemas  = implode("", $xemas);
        $hargaemasbarucuy = $inemas - $vselisih['selisih_beli'];

        $emaspokok = $nomvar['registrasi'] / $hargaemasbarucuy;

        $dt_trans   = [
            'tgl'   => date('Y-m-d'),
            'idted' => "$newid",
            'uraian' => "simp. pokok & simp. wajib",
            'masuk' => number_format($emaspokok, 3, '.', ''),
            'keluar' => 0,
            'saldo' => number_format($emaspokok, 3, '.', ''),
            'jenis' => 'emas'
        ];

        $this->model_transaksi->save($dt_trans);

        //update jaringan untuk refid
        if ($jmlagt != 0) {
            $updateup   = [
                'idagt'       => $refid,
                'jml_downline' => $newdownline
            ];
            $jaringan->updateUpline($updateup);
        }

        //prepare send mail
        $dataemail = [
            'mail'  => $mailregis,
            'nama'  => ucwords($nameregis)
        ];

        //send email
        $this->mailAkunAktif($dataemail);

        //hapus data di table tmp
        //echo $idtmp;
        $this->model_tmpagt->delete($idtmp);


        $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Penambahan member ke jaringan berhasil.. 
            </div>');

        redirect(base_url() . 'index.php/member/member_baru');
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

            if ($refid == "") {
                $this->session->set_flashdata('info', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Opps, </h4> Anda belum memiliki referal ID, silahkan klik link <a href="http://www.tabungemas.com/daftar-referal-tabung-emas-digital/" target="_blank"><strong>Daftar Referal</strong></a> & pilih salah satu anggota untuk referal Anda ... 
                </div>');

                redirect(base_url() . 'index.php/register/new_member');
            } else {

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
                            'nominal' => $data['nominal'],
                            'bank'  => $this->model_bank->getAll()
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
                        'npminal' => $data['nominal'],
                        'bank'  => $this->model_bank->getAll()
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

            //configurasi upload struk
            $breakname  = explode(".", $_FILES['struk']['name']);
            $newname    = $token . "." . $breakname[1];

            $config['file_name']        = $newname;
            $config['upload_path']      = './assets/images/bukti/';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 5120;
            $config['max_width']        = 3072;
            $config['max_height']       = 3072;

            $this->upload->initialize($config);

            if ($_FILES['struk']['name']) {
                if (!$this->upload->do_upload('struk')) {

                    //jika gagal upload
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Opps, </h4> gagal kirim bukti transfer, ' . $this->upload->display_errors() . ' 
                    </div>');

                    redirect(base_url() . 'index.php/register/verify/' . $token);
                } else {
                    //jika berhasil
                    $upstruk = $this->upload->data();


                    //kirim ke email billing
                    $data['temporary'] = $temporary->getByToken($token);

                    $to         = "billing@tabungemas.com";
                    $subject    = "Bukti transfer " . $data['temporary']['nm_tmp'];
                    $message    = $this->load->view('email/email_konfirmasi', $data, true);
                    $attach1    = './assets/images/bukti/' . $newname;
                    //$attach2    = './assets/images/berkas/' . $newktp;
                    $attach2    = "";

                    $this->_sendmail($to, $subject, $message, $attach1, $attach2);

                    //update table, status konfirmasi
                    $datakonfirm = [
                        'token' => "$token",
                        'konfirm_status' => $status
                    ];

                    $temporary->konfirm($datakonfirm);

                    $this->session->set_flashdata('info', '<div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> konfirmasi berhasil ...
                        </div>');

                    redirect(base_url() . 'index.php/register/verify/' . $token);
                }
            }
        }
    }

    public function mailAkunAktif($mailver)
    {
        $to         = $mailver['mail'];
        $subject    = "Akun sudah aktif";
        $message    = $this->load->view('email/email_active', $mailver, true);
        $attach1    = "";
        $attach2     = "";

        $this->_sendmail($to, $subject, $message, $attach1, $attach2);
    }

    public function mailVerifikasi($mailver)
    {
        $to         = $mailver['mail'];
        $subject    = "Verifikasi email akun tabung emas";
        $message    = $this->load->view('email/email_verifikasi', $mailver, true);
        $attach1     = "";
        $attach2     = "";

        $this->_sendmail($to, $subject, $message, $attach1, $attach2);
    }

    private function _sendmail($to, $subject, $message, $attach1, $attach2)
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
        $this->email->attach($attach1);
        $this->email->attach($attach2);

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
