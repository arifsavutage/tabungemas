<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Buat Laporan Transfer Profit Titipan Emas</h4>
            </div>
            <div class="card-body">
                <a href="<?= base_url('index.php/transaksi/daftar_titipan_emas'); ?>" class="btn btn-primary mb-4">Kembali</a>
                <a href="<?= base_url('index.php/transaksi/titipan_emas_widraw_report'); ?>" class="btn btn-danger mb-4">Daftar Laporan</a>
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="widrawprofit" method="post" action="">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="bulan">Periode</label>
                            <select name="bulan" class="form-control">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <?= form_error('bulan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col">
                            <label for="tahun">Periode</label>
                            <input type="text" class="form-control" name="tahun" placeholder="yyyy" value="<?= date('Y'); ?>" required="required" />
                            <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label class="sr-only" for="tgl1">Tanggal Transfer</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control" name="tgl1" id="tgl1" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Buat Laporan</button>

                </form>
            </div>
        </div>
    </div>
</div>