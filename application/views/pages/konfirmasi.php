<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tabungemas.com | konfirmasi transfer</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/konfirmasi/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/konfirmasi/assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/konfirmasi/assets/css/styles.css">
</head>

<body>
    <div class="contact-clean" style="min-height:700px;">
        <form name="konfirmasi" method="post" action="<?= base_url() . "index.php/register/post_confirmation"; ?>" enctype="multipart/form-data">
            <h2 class="text-center">Konfirmasi Transfer</h2>
            <div class="form-group">
                <input type="hidden" name="token" value="<?= $token; ?>" />
                <input type="hidden" name="status" value="<?= $status; ?>" />
                <input class="form-control" type="file" name="struk" required=""><small class="form-text text-danger">Silahkan lampirkan bukti transfer.</small>
                <!--
                <input class="form-control" type="file" name="ktp" required=""><small class="form-text text-danger">Silahkan lampirkan ktp.</small>
-->
            </div>
            <div class="form-group"><button class="btn btn-primary" type="submit">Kirim </button></div>

            <?php
            if ($this->session->flashdata('info')) {
                echo $this->session->flashdata('info');
            }
            ?>
        </form>
    </div>
    <script src="<?= base_url(); ?>assets/konfirmasi/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/konfirmasi/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>