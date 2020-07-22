<?php
function sendsms($notujuan, $pesan)
{
    $username = "tabungemas";
    $apikey   = "ba4ff447c55149e0dea7fb3410d796b8";

    $ch = curl_init();
    curl_setopt(
        $ch,
        CURLOPT_URL,
        "http://smsapi.rosihanari.net/restapi.php?action=sendsms&username=" . $username . "&apikey=" . $apikey . "&destination=" . $notujuan . "&message=" . urlencode($pesan)
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
