<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Transaksi Titipan Emas</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Titipan Emas">
                    <table class="table" id="export">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Nama Anggota</th>
                                <th>Tgl. Ikut</th>
                                <th>Tgl. Berakhir</th>
                                <th>Tenor</th>
                                <th>Jml. Gr</th>
                                <th>Harga</th>
                                <th>Jml. Uang</th>
                                <th>Status</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($lists as $row) :
                                if ($row['status'] == 'pending') {
                                    $status = "<span class='badge badge-secondary'>pending</span>";
                                } else {
                                    $status = "<span class='badge badge-success'>aktif</span>";
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><a href="<?= base_url() . 'index.php/member/profil_anggota/' . $row['idted']; ?>"><?= $row['idted']; ?></a></td>
                                    <td><?= ucwords($row['nama_lengkap']); ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_ikut'])); ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_berakhir'])); ?></td>
                                    <td><?= $row['tenor']; ?></td>
                                    <td><?= $row['gram']; ?></td>
                                    <td><?= $row['harga_ikut']; ?></td>
                                    <td><?= $row['jml_uang']; ?></td>
                                    <td><?= $status; ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 'pending') {
                                        ?>
                                            <a href="<?= base_url() . 'index.php/transaksi/titipan_emas_approve/' . $row['idx']; ?>" class="btn btn-sm btn-primary">approve</a>
                                            <!--
                                            <a href="<?= base_url() . 'index.php/transaksi/titipan_emas_cancel/' . $row['idx']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        -->
                                        <?php
                                        } else {
                                            echo "&nbsp;";
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