<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Runbonus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_tedagt');
        $this->load->model('model_jaringan');
    }

    public function index()
    {
        $periode = date('Y-m-d');
        //hitiung pendaftar
        $query = $this->db->query("SELECT * FROM `tb_jaringan` WHERE `tgl_proses` = '0000-00-00'");
        $jml_pendaftar = $query->num_rows();

        //Jml anggota potensi refferal
        $jml_anggota  = $this->model_jaringan->potensi_refferal()->num_rows();
        $sess = [
            'periode'   => $periode,
            'jml_anggota' => $jml_anggota,
            'pendaftar' => $jml_pendaftar
        ];
        $this->session->set_userdata($sess);

        redirect(base_url('index.php/runbonus/kedua/0'));
    }

    public function kedua($limit = 0)
    {
        //input kedalam tabel pendapatan_bonus dengan nilai 0

        $periode = $this->session->userdata('periode');
        $jml = $this->session->userdata('jml_anggota');
        $data = $this->model_jaringan->potensi_refferal_by_limit($limit);

        //echo $data->idagt;
        $insert = [
            'periode' => $periode,
            'idagt' => $data->idagt,
            'bon_referal' => 0,
            'bon_royalti' => 0,
            'is_widraw' => 0
        ];

        $this->db->insert('pendapatan_bonus', $insert);

        $limit = $limit + 1;

        if ($limit == $jml) {
            echo '<script>window.location.assign("' . base_url('index.php/runbonus/ketiga') . '");</script>';
        } else {
            echo '<script>window.location.assign("' . base_url('index.php/runbonus/kedua/' . $limit) . '");</script>';
        }
    }

    public function ketiga($limit = 0)
    {
        // hitung bonus referral
        $periode = $this->session->userdata('periode');
        $jml = $this->session->userdata('jml_anggota');
        $data = $this->model_jaringan->potensi_refferal_by_limit($limit);

        echo $data->idagt . "<br />";

        //ambil nilai bonus
        $bon_ref = $this->model_jaringan->potensiBonusReferal($data->idagt, $data->pos_jar);

        $ttlref = 0;
        foreach ($bon_ref as $row) {
            $level = $row['pos_level'] - $data->pos_level;

            //get nominal bonus ref
            $nominal = $this->db->get_where('tb_bonus', array('id' => $level))->row();
            $new_nom = $nominal == null ? 0 : $nominal->referal;

            $p = $new_nom * $row['jml_potensi'];
            echo "bonus level $level = " . number_format($p, 0, '.', ',') . "<br/>";
            $ttlref += $p;
        }

        //echo $data->idagt;
        /*$update = [
            'periode' => $periode,
            'idagt' => $data->idagt,
            'bon_referal' => 0
        ];*/

        $this->db->query("UPDATE `pendapatan_bonus` SET `bon_referal` = bon_referal + $ttlref WHERE `periode` = '$periode'  AND `idagt` = '$data->idagt'");

        $limit = $limit + 1;

        if ($limit == $jml) {
            echo '<script>window.location.assign("' . base_url('index.php/runbonus/keempat') . '");</script>';
        } else {
            echo '<script>window.location.assign("' . base_url('index.php/runbonus/ketiga/' . $limit) . '");</script>';
        }
    }

    public function keempat()
    {
        //data jumlah yang qualified Royalti
        $q_3 = $this->model_jaringan->cek_qualified_tiga()->num_rows();
        $q_7 = $this->model_jaringan->cek_qualified_tujuh()->num_rows();
        $q_9 = $this->model_jaringan->cek_qualified_sembilan()->num_rows();

        $data_q = [
            'q_3' => $q_3,
            'q_7' => $q_7,
            'q_9' => $q_9,
        ];

        $this->session->set_userdata($data_q);
        //echo '<script>window.location.assign("' . base_url('index.php/runbonus/kelima/3/0') . '");</script>';
        echo '<script>window.location.assign("' . base_url('index.php/runbonus/ketujuh') . '");</script>';
    }

    /*public function kelima($qualified_ke, $limit)
    {
        $new_agt = $this->session->userdata('pendaftar');
        $periode = $this->session->userdata('periode');

        if ($qualified_ke == 3) {
            $this->db->where('royalti_target', 3);
            $nilai = $this->db->get('tb_bonus')->row();

            $qualified = $this->session->userdata('q_3');

            $royalti = ($new_agt * $nilai->royalti) / $qualified;

            $data = $this->model_jaringan->qualified_tiga_by_limit($limit);

            $this->db->query("UPDATE `pendapatan_bonus` SET `bon_royalti` = bon_royalti + $royalti WHERE `periode` = '$periode'  AND `idagt` = '$data->idagt'");

            $limit = $limit + 1;

            if ($limit == $qualified) {
                echo '<script>window.location.assign("' . base_url('index.php/runbonus/kelima/7/0') . '");</script>';
            } else {
                echo '<script>window.location.assign("' . base_url('index.php/runbonus/kelima/3/' . $limit) . '");</script>';
            }
        } else if ($qualified_ke == 7) {
            $this->db->where('royalti_target', 7);
            $nilai = $this->db->get('tb_bonus')->row();

            $qualified = $this->session->userdata('q_7');

            $royalti = ($new_agt * $nilai->royalti) / $qualified;

            $data = $this->model_jaringan->qualified_tujuh_by_limit($limit);

            $this->db->query("UPDATE `pendapatan_bonus` SET `bon_royalti` = bon_royalti + $royalti WHERE `periode` = '$periode'  AND `idagt` = '$data->idagt'");

            $limit = $limit + 1;

            if ($limit == $qualified) {
                echo '<script>window.location.assign("' . base_url('index.php/runbonus/kelima/9/0') . '");</script>';
            } else {
                echo '<script>window.location.assign("' . base_url('index.php/runbonus/kelima/7/' . $limit) . '");</script>';
            }
        } else if ($qualified_ke == 9) {
            $this->db->where('royalti_target', 9);
            $nilai = $this->db->get('tb_bonus')->row();

            $qualified = $this->session->userdata('q_9');

            $royalti = ($new_agt * $nilai->royalti) / $qualified;

            $data = $this->model_jaringan->qualified_sembilan_by_limit($limit);

            $this->db->query("UPDATE `pendapatan_bonus` SET `bon_royalti` = bon_royalti + $royalti WHERE `periode` = '$periode'  AND `idagt` = '$data->idagt'");

            $limit = $limit + 1;

            if ($limit == $qualified) {
                echo '<script>window.location.assign("' . base_url('index.php/runbonus/keenam') . '");</script>';
            } else {
                echo '<script>window.location.assign("' . base_url('index.php/runbonus/kelima/9/' . $limit) . '");</script>';
            }
        }
    }*/

    public function keenam()
    {
        $data = [
            'tgl_proses' => date('Y-m-d')
        ];
        $this->db->where('tgl_proses', '0000-00-00');
        $this->db->update('tb_jaringan', $data);

        echo "Finish";
    }

    public function ketujuh()
    {
        //hitung real downline, dikurangi paket yg tdk masuk hitungan royalti
        $query = $this->db->query("SELECT tb_jaringan.`id`, tb_jaringan.`idagt`, tb_jaringan.`idreferal`, tb_jaringan.`idupline`, tb_jaringan.`jml_downline`, tb_jaringan.`pos_jar`, tb_jaringan.`pos_level`, tb_agt_ted.jenis
        FROM tb_jaringan
        LEFT JOIN tb_agt_ted ON tb_agt_ted.idted = tb_jaringan.idagt
        WHERE
        tb_jaringan.jml_downline > 0
        AND
        tb_agt_ted.jenis != 3");
        $data_h = $query->result();


        $qualified = array();
        foreach ($data_h as $data) {
            //hitung untuk qualified royalti
            $query = $this->db->query("SELECT tb_jaringan.idagt,tb_jaringan.idreferal, tb_jaringan.idupline,tb_jaringan.pos_jar, tb_agt_ted.jenis
                FROM `tb_jaringan`
                LEFT JOIN tb_agt_ted ON tb_agt_ted.idted = tb_jaringan.idagt
                WHERE
                tb_jaringan.idreferal = $data->idagt AND tb_agt_ted.jenis != 3");
            $jml_downline_real = $query->num_rows();

            if ($jml_downline_real >= 3) {
                $x = array('idagt' => $data->idagt, 'downline' => $jml_downline_real);
                array_push($qualified, $x);
            }
        }


        $data_q = [
            'qualified' => $qualified
        ];

        $this->session->set_userdata($data_q);
        echo '<script>window.location.assign("' . base_url('index.php/runbonus/kedelapan') . '");</script>';
    }

    public function kedelapan($limit = 0)
    {
        $periode = $this->session->userdata('periode');
        $new_agt = $this->session->userdata('pendaftar');
        $qualified = $this->session->userdata('qualified');
        $jml = count($qualified);

        //print_r(var_dump($qualified));

        /*echo "<h1>Daftar qualified</h1><br/>";
        for ($i = 0; $i < count($qualified); $i++) {
            echo "Id :" . $qualified[$i]['idagt'] . "<br/>";
            echo "downline :" . $qualified[$i]['downline'] . "<br/><hr/>";
        }*/

        echo "<h1>Daftar qualified</h1><br/>";
        echo "Id :" . $qualified[$limit]['idagt'] . "<br/>";
        echo "downline :" . $qualified[$limit]['downline'] . "<br/><hr/>";

        $idagt    = $qualified[$limit]['idagt'];
        $downline = $qualified[$limit]['downline'];

        //cek apakah id sudah terdaftar di pendapatan_bonus
        $this->db->where('idagt', $idagt);
        $this->db->where('periode', $periode);
        $cek = $this->db->get('pendapatan_bonus')->num_rows();

        if ($cek == 0) {
            $insert = [
                'periode' => $periode,
                'idagt' => $idagt,
                'bon_referal' => 0,
                'bon_royalti' => 0,
                'is_widraw' => 0
            ];

            $this->db->insert('pendapatan_bonus', $insert);
        }

        if ($downline >= 3 and $downline <= 9) {
            $this->db->where('royalti_target', 3);
            $nilai = $this->db->get('tb_bonus')->row();

            $qualified = $this->session->userdata('q_3');

            $royalti = ($new_agt * $nilai->royalti) / $qualified;

            $this->db->query("UPDATE `pendapatan_bonus` SET `bon_royalti` = bon_royalti + $royalti WHERE `periode` = '$periode'  AND `idagt` = '$idagt'");
        } else if ($downline >= 10 and $downline <= 18) {
            $this->db->where('royalti_target', 7);
            $nilai = $this->db->get('tb_bonus')->row();

            $qualified = $this->session->userdata('q_7');

            $royalti = ($new_agt * $nilai->royalti) / $qualified;

            $this->db->query("UPDATE `pendapatan_bonus` SET `bon_royalti` = bon_royalti + $royalti WHERE `periode` = '$periode'  AND `idagt` = '$idagt'");
        } else if ($downline >= 19) {
            $this->db->where('royalti_target', 9);
            $nilai = $this->db->get('tb_bonus')->row();

            $qualified = $this->session->userdata('q_9');

            $royalti = ($new_agt * $nilai->royalti) / $qualified;

            $this->db->query("UPDATE `pendapatan_bonus` SET `bon_royalti` = bon_royalti + $royalti WHERE `periode` = '$periode'  AND `idagt` = '$idagt'");
        }

        $limit = $limit + 1;
        if ($limit == $jml) {

            echo '<script>window.location.assign("' . base_url('index.php/runbonus/keenam') . '");</script>';
        } else {
            echo '<script>window.location.assign("' . base_url('index.php/runbonus/kedelapan/' . $limit) . '");</script>';
        }
    }
}
