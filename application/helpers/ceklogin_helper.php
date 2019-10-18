<?php
function already_login()
{
    $ci = &get_instance();

    $user_session   = $ci->session->userdata('id');

    if ($user_session) {
        redirect(base_url());
    }
}

function not_login()
{
    $ci = &get_instance();

    $user_session   = $ci->session->userdata('id');

    if (!$user_session) {
        redirect(base_url() . 'index.php/auth');
    }
}
