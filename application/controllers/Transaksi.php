<?php
defined('BASEPATH') or exit('No direct access script allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_history');
        $this->load->model('model_transaksi');
        $this->load->model('model_emas');
        $this->load->model('model_uang');
        $this->load->model('model_tedagt');
        $this->load->model('model_bank');

        not_login();
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
        $this->email->from('billing@tabungemas.com', 'Billing');
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

    public function beli_emas($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules("nominaluang", "Nilai emas", "required");
            //$this->form_validation->set_rules("nominalgram", "Gram emas", "required");

            if ($this->form_validation->run()) {

                $tgl    = $this->input->post('tgl');
                $id     = $this->input->post('idted');
                $ket    = $this->input->post('keterangan');
                $uang   = $this->input->post('nominaluang');
                $gram   = $this->input->post('nominalgram');
                $status = $this->input->post('status');

                $datas = [
                    //'tgl' => $tgl,
                    'idted' => $id,
                    'ket' => $ket,
                    'nominal_uang' => $uang,
                    'nominal_gram' => $gram,
                    'status' => $status
                ];

                $history = $this->model_history->save($datas);
                //echo $this->db->last_query();

                if ($history) {

                    //kirim email
                    $anggota = $this->model_tedagt->getAccountById($id);

                    $data = [
                        'nama'  => $anggota['nama_lengkap'],
                        'uang'  => $uang,
                        'bank'  => $this->model_bank->getAll()

                    ];

                    $to      = $anggota['email'];
                    $subject = "Invoice Pembelian Emas";
                    $message = $this->load->view('email/email_invoice', $data, true);
                    $attach  = "";

                    $this->_sendmail($to, $subject, $message, $attach);

                    $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success, </h4> Transaksi berhasil, silahkan cek <strong>invoice</strong> Anda di email ...
                        </div>');

                    redirect(base_url() . 'index.php/transaksi/beli_emas/' . $id);
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Oops, </h4> Transaksi gagal tersimpan ...
                </div>');

                    redirect(base_url() . 'index.php/transaksi/beli_emas/' . $id);
                }
            }

            //ambil harga jual terbaru
            $update_emas = $this->model_emas->getLastUpdate();

            $xbeli  = explode(",", $update_emas['HRG_BELI']);
            $hrgbeli = implode("", $xbeli);

            //ambil selisih dari ted
            $selisih = $this->model_uang->getValueById(1);
            $newjual = $hrgbeli - $selisih['selisih_beli'];

            $data   = [
                'beli'  => $newjual,
                'page'  => 'pages/member/member_beli_emas'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function jual_emas($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules("gram", "Gram emas", "required");
            //$this->form_validation->set_rules("nominalgram", "Gram emas", "required");

            if ($this->form_validation->run()) {

                $tgl    = $this->input->post('tgl');
                $id     = $this->input->post('idted');
                $ket    = $this->input->post('keterangan');
                $uang   = $this->input->post('uang');
                $gram   = $this->input->post('gram');
                $status = $this->input->post('status');
                $saldo  = $this->input->post('saldo');

                //Ambil saldo emas pokok
                $simpokok = $this->model_transaksi->getFirstTransaction($id, 'emas');
                $emas_basic = $saldo - $gram;

                if ($gram > $saldo) {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Oops, </h4> Pastikan jumlah gram emas yang di masukkan benar ...
                    </div>');

                    redirect(base_url() . 'index.php/transaksi/jual_emas/' . $id);
                } else {

                    if ($emas_basic < $simpokok['saldo']) {
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Oops, </h4> Simpanan pokok sebesar <strong>' . $simpokok['saldo'] . ' gr</strong> tidak dapat di jual atau di tarik, silahkan sesuaikan kembali jumlah gram ...
                    </div>');

                        redirect(base_url() . 'index.php/transaksi/jual_emas/' . $id);
                    } else {
                        $datas = [
                            //'tgl' => $tgl,
                            'idted' => $id,
                            'ket' => $ket,
                            'nominal_uang' => $uang,
                            'nominal_gram' => $gram,
                            'status' => $status
                        ];

                        //simpan ke history transaksi
                        $history = $this->model_history->save($datas);

                        if ($history) {

                            //ambil saldo uang terakhir
                            $saldo_uang = $this->model_transaksi->getLastTranById($id, 'uang');
                            $newuang    = $saldo_uang['saldo'] + $uang;

                            $datarp = [
                                'idted' => $id,
                                'tgl'   => $tgl,
                                'uraian' => 'pencairan jual emas',
                                'masuk' => $uang,
                                'keluar' => 0,
                                'saldo' => $newuang,
                                'jenis' => 'uang'
                            ];

                            //update saldo rupiah
                            $this->model_transaksi->save($datarp);

                            //update saldo emas
                            $newsaldoemas = $saldo - $gram;
                            $dataemas = [
                                'idted' => $id,
                                'tgl'   => $tgl,
                                'uraian' => 'jual emas',
                                'masuk' => 0,
                                'keluar' => $gram,
                                'saldo' => $newsaldoemas,
                                'jenis' => 'emas'
                            ];
                            //update saldo emas
                            $this->model_transaksi->save($dataemas);


                            /**
                             * 
                             * Update history transaksi
                             * 
                             */

                            $dataup = [
                                'idted' => $id,
                                'tgl'   => $tgl,
                                'status' => 1
                            ];

                            $this->model_history->update($dataup);

                            /**
                             * 
                             * Kirim email pemberitahuan
                             * 
                             */
                            $anggota = $this->model_tedagt->getAccountById($id);

                            $data = [
                                'nama'  => $anggota['nama_lengkap'],
                                'uang'  => $uang,
                                'gram'  => $gram

                            ];

                            $to      = $anggota['email'];
                            $subject = "Bukti Transaksi Jual Emas";
                            $message = $this->load->view('email/email_bukti_jual', $data, true);
                            $attach  = "";

                            $this->_sendmail($to, $subject, $message, $attach);

                            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4>Success, </h4> Transaksi tersimpan ...
                                </div>');

                            redirect(base_url() . 'index.php/transaksi/jual_emas/' . $id);
                        } else {
                            $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Oops, </h4> Transaksi gagal tersimpan ...
                        </div>');

                            redirect(base_url() . 'index.php/transaksi/jual_emas/' . $id);
                        }
                    }
                }
            }

            //ambil harga jual terbaru
            $update_emas = $this->model_emas->getLastUpdate();

            $xjual  = explode(",", $update_emas['HRG_JUAL']);
            $hrgjual = implode("", $xjual);

            //ambil selisih dari ted
            $selisih = $this->model_uang->getValueById(1);
            $newjual = $hrgjual + $selisih['selisih_jual'];

            $data   = [
                'saldo_emas' => $this->model_transaksi->getLastTranById($id, 'emas'),
                'jual'  => $newjual,
                'page'  => 'pages/member/member_jual_emas'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function daftar_beli_emas()
    {
        $this->form_validation->set_rules('idted', 'ID Anggota', 'required');
        $this->form_validation->set_rules('tgltrans', 'Tgl Transaksi', 'required');

        if ($this->form_validation->run()) {

            $tgl    = $this->input->post('tgltrans');
            $idted  = $this->input->post('idted');
            $emas   = $this->input->post('gram');

            $dataup = [
                'idted' => $idted,
                'tgl'   => $tgl,
                'status' => 1
            ];

            $update = $this->model_history->update($dataup);

            if ($update) {

                //update ke rekening
                //ambil transaksi terakhir
                $last = $this->model_transaksi->getLastTranById($idted, 'emas');

                $saldoemas = $emas + $last['saldo'];

                $datasaldo = [
                    'idted' => $idted,
                    'tgl'   => $tgl,
                    'uraian' => 'beli emas',
                    'masuk' => $emas,
                    'keluar' => 0,
                    'saldo' => $saldoemas,
                    'jenis' => 'emas'
                ];

                $this->model_transaksi->save($datasaldo);

                $this->session->set_flashdata('info', '
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success :</h4> Konfirmasi pembelian emas berhasil ...
                </div>');

                redirect(base_url() . "index.php/transaksi/daftar_beli_emas");
            } else {
                $this->session->set_flashdata('info', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Oops, </h4> Konfirmasi pembelian emas gagal ...
                </div>');

                redirect(base_url() . "index.php/transaksi/daftar_beli_emas");
            }
        } else {
            $data = [
                'page' => 'pages/admin/daftar_beli_emas',
                'datas' => $this->model_history->getAllBeli()
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function hapus_beli_emas($id, $tgl)
    {
        $data = [
            'idted' => $id,
            'tgl'   => $tgl
        ];

        $delete = $this->model_history->update($data);

        if ($delete) {
            $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Hapus pembelian emas berhasil ...
            </div>');

            redirect(base_url() . "index.php/transaksi/daftar_beli_emas");
        } else {
            $this->session->set_flashdata('info', '
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oops, </h4> Hapus pembelian emas gagal ...
            </div>');

            redirect(base_url() . "index.php/transaksi/daftar_beli_emas");
        }
    }

    public function daftar_jual_emas()
    {

        $data = [
            'page' => 'pages/admin/daftar_jual_emas',
            'datas' => $this->model_history->getAllJual()
        ];

        $this->load->view('dashboard', $data);
    }
}
