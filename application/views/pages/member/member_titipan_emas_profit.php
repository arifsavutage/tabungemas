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