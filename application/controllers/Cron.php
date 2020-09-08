<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_titipan');
        $this->load->model('model_transaksi');
    }

    public function masa_aktif_titipan()
    {
        //menampilkan data titipan emas yang berajhir di bulan ini
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.email, tb_agt_ted.nohp, tb_titipan_emas.tgl_ikut, tb_titipan_emas.tgl_berakhir, tb_titipan_emas.tenor, tb_titipan_emas.gram");
        $this->db->from('tb_titipan_emas');
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_titipan_emas.idted', 'left');
        $this->db->where("DATE_FORMAT(`tgl_berakhir`, '%m%Y') = DATE_FORMAT(CURDATE(),'%m%Y')");
        $this->db->where('status', 'aktif');
        $jatuhtempo['data'] = $this->db->get()->result();

        //kirim list tabel
        $to         = "info@tabungemas.com";
        $cc         = "admin@tabungemas.com";
        $subject    = "Anggota jatuh tempo titipan emas";
        $message    = $this->load->view('email/email_verifikasi', $jatuhtempo, true);

        $this->_sendmail($to, $cc, $subject, $message);
    }

    private function _sendmail($to, $cc = null, $subject, $message)
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
        $cc == null ? $this->email->cc($cc) : "";
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
        /*if ($this->email->send()) {
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
        }*/
    }
}
