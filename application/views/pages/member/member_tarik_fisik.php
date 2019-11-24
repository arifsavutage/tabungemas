<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Tarik Fisik Emas</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="beliemas" method="post" action="">
                    <input type="hidden" name="keterangan" value="<?= "tarik fisik" ?> " />
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
                    <input type="hidden" name="status" value="0" />
                    <input type="hidden" name="pokok" value="<?= $pokok['saldo']; ?>" />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="saldo">Emas Anda</label>
                            <input type="text" class="form-control" name="saldo" id="saldo" value="<?= $emas['saldo']; ?>" placeholder="gr" readonly="true">
                            <?= form_error('saldo', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Gram</th>
                                        <th>Biaya</th>
                                        <th>Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($biaya as $row) :
                                        ?>
                                        <tr>
                                            <td><?= $row['jml_gram']; ?></td>
                                            <td><?= number_format($row['biaya'], 0, ',', '.'); ?></td>
                                            <td>
                                                <input type="radio" name="pilih" value="<?= $row['biaya'] . "-" . $row['jml_gram']; ?>" required />
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <p>
                            * minimal penjualan <strong>0,001 gr</strong><br />
                            ** penjualan emas <strong>Tidak Bisa</strong> di batalkan.<br />
                            *** pecahan (angka di belakang koma) <strong>menggunakan titik</strong>.
                        </p>
                    </div>
                                -->

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Tarik Emas Fisik</button>

                </form>

            </div>
        </div>
    </div>
</div>