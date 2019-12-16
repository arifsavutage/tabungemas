<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Member Aktif</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Daftar</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th><i class="fas fa-sitemap"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $detail) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('d-m-Y', strtotime($detail['tgl_gabung'])); ?></td>
                                    <td><?= ucwords($detail['nama_lengkap']); ?></td>
                                    <td><?= $detail['nohp']; ?></td>
                                    <td><?= $detail['email']; ?></td>
                                    <td>

                                        <a href="<?= base_url() . "index.php/member/profil_anggota/$detail[idted]"; ?>" class="btn btn-primary btn-sm" title="Lihat Profil" role="button"><i class="fas fa-user"></i></a>
                                        <a href="<?= base_url() . "index.php/member/update_pass_anggota/$detail[idted]"; ?>" class="btn btn-danger btn-sm" title="Update Password" role="button"><i class="fas fa-lock"></i></a>

                                        <!--
                                        <a href="<?= base_url() . "index.php/member/delRegistration/$detail[idtmp]"; ?>" class="btn btn-danger btn-sm" role="button" onclick="return valdel()"><i class="fas fa-user-times"></i></a>
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
                                        -->
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