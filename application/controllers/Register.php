<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_tedagt');
        $this->load->model('model_jaringan');

        $this->load->helper('form', 'security');
        $this->load->library('form_validation');
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

                $updateup   = [
                    'jml_downline' => $newdownline
                ];

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
            $jaringan->updateUpline($updateup);

            $this->session->set_flashdata('info', '
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4>success :</h4> Registrasi berhasil, cek email Anda...
                </div>');

            redirect(base_url() . 'index.php/register');
        } else {
            $this->load->view('pages/register');
        }
    }
}
