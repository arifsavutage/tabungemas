<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>website-ted</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/login-new/styles.css">
</head>

<body>


    <!-- LOGIN -->
    <div class="container section-1">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7"><img class="img-fluid heading-space" src="<?= base_url() ?>assets/images/login-asset.png"></div>
            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <div class="row">
                    <div class="col">
                        <h1 class="heading-space">LOGIN</h1>
                        <?php
                        if ($this->session->flashdata('info')) :
                            echo $this->session->flashdata('info');
                        endif;
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form name="login" method="post" action="<?= base_url() . "index.php/auth" ?>">
                            <div class="form-group"><label>Email</label><input class="form-control" name="email" value="<?= set_value('email'); ?>" type="text" placeholder="Masukkan email"></div>
                            <div class="form-group" id="show_hide_password"><label>Password</label><input class="form-control" name="password" type="password" placeholder="Masukkan password"></div>
                            <div class="form-group form-check">
                                <div class="form-check">
                                    <input class="form-check-input showpass" type="checkbox" id="formCheck-1">
                                    <label class="form-check-label" for="formCheck-1">Lihat Password</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>
                        <div class="heading-space">
                            <label>Belum punya akun?&nbsp;</label><a class="custom-link" href="<?= base_url(); ?>index.php/register/new_member">Daftar Sekarang</a>
                            <!--<a class="custom-link" href="reset-password.html">
                                <p>Lupa Password?</p>
                            </a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script>
        //show hide pass login
        $(document).ready(function() {
            $('.showpass').change(function(event) {
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