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

                <div class="row mb-4">
                    <div class="col-md-4 datesearchbox"></div>
                    <div class="col-md-8">
                        <?php if ($this->session->userdata('roleid') == 1) : ?>
                            <a role="button" href="<?= base_url() . 'index.php/transaksi/titipan_emas_addprofit'; ?>" class="btn btn-primary">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>Nominal Profit
                            </a>
                        <?php
                        endif;
                        ?>
                        <a role="button" href="<?= base_url() . 'index.php/transaksi/titipan_emas_profitreport'; ?>" class="btn btn-secondary">
                            <span class="btn-label"><i class="fa fa-file"></i></span>Laporan Profit
                        </a>
                        <a role="button" href="<?= base_url() . 'index.php/transaksi/titipan_emas_widraw'; ?>" class="btn btn-success">
                            <span class="btn-label"><i class="fa fa-bank"></i></span>Transfer Profit
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Titipan Emas">
                    <table class="table" id="daterange">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Ikut</th>
                                <th>Tgl. Berakhir</th>
                                <th>ID</th>
                                <th>Nama Anggota</th>
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
                                } else if ($row['status'] == 'berhenti') {
                                    $status = "<span class='badge badge-danger'>berhenti</span>";
                                } else {
                                    $status = "<span class='badge badge-success'>aktif</span>";
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_ikut'])); ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_berakhir'])); ?></td>
                                    <td><a href="<?= base_url() . 'index.php/member/profil_anggota/' . $row['idted']; ?>"><?= $row['idted']; ?></a></td>
                                    <td><?= ucwords(strtolower($row['nama_lengkap'])); ?></td>
                                    <td><?= $row['tenor']; ?></td>
                                    <td><?= $row['gram']; ?></td>
                                    <td><?= number_format($row['harga_ikut'], 0, ',', '.'); ?></td>
                                    <td><?= number_format($row['jml_uang'], 0, ',', '.'); ?></td>
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