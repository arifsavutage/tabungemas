<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Update Alamat & Kontak</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="nohp">No. Handphone</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $detail['nohp'] ?>">
                        <input type="hidden" name="idted" value="<?= $detail['idted']; ?>" />
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

                    <?php
                    if (($detail['nmwaris'] == "") && ($detail['hubwaris'] == "") && ($detail['hpwaris'] == "")) {
                        $disabled = '';
                    } else {
                        $disabled = 'disabled';
                    }
                    ?>
                    <fieldset <?= $disabled ?>>
                        <div class="form-group">
                            <label for="nmwaris">Nama Ahli Waris</label>
                            <input type="text" class="form-control" id="nmwarisid" name="nmwaris" value="<?= $detail['nmwaris'] ?>" placeholder="Nama ahli waris" required="">
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
                        </div>
                        <div class="form-group">
                            <label for="hpwaris">No. Hp</label>
                            <input type="text" class="form-control" id="hpwarisid" name="hpwaris" value="<?= $detail['hpwaris'] ?>" placeholder="No. kontak yang bisa dihubungi" required="">
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-secondary btn-lg btn-block">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>