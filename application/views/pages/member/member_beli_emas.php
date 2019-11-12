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
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
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

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Beli</button>

                </form>
            </div>
        </div>
    </div>
</div>