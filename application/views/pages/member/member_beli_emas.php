<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Beli Emas</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="beliemas" method="post" action="">
                    <input type="hidden" name="hrgbeli" id="hrgbeli" value="<?= $beli; ?> " />
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                    <input type="hidden" name="keterangan" value="<?= "pembelian emas" ?> " />
                    <input type="hidden" name="idted" value="<?= $idted; ?> " />
                    <input type="hidden" name="status" value="0" />

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nominaluang">Nominal uang</label>
                            <input type="text" class="form-control" name="nominaluang" id="nominaluang" value="" placeholder="1.000">
                            <?= form_error('nominaluang', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nominalgram">Jumlah Emas</label>
                            <input type="text" class="form-control" name="nominalgram" id="nominalgram" value="" placeholder="gr" readonly="true">
                            <?= form_error('nominalgram', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <br />
                    <span class="d-block p-2 bg-dark text-white">
                        <h6>Pilih Cara Bayar</h6>
                    </span>

                    <br />
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode" id="metode1" value="wallet" checked>
                                <label class="form-check-label" for="metode1">Dari Wallet</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode" id="metode2" value="transfer">
                                <label class="form-check-label" for="metode">Transfer Bank</label>
                            </div>
                            <?= form_error('metode', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="saldowallet">Saldo Wallet</label>
                            <input type="text" class="form-control" name="saldowallet" id="saldowallet" value="<?= $wallet; ?>">
                            <?= form_error('saldowallet', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bank">Daftar Bank</label>
                            <select name="bank" id="bank" class="form-control">
                                <option value="">: Pilih</option>
                                <?php
                                foreach ($bank as $transfer) :
                                ?>
                                    <option value="<?= $transfer['id']; ?>"><?= $transfer['nm_bank']; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <?= form_error('bank', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Beli</button>

                </form>
            </div>
        </div>
    </div>
</div>