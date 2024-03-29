<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Update Alamat & Kontak</h4>
            </div>
            <div class="card-body">
                <a href="<?= base_url() . "index.php/member/profil_anggota/$detail[idted]"; ?>" class="btn btn-danger">Kembali</a>
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="noktp">KTP Anggota</label>
                        <input type="text" class="form-control" id="noktp" name="noktp" value="<?= $detail['noktp'] ?>">
                        <input type="hidden" name="idted" value="<?= $detail['idted']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap">Nama Anggota</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $detail['nama_lengkap'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="nohp">No. Handphone</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $detail['nohp'] ?>">

                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $detail['email'] ?>">
                        <?php echo form_error('email', '<span class="text-danger"', '</span>') ?>
                    </div>

                    <div class="form-group">
                        <label for="nohp">Alamat</label>
                        <textarea class="form-control" name="alamat"><?= $detail['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="norek">No. Rekening</label>
                        <input type="text" class="form-control" id="norek" name="norek" value="<?= $detail['norek'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        <input type="text" class="form-control" id="bankid" name="bank" value="<?= $detail['bank'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="an">Atas Nama</label>
                        <input type="text" class="form-control" id="anid" name="an" value="<?= $detail['an'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="nmwaris">Nama Ahli Waris</label>
                        <input type="text" class="form-control" id="nmwarisid" name="nmwaris" value="<?= ucwords($detail['nmwaris']) ?>" placeholder="Nama ahli waris" required="">
                        <?php echo form_error('nmwaris', '<span class="text-danger"', '</span>') ?>
                    </div>
                    <div class="form-group">
                        <label for="ktpwaris">Ktp Ahli Waris</label>
                        <input type="text" class="form-control" id="ktpwarisid" name="ktpwaris" value="<?= $detail['ktpwaris'] ?>" placeholder="Ktp ahli waris" required="">
                    </div>
                    <div class="form-group">
                        <label for="hubwaris">Hubungan</label>
                        <!--<input type="text" class="form-control" name="hubwaris" value="<?= $detail['hubwaris'] ?>" placeholder="Hubungan dengan ahli waris" <?= $readonly ?> required="">-->
                        <select name="hubwaris" class="form-control" id="hubwarisid" required="">
                            <?php
                            $arr = ['anak' => "Anak", 'ortu' => "Orang tua", 'saudara' => "Saudara kandung", 'istri' => 'Istri', 'suami' => 'Suami'];
                            foreach ($arr as $val => $item) {
                                echo "<option value='$val'";
                                if ($detail['hubwaris'] == "$val") echo "selected='selected'";
                                echo ">$item</option>";
                            }
                            ?>
                        </select>
                        <?php echo form_error('hubwaris', '<span class="text-danger"', '</span>') ?>
                    </div>
                    <div class="form-group">
                        <label for="hpwaris">No. Hp</label>
                        <input type="text" class="form-control" id="hpwarisid" name="hpwaris" value="<?= $detail['hpwaris'] ?>" placeholder="No. kontak yang bisa dihubungi" required="">
                        <?php echo form_error('hpwaris', '<span class="text-danger"', '</span>') ?>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-lg btn-block">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>