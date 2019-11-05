<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tabungemas | register</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/register/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/register/assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/register/assets/css/styles.css">
</head>

<body>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post" action="">
                <?php
                if ($this->session->flashdata('info')) :
                    echo $this->session->flashdata('info');
                endif;

                if ($this->session->flashdata('sendmail')) :
                    echo "<br/>";
                    echo $this->session->flashdata('sendmail');
                endif;
                ?>
                <h2 class="text-center"><strong>Buat</strong> akun baru.</h2>

                <div class="form-group">
                    <?php
                    if ($this->session->userdata('refid') != null) {
                        $refid  = $this->session->userdata('refid');
                    } else {
                        $refid = "";
                    }
                    ?>
                    <input type="hidden" name="refid" value="<?= $refid ?>" />
                    <input class="form-control" type="text" name="nama" value="<?= set_value('nama'); ?>" placeholder="Nama sesuai KTP">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Email">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="nohp" value="<?= set_value('email'); ?>" placeholder="No. handphone">
                    <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password2" placeholder="Password (repeat)">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label"><input class="form-check-input" name="agreement" type="checkbox" required="">Saya setuju dengan ketentuan yang berlaku.</label>
                        <?= form_error('agreement', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="daftar">Daftar</button></div>
                <a href="<?= base_url(); ?>index.php/auth" class="already">Sudah memiliki akun? Login disini.</a>
            </form>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/register/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/register/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>