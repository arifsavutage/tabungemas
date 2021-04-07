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
    <!-- MAIN CONTENT -->
    <div class="container section-1">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7"><img class="img-fluid heading-space" src="<?= base_url() ?>assets/images/register-asset.png"></div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <div class="row">
                    <div class="col">
                        <h1 class="heading-space">BUAT AKUN BARU</h1>
                        <?php
                        if ($this->session->flashdata('info')) :
                            echo $this->session->flashdata('info');
                        endif;

                        if ($this->session->flashdata('sendmail')) :
                            echo "<br/>";
                            echo $this->session->flashdata('sendmail');
                        endif;
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form name="register" method="post" action="">
                            <?php
                            if ($this->session->userdata('refid') != null) {
                                $refid  = $this->session->userdata('refid');
                            } else {
                                $refid = "";
                            }
                            ?>
                            <input type="hidden" name="refid" value="<?= $refid ?>" />
                            <div class="form-group">
                                <label>Nama (Sesuai KTP)</label>
                                <input class="form-control select-text-custom" name="nama" value="<?= set_value('nama') ?>" type="text" placeholder="Masukkan nama Anda">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Nomor KTP</label>
                                <input class="form-control select-text-custom" name="ktp" value="<?= set_value('ktp'); ?>" type="text" placeholder="Masukkan nomor KTP Anda">
                                <?= form_error('ktp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control select-text-custom" type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Masukkan alamat email Anda">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Nomor Handphone</label>
                                <input class="form-control select-text-custom" type="text" name="nohp" value="<?= set_value('nohp'); ?>" placeholder="Masukkan nomor handphone Anda">
                                <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Keanggotaan</label>
                                <select name="jenis" class="form-control select-text-custom">
                                    <option value="">: Pilih Keanggotaan</option>
                                    <?php
                                    //menampilkan paket keanggotaan
                                    $this->db->where('id IN (3)');
                                    $roles = $this->db->get('tb_user_role')->result_array();

                                    foreach ($roles as $role) {
                                        echo "<option value='$role[id]'>" . ucwords($role['role_name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-10 col-md-10 col-lg-10 col-xl-10" id="show_pass_1">
                                    <label>Password</label>
                                    <input class="form-control select-text-custom" type="password" name="password" placeholder="Masukkan password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label>&nbsp;</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="" name="showpass1" id="showpass1">
                                        <label class="form-check-label" for="showpass1">
                                            Show
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-sm-10 col-md-10 col-lg-10 col-xl-10" id="show_pass_2">
                                    <label>Ulangi Password</label>
                                    <input class="form-control select-text-custom" type="password" name="password2" placeholder="Ketik ulang password">
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label>&nbsp;</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="" name="showpass2" id="showpass2">
                                        <label class="form-check-label" for="showpass2">
                                            Show
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="agreement" id="formCheck-1">
                                    <label class="form-check-label" for="formCheck-1">Saya setuju
                                        dengan <a class="custom-link" href="http://www.tabungemas.com/syarat-dan-ketentuan-agen-ted/" target="_blank">Syarat dan Ketentuan</a>&nbsp;yang
                                        berlaku</label>
                                </div>
                                <?= form_error('agreement', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">DAFTAR</button>
                        </form>
                        <div class="heading-space"><label>Sudah punya akun?&nbsp;</label><a class="custom-link" href="<?= base_url(); ?>index.php/auth">Login disini</a></div>
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
            $('#showpass1').change(function(event) {
                event.preventDefault();
                if ($('#show_pass_1 input').attr("type") == "text") {
                    $('#show_pass_1 input').attr('type', 'password');
                } else if ($('#show_pass_1 input').attr("type") == "password") {
                    $('#show_pass_1 input').attr('type', 'text');
                }
            });
        });

        $(document).ready(function() {
            $('#showpass2').change(function(event) {
                event.preventDefault();
                if ($('#show_pass_2 input').attr("type") == "text") {
                    $('#show_pass_2 input').attr('type', 'password');
                } else if ($('#show_pass_2 input').attr("type") == "password") {
                    $('#show_pass_2 input').attr('type', 'text');
                }
            });
        });
    </script>
</body>

</html>