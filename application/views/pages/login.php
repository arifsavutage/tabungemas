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
    <script src="<?= base_url(); ?>assets/login/assets/js/jquery.min.js"></script>
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
            <div class="illustration">
                <!--<i class="icon ion-ios-navigate"></i>-->
                <img class="img-fluid" width="90" src="<?= base_url('assets/images/logo-190x190.png') ?>" />
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Email">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="input-group" id="show_hide_password">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="showpass" id="showpass">
                    <label class="form-check-label" for="showpass">
                        Show Password
                    </label>
                </div>
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
            <a href="<?= base_url(); ?>index.php/register/new_member" class="forgot">Belum memiliki akun? daftar disini</a>
        </form>
    </div>
    <script src="<?= base_url(); ?>assets/login/assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        //show hide pass login
        $(document).ready(function() {
            $('#showpass').change(function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                }
            });
        });
    </script>
</body>

</html>