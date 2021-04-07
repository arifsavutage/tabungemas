<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url('index.php/pengaturan/biaya_cetak/add') ?>" class="btn btn-secondary mb-4">
            <span class="btn-label"><i class="fas fa-plus"></i></span> Tambah
        </a>
        <div class="card">
            <div class="card-header">
                <h3>Biaya Cetak</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="table-responsive">
                    <table class="table example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>gram</th>
                                <th>Biaya</th>
                                <th>Keterangan</th>>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($biaya as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['jml_gram'] ?></td>
                                    <td><?= number_format($row['biaya'], 0, ',', '.') ?></td>
                                    <td><?= $row['ket'] ?></td>
                                    <td>
                                        <!--<a href="" class="btn btn-sm btn-primary mr-2"><i class="fas fa-eye"></i></a>-->
                                        <a href="<?= base_url('index.php/pengaturan/biaya_cetak/edit/' . $row['idx']) ?>" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                        <!--<a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>-->
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