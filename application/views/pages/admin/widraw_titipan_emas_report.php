<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Transfer Profit Titipan Emas</h3>
            </div>
            <div class="card-body">
                <a href="<?= base_url('index.php/transaksi/titipan_emas_widraw'); ?>" class="btn btn-primary">Kembali</a>
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>

                <br />
                <br />
                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Titipan Emas">
                    <table class="table" id="export">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <!--<th>ID</th>
                                <th>Nama Anggota</th>-->
                                <th>Periode</th>
                                <th>Tgl. Trf</th>
                                <!--<th>Bank</th>
                                <th>No. rek</th>
                                <th>An</th>-->
                                <th>Total Nominal</th>
                                <th>Status</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) :

                                $p = str_replace(" ", "_", $row['periode']);
                                if ($row['is_transfer'] == 0) {
                                    $status = "<span class='badge badge-danger'>pending</span>";
                                    $button = '<a href="' . base_url('index.php/transaksi/transfer_profit_titipan/') . $p . '" class="btn btn-sm btn-success">transfer</a>';
                                    $batal = "<a href=" . base_url('index.php/transaksi/batal_transfer_profit_titipan/') . $p . " onclick='return batalin()' class='btn btn-sm btn-danger'>batal</a>";
                                } else {
                                    $status = "<span class='badge badge-success'>paid</span>";
                                    $button = '<a href="" class="btn btn-sm btn-success disabled" aria-disabled="true">transfer</a>';
                                    $batal = '';
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <!--<td><a href="<?= base_url() . 'index.php/member/profil_anggota/' . $row['idted']; ?>"><?= $row['idted']; ?></a></td>
                                    <td><?= ucwords($row['nama_lengkap']); ?></td>-->
                                    <td><?= $row['periode']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_trf'])); ?></td>
                                    <!--<td><?= strtoupper($row['bank']); ?></td>
                                    <td><?= $row['norek']; ?></td>
                                    <td><?= ucwords($row['an']); ?></td>-->
                                    <td><?= number_format($row['totalnominal'], 0, '.', ','); ?></td>
                                    <td><?= $status; ?></td>
                                    <td>
                                        <?= $button ?>

                                        <?php
                                        if ($row['tgl_trf'] > '2020-11-30') {
                                        ?>
                                            <a href="<?= base_url('index.php/transaksi/detail_transfer_profit_emas/') . "$p"; ?>" class="btn btn-danger btn-sm" title="daftar anggota"><i class="fas fa-file"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?= base_url('index.php/transaksi/detail_transfer_profit/') . "$p"; ?>" class="btn btn-info btn-sm" title="daftar anggota"><i class="fas fa-file"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <?= $batal ?>
                                        <script>
                                            function batalin() {
                                                var r = confirm("dengan ini maka data generate akan di hapus, tekan OK untuk melanjutkan");

                                                if (r == true) {
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