<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Transfer</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="transfer" method="post" action="">
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                    <input type="hidden" name="keterangan" value="<?= "transfer" ?> " />
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
                    <input type="hidden" name="status" value="0" />

                    <span class="d-block p-2 bg-dark text-white">
                        <h6>Pilih Mode Transfer</h6>
                    </span>

                    <br />
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="mode1" value="uang">
                                <label class="form-check-label" for="mode1">Rupiah (dari wallet)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="mode2" value="emas">
                                <label class="form-check-label" for="mode">Emas</label>
                            </div>
                            <?= form_error('mode', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <hr />
                    <div class="form-row" id="saldowallet">
                        <div class="form-group col-md-12">
                            <label for="walletku">Saldo Wallet</label>
                            <input type="text" class="form-control" name="walletku" id="walletku" value="<?= $saldo_wallet['saldo']; ?>" readonly="true">
                            <?= form_error('walletku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row" id="saldoemas">
                        <div class="form-group col-md-12">
                            <label for="emasku">Emas Anda</label>
                            <input type="text" class="form-control" name="emasku" id="emasku" value="<?= $saldo_emas['saldo']; ?>" readonly="true">
                            <?= form_error('emasku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="form-control" name="nominal" id="nominal" value="" placeholder="nominal Rp / gr">
                            <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idtujuan">Transfer ke</label>
                            <input type="text" class="form-control" name="idtujuan" id="idtujuan" value="" placeholder="id tujuan">
                            <?= form_error('idtujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Transfer</button>

                </form>

            </div>
        </div>
    </div>
</div>