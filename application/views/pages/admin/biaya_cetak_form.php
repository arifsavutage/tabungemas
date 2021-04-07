<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3><?= $title ?></h3>
            </div>
            <div class="card-body">
                <form name="addbiayacetak" action="<?= base_url($action) ?>" method="post">
                    <div class="form-group">
                        <label>Jumlah Gram <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jml_gram" value="<?= $jml_gram ?>" />
                        <?= form_error('jml_gram', '<small class="text-danger">', '</small>'); ?>
                        <small class="form-text text-muted">pemisah desimal menggunakan <strong>titik</strong></small>
                    </div>
                    <div class="form-group">
                        <label>Biaya <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="biaya" value="<?= $biaya ?>" />
                        <?= form_error('biaya', '<small class="text-danger">', '</small>'); ?>
                        <small class="form-text text-muted">tuliskan biaya tanpa pemecah ribuan</small>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="ket" value="<?= $ket ?>" />
                    </div>

                    <input type="hidden" name="idx" value="<?= $idx ?>" />

                    <div class="form-group">
                        <a href="<?= base_url('index.php/pengaturan/biaya_cetak/'); ?>" class="btn btn-secondary">Batal</a>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>