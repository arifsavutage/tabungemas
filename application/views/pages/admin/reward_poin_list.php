<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url('index.php/pengaturan/hadiah_reward_poin/add') ?>" class="btn btn-secondary mb-4">
            <span class="btn-label"><i class="fas fa-plus"></i></span> Tambah
        </a>
        <div class="card">
            <div class="card-header">
                <h3>Daftar Hadiah Reward Poin</h3>
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
                                <th>Judul Reward</th>
                                <th>Target Poin</th>
                                <th>Keterangan</th>
                                <th>Banner</th>
                                <!--<th><i class="fas fa-cog"></i></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($reward as $rw) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= strtoupper($rw['judul']) ?></td>
                                    <td><?= number_format($rw['target_poin'], 0, '.', ',') ?></td>
                                    <td><?= $rw['keterangan'] ?></td>
                                    <td>
                                        <img src="<?php echo base_url('assets/images/reward/') . $rw['gambar'] ?>" class="ing-fluid" width="60" height="60" />
                                    </td>
                                    <!--<td>
                                        <a href="" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>&nbsp;
                                        <a href="" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>&nbsp;
                                        <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>-->
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