<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kirimsms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_smsinfo');
    }

    public function index()
    {
        redirect(base_url());
    }

    public function profit_emas()
    {
        $data   = $this->model_smsinfo->getAll(0);

        foreach ($data as $sms) {
            sendsms($sms['nohp'], $sms['pesan']);

            //update is_sent
            $data_up = [
                'id'        => $sms['id'],
                'is_sent'   => 1
            ];

            $this->model_smsinfo->update($data_up);
        }

        echo "terkirim";
    }
}
