<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Rekening Kantor</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <a role="button" href="<?= base_url() . 'index.php/pengaturan/add_rekening'; ?>" class="btn btn-primary">
                    <span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Rekening
                </a>
                <br />
                <br />
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Bank</th>
                                <th>Atas Nama</th>
                                <th>No. Rek</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($banks as $detail) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= strtoupper($detail['nm_bank']); ?></td>
                                    <td><?= ucwords($detail['an']); ?></td>
                                    <td><?= $detail['norek']; ?></td>
                                    <td>
                                        <a href="<?= base_url() . "index.php/pengaturan/hapus_rekening/$detail[id]"; ?>" class="btn btn-danger btn-sm" tabindex="-1" role="button" onclick="return valdel()"><i class="fa fa-times"></i></a>
                                        <script>
                                            function valdel() {
                                                var conf = confirm("Apakah yakin data akan dihapus?");

                                                if (conf == true) {
                                                    return true;
                                                } else {
                                                    return false;
                                                }
                                            }
                                        </script>
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