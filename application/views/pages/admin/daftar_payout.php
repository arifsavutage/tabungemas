<div class="row justify-content-md-center">
    <div class="col-xs-12 col-sm-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Pay Out Keanggotaan TED</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#payOut">
                    Tambah Payout
                </button>

                <!-- Modal -->
                <div class="modal fade" id="payOut" tabindex="-1" role="dialog" aria-labelledby="payOutLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form name="addpayout" method="post" action="<?= base_url('index.php/transaksi/add_payout'); ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="payOutLabel">Form Tambah Payout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="nama">Nama Payout</label>
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama payout" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Nominal Payout</label>
                                        <input type="number" class="form-control" name="nominal" id="nominal" placeholder="isi nominal tanpa pemisah ribuan" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Member Aktif" />
                    <table class="table table-bordered display">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Payout</th>
                                <th>Nominal</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($pays as $pay) :
                                $total += $pay['nominal'];
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= ucwords($pay['nama_payout']); ?></td>
                                    <td><?= number_format($pay['nominal'], 0, '.', ','); ?></td>
                                    <td>
                                        <a href="<?= base_url() . "index.php/transaksi/edit_payout/$pay[id]"; ?>" class="btn btn-warning btn-sm" title="Edit" role="button"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url() . "index.php/transaksi/hapus_payout/$pay[id]"; ?>" class="btn btn-danger btn-sm" title="Hapus" role="button" onclick="return confirm('Penghapusan akan berpengaruh pada biaya registrasi. Hapus?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Uang Pendaftaran</th>
                                <th><?= number_format($total, 0, '.', ','); ?></th>
                                <th>&nbsp;</th>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>