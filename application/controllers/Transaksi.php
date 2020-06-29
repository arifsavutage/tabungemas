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
        $this->load->model('model_biayacetak');
        $this->load->model('model_deposit');
        $this->load->model('model_widraw');
        $this->load->model('model_titipan');

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
                $metode = $this->input->post('metode');

                if ($metode == 'transfer') {

                    $bank      = $this->input->post('bank');
                    $bank_data = $this->model_bank->getByID($bank);

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
                            'bank'  => $bank_data

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
                                <h4>Success, </h4> Transaksi berhasil, silahkan cek <strong>invoice</strong> Anda di email untuk melakukan pentransferan ...
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
                } else {

                    $wallet = $this->input->post('saldowallet');

                    if ($wallet < $uang) {
                        $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4>Oops, </h4> Saldo wallet Anda kurang, pembelian emas batal ...
                            </div>');

                        redirect(base_url() . 'index.php/transaksi/beli_emas/' . $id);
                    } else {
                        $datas = [
                            //'tgl' => $tgl,
                            'idted' => $id,
                            'ket' => $ket,
                            'nominal_uang' => $uang,
                            'nominal_gram' => $gram,
                            'status' => 1
                        ];

                        $history = $this->model_history->save($datas);

                        if ($history) {
                            $new_saldo_wallet = $wallet - $uang;

                            $data = [
                                'tgl' => $tgl,
                                'idted' => $id,
                                'uraian' => "bayar beli emas $gram gr",
                                'masuk' => 0,
                                'keluar' => $uang,
                                'saldo' => $new_saldo_wallet,
                                'jenis' => 'uang'
                            ];
                            $this->model_transaksi->save($data);

                            //update saldo gram
                            $saldo_emas_akhir = $this->model_transaksi->getLastTranById($id, 'emas');
                            $new_saldo_emas = $saldo_emas_akhir['saldo'] + $gram;

                            $data_emas = [
                                'tgl' => $tgl,
                                'idted' => $id,
                                'uraian' => "beli emas",
                                'masuk' => $gram,
                                'keluar' => 0,
                                'saldo' => $new_saldo_emas,
                                'jenis' => 'emas'
                            ];
                            $this->model_transaksi->save($data_emas);

                            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4>Success, </h4> Pembayaran menggunakan saldo wallet berhasil, cek saldo emas & wallet Anda ...
                            </div>');

                            redirect(base_url() . 'index.php/transaksi/beli_emas/' . $id);
                        }
                    }
                }
            }

            //ambil harga jual terbaru
            $update_emas = $this->model_emas->getLastUpdate();

            $xbeli  = explode(",", $update_emas['HRG_BELI']);
            $hrgbeli = implode("", $xbeli);

            //ambil selisih dari ted
            $selisih = $this->model_uang->getValueById(1);
            $newjual = $hrgbeli - $selisih['selisih_beli'];

            //ambil uang wallet
            $getwallet = $this->model_transaksi->getLastTranById($id, 'uang');

            //ambil data bank

            $data   = [
                'beli'  => $newjual,
                'wallet' => $getwallet['saldo'],
                'bank'  => $this->model_bank->getAll(),
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
                $tujuan = $this->input->post('tujuan');

                $hrgbaru = $this->input->post('hrgpergram');
                $idtujuan = $this->input->post('idtujuan');

                //Ambil saldo emas pokok
                $simpokok = $this->model_transaksi->getFirstTransaction($id, 'emas');
                $emas_basic = $saldo - $gram;

                if ($tujuan == 'ted') {
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
                                'tujuan_jual' => 'TED',
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
                } else {
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

                            //$uang = $gram * $hrgbaru;
                            $datas = [
                                //'tgl' => $tgl,
                                'idted' => $id,
                                'tujuan_jual' => "$idtujuan",
                                'ket' => $ket . " ID " . $idtujuan . " dgn hrg /gr " . $hrgbaru,
                                'nominal_uang' => $hrgbaru,
                                'nominal_gram' => $gram,
                                'status' => $status
                            ];

                            //simpan ke history transaksi
                            $history = $this->model_history->save($datas);
                        }
                    }
                }
            }

            /** 
             * 
             * PROSES UPDATE HARGA JUAL TERBARU 
             * 
             *
             * */

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

    public function hapus_beli_emas($idx)
    {
        $delete = $this->model_history->delete($idx);

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

    public function tarik_fisik_emas($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('pilih', 'Pilih Gram', 'required');

            if ($this->form_validation->run()) {

                $pilih  = $this->input->post('pilih');
                $xpilih = explode("-", $pilih);

                $ket    = $this->input->post('keterangan');
                $idted  = $this->input->post('idted');
                $status = $this->input->post('status');
                $pokok  = $this->input->post('pokok');
                $saldo  = $this->input->post('saldo');


                $jml = $saldo -  $xpilih[1];

                if (($$xpilih[1] > $saldo) || ($jml < $pokok)) {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Oops, </h4> Anda harus menyisakan simpanan pokok emas sebesar ' . $pokok . ' gram ...
                </div>');

                    redirect(base_url() . 'index.php/transaksi/tarik_fisik_emas/' . $id);
                } else {

                    $data = [
                        'idted' => $idted,
                        'ket' => $ket,
                        'nominal_uang' => $xpilih[0],
                        'nominal_gram' => $xpilih[1],
                        'status' => $status
                    ];
                    $this->model_history->save($data);

                    $data['bank'] = $this->model_bank->getAll();
                    $anggota = $this->model_tedagt->getAccountById($id);
                    //kirim ke email
                    $to      = $anggota['email'];
                    $subject = "Invoice Tarik Fisik";
                    $message = $this->load->view('email/email_tarik_fisik', $data, true);
                    $attach  = "";

                    $this->_sendmail($to, $subject, $message, $attach);

                    $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success, </h4> Silahkan cek invoice pembayaran Anda di email, lakukan transfer biaya cetak & konfirmasi via email atau Whatsapp Customer Service ...
                </div>');

                    redirect(base_url() . 'index.php/transaksi/tarik_fisik_emas/' . $id);
                }
            }

            $data = [
                'emas' => $this->model_transaksi->getLastTranById($id, 'emas'),
                'pokok' => $this->model_transaksi->getFirstTransaction($id, 'emas'),
                'biaya' => $this->model_biayacetak->getAll(),
                'page' => 'pages/member/member_tarik_fisik'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function daftar_tarik_fisik()
    {

        $this->form_validation->set_rules('idted', 'ID Anggota', 'required');
        $this->form_validation->set_rules('tgltrans', 'Tgl Transaksi', 'required');

        if ($this->form_validation->run()) {

            $tgl    = $this->input->post('tgltrans');
            $idted  = $this->input->post('idted');
            $gram   = $this->input->post('gram');

            $data = [
                'tgl'   => "$tgl",
                'idted' => "$idted",
                'status' => 1
            ];

            $update = $this->model_history->update($data);

            if ($update) {
                $saldo_emas = $this->model_transaksi->getLastTranById($idted, 'emas');

                $emas = $saldo_emas['saldo'] - $gram;
                $data_saldo = [
                    'tgl' => date('Y-m-d'),
                    'idted' => "$idted",
                    'uraian' => 'tarik fisik emas',
                    'masuk' => 0,
                    'keluar' => $gram,
                    'saldo' => $emas,
                    'jenis' => 'emas'
                ];

                $this->model_transaksi->save($data_saldo);


                $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success, </h4> data tersimpan
                </div>');

                redirect(base_url() . 'index.php/transaksi/daftar_tarik_fisik/');
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Oops, </h4> data gagal di update
                </div>');

                redirect(base_url() . 'index.php/transaksi/daftar_tarik_fisik/');
            }
        }

        $data = [
            'page' => 'pages/admin/daftar_tarik_fisik',
            'datas' => $this->model_history->getAllTarik()
        ];

        $this->load->view('dashboard', $data);
    }

    public function batal_tarik_fisik($idx)
    {
        $delete = $this->model_history->delete($idx);

        if ($delete) {
            $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Pembatalan tarik fisik berhasil ...
            </div>');

            redirect(base_url() . "index.php/transaksi/daftar_tarik_fisik");
        } else {
            $this->session->set_flashdata('info', '
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oops, </h4> Hapus pembelian emas gagal ...
            </div>');

            redirect(base_url() . "index.php/transaksi/daftar_tarik_fisik");
        }
    }

    public function transfer($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('gramtrf', 'Jumlah Gram', 'required');
            $this->form_validation->set_rules('idtujuan', 'ID Tujuan', 'required');

            if ($this->form_validation->run()) {

                $tujuan = $this->input->post('idtujuan');
                $gram   = round($this->input->post('gramtrf'), 3);
                $pengirim = $this->input->post('idted');
                $ket    = $this->input->post('keterangan') . "" . $tujuan;
                $nama_tj = $this->input->post('namatujuan');

                //Kirim emas ke tujuan
                $emastujuan = $this->model_transaksi->getLastTranById($tujuan, 'emas');
                $saldotujuan = $emastujuan['saldo'] + $gram;

                $data_gram = [
                    'tgl'   => date('Y-m-d'),
                    'idted' => $tujuan,
                    'uraian' => 'trf. dari ID ' . $pengirim,
                    'masuk' => $gram,
                    'keluar' => 0,
                    'saldo' => $saldotujuan,
                    'jenis' => 'emas'
                ];
                $this->model_transaksi->save($data_gram);

                //melakukan potongan saldo emas di pntransfer
                $emaspengirim = $this->model_transaksi->getLastTranById($pengirim, 'emas');
                $emaspengirim = $emaspengirim['saldo'] - $gram;

                $data_pengirim = [
                    'tgl'   => date('Y-m-d'),
                    'idted' => $pengirim,
                    'uraian' => $ket,
                    'masuk' => 0,
                    'keluar' => $gram,
                    'saldo' => $emaspengirim,
                    'jenis' => 'emas'
                ];

                $this->model_transaksi->save($data_pengirim);

                $this->session->set_flashdata('info', '
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>SUCCESS: </h4> Transfer emas ke ID ' . $tujuan . ' an ' . ucwords($nama_tj) . ' berhasil ...
                </div>');

                redirect(base_url() . 'index.php/transaksi/transfer/' . $id);
            }

            $data = [
                'saldo_emas' => $this->model_transaksi->getLastTranById($id, 'emas'),
                'saldo_wallet' => $this->model_transaksi->getLastTranById($id, 'uang'),
                'page' => 'pages/member/member_transfer'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function widraw($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules($this->model_widraw->rules());

            if ($this->form_validation->run()) {

                $wallet    = $this->input->post('walletku');
                $nominal   = $this->input->post('nominal');

                if ($nominal > $wallet) {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Oops, </h4> Saldo wallet Anda tidak mencukupi, isi nominal lebih kecil ...
                        </div>');

                    redirect(base_url() . 'index.php/transaksi/widraw/' . $id);
                } else {
                    $this->model_widraw->save();

                    $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4>Success </h4> Pengajuan pencairan sukses ...
                        </div>');

                    redirect(base_url() . 'index.php/transaksi/widraw/' . $id);
                }
            }

            $data = [
                'saldo_wallet' => $this->model_transaksi->getLastTranById($id, 'uang'),
                'detail'    => $this->model_tedagt->getAccountById($id),
                'byadmin'   => $this->model_uang->getValueById(1),
                'page' => 'pages/member/member_widraw'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function daftar_widraw($idx = '', $act = '')
    {
        $this->form_validation->set_rules('tgl1', 'Tanggal Awal', 'required');

        if ($this->form_validation->run()) {

            $tgl1 = $this->input->post('tgl1');
            $tgl2 = $this->input->post('tgl2');

            $data['widraws'] = $this->model_widraw->getByDateRange($tgl1, $tgl2);
        } else {
            $data['widraws'] = $this->model_widraw->getAll();
        }
        $data['page'] = 'pages/admin/daftar_widraw';

        $this->load->view('dashboard', $data);

        //action check and delete
        if ($act == 'transfer') {

            $detail_widraw = $this->model_widraw->getByIdx($idx);

            $nom        = $detail_widraw['nominal'];
            $idted      = $detail_widraw['idted'];
            $tgl_widraw = $detail_widraw['tgl_pengajuan'];
            $tgl_trf    = date('Y-m-d');
            $byadm      = $detail_widraw['biaya_adm'];

            //ambil data uang terakhir
            $saldo_rp = $this->model_transaksi->getLastTranById($idted, 'uang');
            $trf      = $nom - $byadm;
            $pengurangan = $saldo_rp['saldo'] - $trf;

            //simpan perubahan di transaksi
            $datasaldo = [
                [
                    'idted' => $idted,
                    'tgl'   => $tgl_widraw,
                    'uraian' => "tarik wallet, trf. tgl $tgl_trf",
                    'masuk' => 0,
                    'keluar' => $trf,
                    'saldo' => $pengurangan,
                    'jenis' => 'uang'
                ],
                [
                    'idted' => $idted,
                    'tgl'   => $tgl_widraw,
                    'uraian' => "adm tarik wallet, trf. tgl $tgl_trf",
                    'masuk' => 0,
                    'keluar' => $byadm,
                    'saldo' => $pengurangan,
                    'jenis' => 'uang'
                ]
            ];

            for ($i = 0; $i < 2; $i++) {
                $this->model_transaksi->save($datasaldo[$i]);
            }


            /*$databyadm  = [
                'idted' => $idted,
                'tgl'   => $tgl_widraw,
                'uraian' => "adm tarik wallet, trf. tgl $tgl_trf",
                'masuk' => 0,
                'keluar' => $byadm,
                'saldo' => $pengurangan,
                'jenis' => 'uang'
            ];*/

            $datawidraw = [
                'idx'      => $idx,
                'status'   => 1,
                'tgl_cair' => $tgl_trf
            ];

            $this->model_widraw->update($datawidraw);

            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success, </h4> Update berhasil, saldo terpotong ...
                </div>');

            redirect(base_url() . 'index.php/transaksi/daftar_widraw');
        } else if ($act == 'batal') {
            //hapus
            $this->model_widraw->hapus($idx);
            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success, </h4> Pembatalan berhasil ...
                </div>');

            redirect(base_url() . 'index.php/transaksi/daftar_widraw');
        }
    }

    public function history($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {
            $data = [
                'jualan'    => $this->model_history->jualanID($id),
                'history_uang' => $this->model_transaksi->getTransactionById($id, 'uang'),
                'history_emas' => $this->model_transaksi->getTransactionById($id, 'emas'),
                'page' => 'pages/member/member_history'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function deposit($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        } else {
            $this->form_validation->set_rules('idted', 'ID Anggota', 'required');

            if ($this->form_validation->run()) {
                $idted  = $this->input->post('idted');
                $nominal = $this->input->post('nominal');
                $bank   = $this->input->post('banktrf');
                $status = 'tunggu';

                $data = [
                    'idted' => $idted,
                    'nom_deposit' => $nominal,
                    'banktrf' => $bank,
                    'status' => $status
                ];

                $save = $this->model_deposit->save($data);

                if ($save) {
                    $bank_trf = $this->model_bank->getByID($bank);

                    $this->session->set_flashdata('info', '
                    <div class="card border-success mb-3">
                        <div class="card-header">
                            <h4>Invoice</h4>
                        </div>
                        <div class="card-body text-success">
                            <h4 class="card-title">Success</h4>
                            <p class="card-text">Segera transfer sesuai dengan nominal deposit ke rekening tujuan</p>
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Nominal</th>
                                    <th>Transfer Ke</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>' . number_format($nominal, 0, ',', '.') . '</td>
                                    <td>' . $bank_trf['nm_bank'] . '<br/>' . $bank_trf['norek'] . '<br /> An. ' . $bank_trf['an'] . '</td>
                                    </tr>
                                </tbody>
                            </table>

                            <p class="card-text">Konfirmasi ke whatsapp admin kami atau email ke <strong>billing@tabungemas.com</strong> dengan melampirkan bukti transfer </p>
                        </div>
                    </div>
                    ');
                    redirect(base_url() . 'index.php/transaksi/deposit/' . $id);
                } else {
                    $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Oops, </h4> tambah deposit gagal ...
                    </div>');
                    redirect(base_url() . 'index.php/transaksi/deposit/' . $id);
                }
            } else {
                $data = [
                    'bank' => $this->model_bank->getAll(),
                    'page' => 'pages/member/member_deposit'
                ];

                $this->load->view('dashboard', $data);
            }
        }
    }

    public function daftar_deposit()
    {
        $this->form_validation->set_rules('idted', 'ID Anggota', 'required');
        $this->form_validation->set_rules('tgltrans', 'Tgl Transaksi', 'required');

        if ($this->form_validation->run()) {

            $tgl    = $this->input->post('tgltrans');
            $idx    = $this->input->post('idx');
            $idted  = $this->input->post('idted');
            $uang   = $this->input->post('uang');

            $data = [
                'idx'   => $idx,
                'status' => 'aproved'
            ];

            $update = $this->model_deposit->update($data);

            if ($update) {
                $saldo_uang = $this->model_transaksi->getLastTranById($idted, 'uang');

                $new_saldo = $saldo_uang['saldo'] + $uang;
                $data_saldo = [
                    'tgl' => date('Y-m-d'),
                    'idted' => "$idted",
                    'uraian' => 'deposit',
                    'masuk' => $uang,
                    'keluar' => 0,
                    'saldo' => $new_saldo,
                    'jenis' => 'uang'
                ];

                $this->model_transaksi->save($data_saldo);


                $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success, </h4> data tersimpan
                </div>');

                redirect(base_url() . 'index.php/transaksi/daftar_deposit/');
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Oops, </h4> data gagal di update
                </div>');

                redirect(base_url() . 'index.php/transaksi/daftar_deposit/');
            }
        }

        $data = [
            'page' => 'pages/admin/daftar_deposit',
            'datas' => $this->model_deposit->getAll()
        ];

        $this->load->view('dashboard', $data);
    }

    public function batal_deposit($idx)
    {
        $detail_deposit = $this->model_deposit->getById($idx);

        if ($detail_deposit['status'] == 'tunggu') {

            $delete = $this->model_deposit->delete($idx);

            if ($delete) {
                $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Success :</h4> Pembatalan deposit berhasil ...
            </div>');

                redirect(base_url() . "index.php/transaksi/daftar_deposit");
            } else {
                $this->session->set_flashdata('info', '
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oops, </h4> Hapus deposit gagal ...
            </div>');

                redirect(base_url() . "index.php/transaksi/daftar_deposit");
            }
        } else if ($detail_deposit['status'] == 'aproved') {
            //hapus histori & pengurangan saldo
            $idted = $detail_deposit['idted'];
            $uang  = $detail_deposit['nom_deposit'];

            $saldo_uang = $this->model_transaksi->getLastTranById($idted, 'uang');

            $new_saldo = $saldo_uang['saldo'] - $uang;
            $data_saldo = [
                'tgl' => date('Y-m-d'),
                'idted' => "$idted",
                'uraian' => 'koreksi, batal deposit',
                'masuk' => 0,
                'keluar' => $uang,
                'saldo' => $new_saldo,
                'jenis' => 'uang'
            ];

            $this->model_transaksi->save($data_saldo);

            //hapus
            $delete = $this->model_deposit->delete($idx);

            $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success, </h4> pembatalan deposit sukses
                </div>');

            redirect(base_url() . 'index.php/transaksi/daftar_deposit/');
        }
    }

    public function payment()
    {
        $this->form_validation->set_rules('idx', 'ID Transaction', 'required');

        if ($this->form_validation->run()) {

            $idtrans    = $this->input->post('idx');
            $gram       = $this->input->post('gram');
            $wallet     = $this->input->post('walletku');
            $totalbyr   = $this->input->post('totalbayar');
            $idted      = $this->input->post('idted');
            $ket        = $this->input->post('keterangan');
            $satuan     = $this->input->post('hrgsatuan');

            $penjual    = $this->input->post('idpenjual');

            if ($totalbyr > $wallet) {
                $this->session->set_flashdata('info', '
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Oops, </h4> Saldo rupaih di wallet Anda tidak mencukupi, silahkan lakukan deposit untuk membayar tagihan ini ...
                </div>');

                redirect(base_url());
            } else {
                //melakukan potongan saldo wallet di pembeli
                $sisawallet = $wallet - $totalbyr;
                //echo "$totalbyr, $wallet";
                $data_wallet = [
                    'tgl'   => date('Y-m-d'),
                    'idted' => $idted,
                    'uraian' => $ket,
                    'masuk' => 0,
                    'keluar' => $totalbyr,
                    'saldo' => $sisawallet,
                    'jenis' => 'uang'
                ];

                $this->model_transaksi->save($data_wallet);

                //menambah jumlah gram emas
                $emasku = $this->model_transaksi->getLastTranById($idted, 'emas');
                $saldoemas = $emasku['saldo'] + $gram;

                $data_gram = [
                    'tgl'   => date('Y-m-d'),
                    'idted' => $idted,
                    'uraian' => 'beli emas',
                    'masuk' => $gram,
                    'keluar' => 0,
                    'saldo' => $saldoemas,
                    'jenis' => 'emas'
                ];
                $this->model_transaksi->save($data_gram);

                //tambah saldo wallet penjual
                $walletpenjual = $this->model_transaksi->getLastTranById($penjual, 'uang');
                $saldopenjual = $walletpenjual['saldo'] + $totalbyr;

                $wallet_penjual = [
                    'tgl'   => date('Y-m-d'),
                    'idted' => $penjual,
                    'uraian' => "trf. bayar emas" . $gram . " gr dari " . $idted,
                    'masuk' => $totalbyr,
                    'keluar' => 0,
                    'saldo' => $saldopenjual,
                    'jenis' => 'uang'
                ];
                $this->model_transaksi->save($wallet_penjual);

                //kurangi saldo emas penual
                $emaspenjual = $this->model_transaksi->getLastTranById($penjual, 'emas');
                $emasnyapenjual = $emaspenjual['saldo'];

                $emas_penjual = [
                    'tgl'   => date('Y-m-d'),
                    'idted' => $penjual,
                    'uraian' => "jual emas ke ID" . $idted . ", " . $gram . " gr, hrg Rp. " . $satuan . " /gr",
                    'masuk' => 0,
                    'keluar' => $gram,
                    'saldo' => $emasnyapenjual,
                    'jenis' => 'emas'
                ];
                $this->model_transaksi->save($emas_penjual);

                //Update table history
                $uphistory = [
                    'idx' => $idtrans,
                    'status' => 1
                ];
                $this->model_history->updatebyID($uphistory);

                $this->session->set_flashdata('info', '
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>SUCCESS: </h4> Payment berhasil ...
                </div>');

                redirect(base_url());
            }
        }
    }

    public function paymentcancel($idx = null)
    {
        if ($idx == null) {
            redirect(base_url());
        } else {

            $data = [
                'idx'   => $idx,
                'status' => 2
            ];

            $jual_beli = $this->model_history->updatebyID($data);

            if ($jual_beli) {
                $this->session->set_flashdata('info', '
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>Success: </h4> Payment dibatalkan ...
                </div>');

                redirect(base_url());
            } else {
                $this->session->set_flashdata('info', '
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>ERROR: </h4> Error pembatalan payment ...
                </div>');

                redirect(base_url());
            }
        }
    }

    public function alltransaction()
    {
        $data = [
            'page' => 'pages/admin/daftar_transaksi',
            'datas' => $this->model_transaksi->allTransaction()->result_array()
        ];

        $this->load->view('dashboard', $data);
    }

    public function titipan_emas($idted = null)
    {
        if ($idted == null) {
            redirect(base_url());
        } else {

            $this->form_validation->set_rules('gramtrf', 'Jumlah Gram', 'required');
            $this->form_validation->set_rules('agreement', 'Persetujuan', 'required');

            if ($this->form_validation->run()) {

                $emasku = $this->input->post('emasku');
                $gram   = $this->input->post('gramtrf');
                $idted  = $this->input->post('idted');
                $tenor  = $this->input->post('tenor');
                $tgl    = $this->input->post('tgl');
                $ket    = $this->input->post('keterangan');
                $status = $this->input->post('status'); //pending, aktif, berhenti

                //Selisih harga
                $selisih_hrgbeli    = $this->model_uang->getValueById(1);

                //harga terkini
                $get_harga  = $this->db->query("SELECT `IDX`, `UPDATE_AT`, `HRG_BELI`, `HRG_JUAL` FROM `t_update_ubs` ORDER BY `IDX` DESC LIMIT 1")->row_array();

                $hrgfix     = (int) str_replace(",", "", $get_harga['HRG_BELI']) - $selisih_hrgbeli['selisih_beli'];
                $hrg_ikut   = $hrgfix;
                $jml_uang   = $hrgfix * $gram;

                //limit simpanan pokok emas
                $lim    = $this->model_transaksi->getFirstTransaction($idted, 'emas');
                $limit_ikut = $emasku - $gram;

                if ($gram < 2) {
                    $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Oops, </h4> Minimal emas 2 gram ...
                    </div>');

                    redirect(base_url() . 'index.php/transaksi/titipan_emas/' . $idted);
                } else if ($limit_ikut <= $lim['saldo']) {
                    $this->session->set_flashdata('info', '
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>Oops, </h4> Anda tidak boleh lebih dari limit simpanan pokok & simpanan wajib sebesar ' . $lim['saldo'] . ' gr ... gramtrf
                    </div>');

                    redirect(base_url() . 'index.php/transaksi/titipan_emas/' . $idted);
                } else {

                    //Kirim ke tabel titipan emas
                    $data_titipan = [
                        'idted'         => $idted,
                        'tgl_ikut'      => $tgl,
                        'tgl_berakhir'  => date('Y-m-d', strtotime("+$tenor months", strtotime($tgl))),
                        'tenor'         => $tenor,
                        'gram'          => $gram,
                        'harga_ikut'    => $hrg_ikut,
                        'jml_uang'      => $jml_uang,
                        'status'        => $status
                    ];
                    $this->model_titipan->save($data_titipan);

                    //melakukan potongan saldo emas
                    $potongan_titipan = $this->model_transaksi->getLastTranById($idted, 'emas');
                    $potongan_titipan = $potongan_titipan['saldo'] - $gram;

                    $data_pengirim = [
                        'tgl'   => date('Y-m-d'),
                        'idted' => $idted,
                        'uraian' => $ket,
                        'masuk' => 0,
                        'keluar' => $gram,
                        'saldo' => $potongan_titipan,
                        'jenis' => 'emas'
                    ];

                    $this->model_transaksi->save($data_pengirim);

                    $this->session->set_flashdata('info', '
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4>SUCCESS: </h4> Titipan emas diproses ...
                    </div>');

                    redirect(base_url() . 'index.php/transaksi/titipan_emas/' . $idted);
                }
            }

            $data = [
                'saldo_emas' => $this->model_transaksi->getLastTranById($idted, 'emas'),
                'page' => 'pages/member/member_titipan_emas'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function titipan_emas_profit($idted = null)
    {
        if ($idted == null) {
            redirect(base_url());
        } else {
            $data = [
                'titipan'    => $this->model_titipan->totalProfitById($idted),
                'page' => 'pages/member/member_titipan_emas_profit'
            ];

            $this->load->view('dashboard', $data);
        }
    }

    public function daftar_titipan_emas()
    {

        $data = [
            'lists'    => $this->model_titipan->getAll(),
            'page' => 'pages/admin/daftar_titipan_emas'
        ];

        $this->load->view('dashboard', $data);
    }

    public function titipan_emas_approve($idx = null)
    {
        if ($idx == null) {
            redirect(base_url());
        } else {
            $this->model_titipan->approve($idx);

            $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>SUCCESS: </h4> Titipan emas approved ...
            </div>');

            redirect(base_url('index.php/transaksi/daftar_titipan_emas'));
        }
    }

    public function titipan_emas_addprofit()
    {

        $this->form_validation->set_rules('profit', 'Prosentase Profit', 'required');

        if ($this->form_validation->run()) {

            $profit = $this->input->post('profit');
            $date   = date('Y-m-d');

            //load data titipan emas yg aktif
            $data_aktif = $this->model_titipan->loadAktif();

            foreach ($data_aktif as $aktif) {
                if ($date > $aktif['tgl_berakhir']) {
                    //ubah status jadi berhenti
                    $this->model_titipan->updateBerhenti($aktif['idx']);
                } else {
                    //input ke detail titipan
                    $in_data = [
                        'id_titipan'    => $aktif['idx'],
                        //'idted'         => $aktif['idted'],
                        'periode'       => $date,
                        'profit_persen' => $profit,
                        'profit_uang'   => 0
                    ];

                    $this->model_titipan->adddetail($in_data);
                }
            }

            $this->session->set_flashdata('info', '
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>SUCCESS: </h4> Tambah profit berhasil ...
            </div>');

            redirect(base_url('index.php/transaksi/daftar_titipan_emas'));
        }

        $data = [
            'page' => 'pages/admin/add_titipan_emas_profit'
        ];

        $this->load->view('dashboard', $data);
    }

    public function titipan_emas_profitreport()
    {
        $data = [
            'page' => 'pages/admin/report_titipan_emas_profit'
        ];

        $this->load->view('dashboard', $data);
    }
}
