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
                    <input type="hidden" name="keterangan" value="<?= "transfer emas ke " ?> " />
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
                    <input type="hidden" name="status" value="0" />

                    <div class="form-row" id="saldoemas">
                        <div class="form-group col-md-6">
                            <label for="emasku">Emas Anda</label>
                            <input type="text" class="form-control" name="emasku" id="emasku" value="<?= $saldo_emas['saldo']; ?>" readonly="true">
                            <?= form_error('emasku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gramtrf">Jml Gram</label>
                            <input type="text" maxlength="5" class="form-control" name="gramtrf" id="gramtrf" value="" placeholder="ex: 0.009">
                            <?= form_error('gramtrf', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idtujuan">Transfer ke</label>
                            <input type="text" class="form-control" name="idtujuan" id="idtujuan" placeholder="ID tujuan" maxlength="8" />
                            <?= form_error('idtujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="namatujuan">Nama Anggota</label>
                            <input type="text" class="form-control" name="namatujuan" readonly="true" id="namatujuan" placeholder="" />
                            <?= form_error('namatujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>No. Telp</label>
                            <input type="text" id="hp" class="form-control" readonly="true" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" id="email" class="form-control" readonly="true" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Alamat</label>
                            <textarea id="alamat" class="form-control" readonly="true"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <label>Foto</label>
                            <div id="imgid"></div>
                        </div>
                    </div>

                    <button type="submit" onsubmit="return valtrf()" class="btn btn-primary btn-lg btn-block">Transfer</button>

                </form>

            </div>
        </div>
    </div>
</div>