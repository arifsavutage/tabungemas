<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Referal ID</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Nama Anggota</th>
                            <th>Tgl. Gabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($referals as $row) :
                        ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $row['idted']; ?></td>
                                <td><?= strtoupper(strtolower($row['nama_lengkap'])); ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tgl_gabung'])); ?></td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>