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
                            <h3 style="color:#5f1d80;border-bottom: thin solid #cccccc;border-collapse: collapse;padding-bottom:30px;">Hallo, <?= $nama; ?></h3>

                            <p style="margin-bottom:50px;color:#6e6e6e;">Anggota Tabung Emas Yth,
                                Silahkan transfer uang pembelian emas sebesar <strong>Rp. <?= number_format($uang, 0, ',', '.'); ?></strong> ke nomor rekening yang tertera di bawah,
                                dan konfirmasi pembayaran Anda dengan mengirimkan bukti transfer ke <strong>billing@tabungemas.com</strong> dengan mengisi subjek email dengan <strong>Konfirmasi transfer beli emas ID [no_id_Anda]</strong>.
                            </p>

                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Jangan lupa untuk memberikan file attachment struk bukti transfer.
                            </p>

                            <table align="center" border="1" cellpadding="0" cellspacing="0" width="300">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Bank</th>
                                    <th>No. Rek</th>
                                    <th>An.</th>
                                </tr>
                                <?php
                                $no = 1;
                                foreach ($bank as $rek) :
                                    ?>
                                    <tr>
                                        <th><?= $no; ?></th>
                                        <th><?= $rek['nm_bank']; ?></th>
                                        <th><?= $rek['norek']; ?></th>
                                        <th><?= $rek['an']; ?></th>
                                    </tr>
                                <?php
                                    $no++;
                                endforeach;
                                ?>
                            </table>

                            <p style="margin-top:65px;color:#6e6e6e;">
                                Salam hangat,<br />
                                <br />
                                Account center
                            </p>
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