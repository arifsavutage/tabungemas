<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Jual Emas</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="beliemas" method="post" action="">
                    <input type="hidden" name="hrgjual" id="hrgjual" value="<?= $jual; ?> " />
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                    <input type="hidden" name="keterangan" value="<?= "jual emas" ?> " />
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
                    <input type="hidden" name="status" value="0" />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="saldo">Emas Anda</label>
                            <input type="text" class="form-control" name="saldo" id="saldo" value="<?= $saldo_emas['saldo']; ?>" placeholder="gr" readonly="true">
                            <?= form_error('saldo', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gram">Jumlah Emas</label>
                            <input type="text" maxlength="5" class="form-control" name="gram" id="gram" value="" placeholder="gr">
                            <?= form_error('gram', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uang">Nominal uang</label>
                            <input type="text" class="form-control" name="uang" id="uang" value="" placeholder="1.000" readonly="true">
                            <?= form_error('uang', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <p>
                            * minimal penjualan <strong>0,001 gr</strong><br />
                            ** penjualan emas <strong>Tidak Bisa</strong> di batalkan.
                            *** pecahan (angka di belakang koma) <strong>menggunakan titik</strong>.
                        </p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Jual Emas</button>

                </form>

            </div>
        </div>
    </div>
</div>