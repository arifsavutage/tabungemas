<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Deposit</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="deposit" method="post" action="">
                    <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nominal">Nominal uang</label>
                            <input type="text" class="form-control" name="nominal" id="nominal" value="" placeholder="Rp." required>
                            <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="banktrf">Daftar Bank</label>
                            <select name="banktrf" id="banktrf" class="form-control" required>
                                <option value="">: Pilih</option>
                                <?php
                                foreach ($bank as $transfer) :
                                    ?>
                                    <option value="<?= $transfer['id']; ?>"><?= $transfer['nm_bank']; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <?= form_error('banktrf', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Tambah Deposit</button>

                </form>
            </div>
        </div>
    </div>
</div>