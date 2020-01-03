<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Penarikan Wallet</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>

                <div class="card mb-3">
                    <div class="card-body">
                        <form name="cekwidraw" method="post" action="">
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <label class="sr-only" for="tgl1">Tgl Awal</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control" name="tgl1" id="tgl1" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label class="form-check-label">
                                        s/d
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="sr-only" for="tgl2">Tgl Akhir</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control" name="tgl2" id="tgl2" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-warning mb-2">Cek</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <?php
                if (isset($_POST)) :
                ?>
                    <div class="table-responsive">
                        <table class="display nowrap" id="examplebtn">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tgl. WIdraw</th>
                                    <th>Nama Lengkap</th>
                                    <th>Bank</th>
                                    <th>Norek</th>
                                    <th>An</th>
                                    <th>Nominal</th>
                                    <th>By. Adm</th>
                                    <th>Nom. Trf</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total_nom = 0;
                                $total_by = 0;
                                $total_trf = 0;
                                foreach ($widraws as $detail) :
                                ?>
                                    <tr>
                                        <td scope="row"><?= $no; ?></td>
                                        <td><?= date('d-m-Y', strtotime($detail['tgl_pengajuan'])); ?></td>
                                        <td><?= ucwords($detail['nama_lengkap']); ?></td>
                                        <td><?= strtoupper($detail['bank']); ?></td>
                                        <td><?= $detail['norek']; ?></td>
                                        <td><?= ucwords($detail['an']); ?></td>
                                        <td><?= number_format($detail['nominal'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($detail['biaya_adm'], 0, ',', '.'); ?></td>
                                        <td>
                                            <?php
                                            $trf = $detail['nominal'] - $detail['biaya_adm'];

                                            $total_nom = $total_nom + $detail['nominal'];
                                            $total_by = $total_by + $detail['biaya_adm'];
                                            $total_trf = $total_trf + $trf;
                                            echo number_format($trf, 0, ',', '.');
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th colspan="5">Total</th>
                                    <th><?= number_format($total_nom, 0, ',', '.'); ?></th>
                                    <th><?= number_format($total_by, 0, ',', '.'); ?></th>
                                    <th><?= number_format($total_trf, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>