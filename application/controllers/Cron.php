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
        //menampilkan data titipan emas yang berakhir di bulan ini
        $this->db->select("tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.email, tb_agt_ted.nohp, tb_titipan_emas.tgl_ikut, tb_titipan_emas.tgl_berakhir, tb_titipan_emas.tenor, tb_titipan_emas.gram");
        $this->db->from('tb_titipan_emas');
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_titipan_emas.idted', 'left');
        $this->db->where("DATE_FORMAT(`tgl_berakhir`, '%m%Y') = DATE_FORMAT(CURDATE(),'%m%Y')");
        $this->db->where('status', 'aktif');
        $jatuhtempo['data'] = $this->db->get()->result();

        //kirim list tabel
        $to         = "info@tabungemas.com";
        $cc         = "susie@tabungemas.com";
        $subject    = "Anggota jatuh tempo titipan emas";
        $message    = $this->load->view('email/kadaluarsa_titipan_emas', $jatuhtempo, true);

        $this->_sendmail($to, $cc, $subject, $message);
    }

    public function stop_titipan()
    {
        //menampilkan data titipan emas yang berakhir di bulan ini
        $this->db->select("tb_titipan_emas.idx, tb_agt_ted.idted, tb_agt_ted.nama_lengkap, tb_agt_ted.email, tb_agt_ted.nohp, tb_titipan_emas.tgl_ikut, tb_titipan_emas.tgl_berakhir, tb_titipan_emas.tenor, tb_titipan_emas.gram");
        $this->db->from('tb_titipan_emas');
        $this->db->join('tb_agt_ted', 'tb_agt_ted.idted = tb_titipan_emas.idted', 'left');
        $this->db->where("DATE_FORMAT(`tgl_berakhir`, '%m%Y') = DATE_FORMAT(CURDATE(),'%m%Y')");
        $this->db->where('status', 'aktif');
        $jatuhtempo = $this->db->get()->result();

        $date   = date('Y-m-d');

        foreach ($jatuhtempo as $list) {
            //echo "$list->nama_lengkap , $list->tgl_berakhir </br>";

            if ($date >= $list->tgl_berakhir) {
                //ambil gram emas yg di titipkan
                $data_off = $this->model_titipan->getByIdx($list->idx);

                $saldo_emas = $this->model_transaksi->getLastTranById($list->idted, 'emas');

                $newsaldoemas = $saldo_emas['saldo'] + $data_off['gram'];
                $dataemas = [
                    'idted' => $list->idted,
                    'tgl'   => date('Y-m-d'),
                    'uraian' => 'Pengembalian saldo emas, berhenti titipan emas',
                    'masuk' => $data_off['gram'],
                    'keluar' => 0,
                    'saldo' => $newsaldoemas,
                    'jenis' => 'emas'
                ];
                //update saldo emas
                $this->model_transaksi->save($dataemas);

                //ubah status jadi berhenti
                $this->model_titipan->updateBerhenti($list->idx);

                //kirim email
                $keterangan['detail'] = [
                    'idted' => $list->idted,
                    'nama_lengkap' => $list->nama_lengkap,
                    'gram' => $list->gram,
                    'tgl_ikut' => $list->tgl_ikut,
                    'tgl_berakhir' => $list->tgl_berakhir
                ];

                $to         = "info@tabungemas.com";
                $cc         = "susie@tabungemas.com";
                $subject    = "Jatuh tempo titipan emas an. $list->nama_lengkap";
                $message    = $this->load->view('email/jatuh_tempo_titipan_emas', $keterangan, true);

                $this->_sendmail($to, $cc, $subject, $message);
            }
        }
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
    }
}
