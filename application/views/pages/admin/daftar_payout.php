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
                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Member Aktif" />
                    <table class="table table-bordered display" id="export">
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