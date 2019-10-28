<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Member Baru</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tgl. Daftar</th>
                            <th>Nama Lengkap</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>ID Referal</th>
                            <th>Nom. Trf</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list as $row) :

                            if ($row['konfirm_status'] == 0) {
                                $label = "<span class='badge badge-warning'>belum</span>";
                            } else {
                                $label = "<span class='badge badge-success'>sudah</span>";
                            }
                            ?>
                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tgl_daftar'])); ?></td>
                                <td><?= ucwords($row['nama_lengkap']); ?></td>
                                <td><?= $row['nohp']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['idreferal']; ?></td>
                                <td><?= "Rp. " . number_format($row['nominal'], 0, ',', '.'); ?></td>
                                <td><?= $label; ?></td>
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