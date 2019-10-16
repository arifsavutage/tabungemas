<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Referal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function id($refid = null)
    {
        if ($refid != null) {
            $this->session->set_userdata('refid', $refid);
            redirect(base_url() . 'index.php/register');
        } else {
            $this->session->unset_userdata('refid');
            redirect(base_url() . 'index.php/register');
        }
    }
}
