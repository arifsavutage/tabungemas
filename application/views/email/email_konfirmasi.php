<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;font-family: Arial, 'Raleway';background-color:#e3e3e3;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color:#ffffff;-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);">
                    <tr>
                        <td align="center" style="padding: 40px 0 30px 0;background-color: #812aa3;background-image: linear-gradient(to bottom right, #812aa3, #bf19b1);">
                            <img src="<?= base_url(); ?>assets/images/logo-ted.png" alt="Tabung Emas Digital" style="display: block;" />
                            <br />
                            <span style="color:#ffffff;font-size:28px;margin-top:15px;margin-bottom:5px;"><strong>Welcome To</strong> TED Community</span>
                            <p style="color:#ffffff;margin-top:0px;margin-bottom:10px;font-size:14px;">
                                sebuah platform bisnis emas batangan dibawah koperasi mobile emas asia.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <h3 style="color:#5f1d80;border-bottom: thin solid #cccccc;border-collapse: collapse;padding-bottom:30px;">Konfirmasi pembayaran</h3>

                            <p style="margin-bottom:50px;color:#6e6e6e;">Berikut detail member baru :</p>

                            <table align="center" border="1" cellpadding="10" cellspacing="0" width="450">
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td><?= ucwords($temporary['nm_tmp']); ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?= $temporary['email_tmp']; ?></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>:</td>
                                    <td><?= $temporary['nohp_tmp']; ?></td>
                                </tr>
                                <tr>
                                    <td>Ref. ID</td>
                                    <td>:</td>
                                    <td><?= $temporary['idreferal']; ?></td>
                                </tr>
                            </table>

                            <p style="margin-bottom:50px;color:#6e6e6e;">Segera lakukan check data transfer ke bank terkait & cek data anggota baru apakah sudah terdaftar.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;background-color:#72d686;text-align:center;">
                            <a href="https://www.tabungemas.com/" target="_blank" style="color:#ffffff;text-decoration:none;">www.tabungemas.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>