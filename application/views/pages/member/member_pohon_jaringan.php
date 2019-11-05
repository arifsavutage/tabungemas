<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Tabel Referal</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Nama Anggota</th>
                            <th>Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($jaringan as $row) :
                            ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $row['idted']; ?></td>
                                <td><?= $row['nama_lengkap']; ?></td>
                                <td><?= $row['new_lvl']; ?></td>
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