<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tabungemas.com | login</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/assets/css/styles.css">
    <style>
        body {
            background-color: #f1f7fc !important;
        }
    </style>
</head>

<body>
    <div class="login-clean">

        <form method="post" action="<?= base_url() . "index.php/auth"; ?>">
            <?php
            if ($this->session->flashdata('info')) :
                echo $this->session->flashdata('info');
            endif;
            ?>
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Email">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
            <a href="<?= base_url(); ?>index.php/register/new_member" class="forgot">Belum memiliki akun? daftar disini</a>
        </form>
    </div>
    <script src="<?= base_url(); ?>assets/login/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/login/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>