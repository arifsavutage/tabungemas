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
            <form method="post">
                <h2 class="text-center"><strong>Buat</strong> akun baru.</h2>
                <div class="form-group"><input class="form-control" type="text" name="nama" placeholder="Nama sesuai KTP"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="form-group"><input class="form-control" type="text" name="nohp" placeholder="No. handphone"></div>
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="form-group"><input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)"></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" name="agreement" type="checkbox" required="">Saya setuju dengan ketentuan yang berlaku.</label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="daftar">Daftar</button></div>
                <a href="<?= base_url(); ?>index.php/auth/login" class="already">Sudah memiliki akun? Login disini.</a>
            </form>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/register/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/register/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>