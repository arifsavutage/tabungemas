<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Titipan Emas</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="titipanemas" method="post" action="">
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                    <input type="hidden" name="keterangan" value="<?= "ikut titipan emas" ?> " />
                    <input type="hidden" name="idted" value="<?= $idted; ?> " />
                    <input type="hidden" name="status" value="pending" />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="emasku">Emas Anda</label>
                            <input type="text" class="form-control" name="emasku" id="emasku" value="<?= $saldo_emas['saldo']; ?>" readonly="true">
                            <?= form_error('emasku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="gramtrf">Jml Gram</label>
                            <!--<input type="text" maxlength="5" class="form-control" name="gramtrf" id="gramtrf" value="" placeholder="cth pecahan: 2.999">
                            <small class="form-text text-muted">minimal 2 gr.</small>-->
                            <select name="gramtrf" class="form-control">
                                <option value="">: Pilih</option>
                                <?php
                                // $i = 2;
                                // $emas   = 1000;
                                // while ($i <= $emas) {
                                //     echo "<option value='$i'>$i</option>";
                                //     $i += 2;
                                // }
                                $emas = [25, 45, 85, 125];
                                foreach ($emas as $i) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                            <?= form_error('gramtrf', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="tenor">Tenor</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tenor" id="tenor3" value="6" checked>
                                <label class="form-check-label">
                                    6 Bulan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tenor" id="tenor1" value="12">
                                <label class="form-check-label">
                                    12 Bulan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tenor" id="tenor2" value="24">
                                <label class="form-check-label">
                                    24 Bulan
                                </label>
                            </div>
                            <?= form_error('tenor', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required>
                        <label class="form-check-label" for="agreement">Persetujuan</label>
                        <p>
                            Dengan ini saya menyetujui <a href="https://www.tabungemas.com/syarat-dan-ketentuan-titipan-emas/" target="_blank">syarat dan ketentuan</a>
                        </p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>

                </form>

                <br />
                <?php
                if ($this->session->userdata('id') == $idted) :
                ?>
                    <a href="<?= base_url('index.php/transaksi/titipan_emas_profit/') ?>" class=" btn btn-success btn-lg btn-block">Lihat Profit</a>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>