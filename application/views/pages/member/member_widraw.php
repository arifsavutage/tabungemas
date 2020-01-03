<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Tarik Saldo Wallet</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="tarikdana" method="post" action="">
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                    <input type="hidden" name="keterangan" value="<?= "penarikan saldo wallet" ?> " />
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
                    <input type="hidden" name="status" value="0" />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="walletku">Saldo Wallet</label>
                            <input type="text" class="form-control" name="walletku" id="walletku" value="<?= $saldo_wallet['saldo']; ?>" readonly="true">
                            <?= form_error('walletku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="nominal">Nominal Penarikan</label>
                            <input type="text" class="form-control" name="nominal" id="nominal" value="" placeholder="nominal Rp">
                            <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="byadmin">Biaya Admin</label>
                            <input type="text" class="form-control" name="byadmin" id="byadmin" value="<?= $byadmin['by_adm_master']; ?>" readonly="true">
                            <?= form_error('byadmin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bankagt">Bank Transfer</label>
                            <input type="text" class="form-control" name="bankagt" id="bankagt" value="<?= $detail['bank']; ?>" readonly="true">
                            <?= form_error('bankagt', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nrkagt">No. Rek</label>
                            <input type="text" class="form-control" name="nrkagt" id="nrkagt" value="<?= $detail['norek']; ?>" readonly="true">
                            <?= form_error('nrkagt', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="anagt">An.</label>
                            <input type="text" class="form-control" name="anagt" id="anagt" value="<?= $detail['an']; ?>" readonly="true">
                            <?= form_error('anagt', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" id="widraw" class="btn btn-primary btn-lg btn-block">Tarik Dana</button>

                </form>

            </div>
        </div>
    </div>
</div>