<a role="button" href="<?= base_url() . "index.php/transaksi/titipan_emas/" . $this->session->userdata('id'); ?>" class="btn btn-primary"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Kembali</a>

<div class="row mt-4">
    <?php
    foreach ($titipan as $baris) :
        if ($baris['status'] == 'pending') {
            $label = "<span class='badge badge-secondary'>pending</span>";
        } else if ($baris['status'] == 'aktif') {
            $label = "<span class='badge badge-success'>aktif</span>";
        } else if ($baris['status'] == 'berhenti') {
            $label = "<span class='badge badge-danger'>berhenti</span>";
        }


        $profit_gr      = ($baris['totalpersen'] / 100) * $baris['gram'];
        $profit_uang    = $profit_gr * $baris['harga_ikut'];
    ?>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card-box noradius noborder bg-info">

                <h6 class="text-white text-uppercase m-b-20">Periode <small class="text-white float-right"><?= date('d M Y', strtotime($baris['tgl_ikut'])); ?> - <?= date('d M Y', strtotime($baris['tgl_berakhir'])); ?></small></h6>
                <p class="text-white">
                    <span class="mr-3"><i class="fa fa-clock-o" style="font-size: 1rem !important;"></i> <?= $baris['tenor'] . " bln"; ?></span>
                    <span class="mr-3"><i class="fa fa-balance-scale" style="font-size: 1rem !important;"></i> <?= $baris['gram'] . " gr"; ?></span>
                    <span class="mr-3"><i class="fa fa-money" style="font-size: 1rem !important;"></i> <?= number_format($baris['harga_ikut'], 0, ',', '.') . " IDR"; ?></span>
                    <span><i class="fa fa-check-square-o" style="font-size: 1rem !important;"></i> <?= $label ?></span>
                </p>
                <h1 class="m-b-20 text-white counter">Rp. <?= number_format($profit_uang, 0, ',', '.') ?></h1>
                <p class="text-white">
                    <span class="mr-2">Profit:</span>
                    <span class="mr-2"><?= $baris['totalpersen']; ?> <i class="fa fa-percent" style="font-size: 1rem !important;"></i></span>
                    <span><i class="fa fa-balance-scale" style="font-size: 1rem !important;"></i> <?= $profit_gr . " gr"; ?></span>
                </p>
            </div>
        </div>
    <?php
    endforeach;
    ?>
</div>
<!--
<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-8 offset-lg-2 col-xl-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h4>Titipan Emas</h4>
            </div>
            <div class="card-body">

                <a href="<?= base_url() . "index.php/transaksi/titipan_emas/" . $this->session->userdata('id'); ?>" class="btn btn-success">Kembali</a>
                <br />
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl Ikut</th>
                                <th>Tgl Berakhir</th>
                                <th>Tenor</th>
                                <th>Gram</th>
                                <th>Status</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($titipan as $row) :
                                if ($row['status'] == 'pending') {
                                    $label = "<span class='badge badge-secondary'>pending</span>";
                                } else if ($row['status'] == 'aktif') {
                                    $label = "<span class='badge badge-success'>aktif</span>";
                                } else if ($row['status'] == 'berhenti') {
                                    $label = "<span class='badge badge-danger'>berhenti</span>";
                                }
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_ikut'])); ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_berakhir'])); ?></td>
                                    <td><?= $row['tenor'] . " bln"; ?></td>
                                    <td><?= $row['gram'] . " gr"; ?></td>
                                    <td><?= $label; ?></td>
                                    <td>
                                        <?php
                                        if (date('Y-m-d') == $row['tgl_berakhir']) {
                                            echo "<a href='' class='btn btn-sm btn-primary' title='ikut lagi'><i class='fas fa-retweet'></i></a>";
                                        } else {
                                            echo "<a href='' class='btn btn-sm btn-secondary' title='detail'><i class='fas fa-file'></i> detail</a>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
                        -->