<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Transaksi Pembelian Emas</h3>
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
                                <th>Tgl. Beli</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Nom. Uang</th>
                                <th>Nom. Gram</th>
                                <th>Status Byr.</th>
                                <th><i class="fas fa-sitemap"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($datas as $detail) :

                                if ($detail['status'] == 0) {
                                    $label = "<span class='badge badge-warning'>belum</span>";
                                } else {
                                    $label = "<span class='badge badge-success'>sudah</span>";
                                }
                                ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('d-m-Y', strtotime($detail['tgl'])); ?></td>
                                    <td><?= ucwords($detail['nama_lengkap']); ?></td>
                                    <td><?= $detail['nohp']; ?></td>
                                    <td><?= "Rp. " . number_format($detail['nominal_uang'], 0, ',', '.'); ?></td>
                                    <td><?= $detail['nominal_gram']; ?></td>
                                    <td><?= $label; ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a role="button" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addToPay<?= $no; ?>" title="Konfirm pembayaran">
                                            <i class="fa fa-check"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addToPay<?= $no; ?>" tabindex="-1" role="dialog" aria-labelledby="addToPayLabel<?= $no; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form name="tambahjaringan" method="post" action="">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addToPayLabel<?= $no; ?>">Konfirm Pembayaran</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="tgltrans">Tanggal Transaksi</label>
                                                                        <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?= $detail['tgl']; ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="idted">ID Anggota</label>
                                                                        <input type="text" class="form-control" name="idted" id="idted" value="<?= $detail['idted']; ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama Lengkap</label>
                                                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $detail['nama_lengkap']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="uang">Nominal Uang</label>
                                                                        <input type="uang" class="form-control" id="uang" name="uang" value="<?= $detail['nominal_uang']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gram">Nominal Gram</label>
                                                                        <input type="text" class="form-control" id="gram" name="gram" value="<?= $detail['nominal_gram'] ?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Konfirm Sekarang</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <?php
                                            if ($detail['status'] == 1) {
                                                $status = 'aria-disabled="true"';
                                                $disabled = "disabled";
                                            } else {
                                                $status = '';
                                                $disabled = "";
                                            }
                                            ?>
                                        <a href="<?= base_url() . "index.php/transaksi/hapus_beli_emas/$detail[idted]/$detail[tgl]"; ?>" class="btn btn-danger btn-sm <?= $disabled; ?>" tabindex="-1" role="button" onclick="return valdel()" <?= $status; ?>><i class="fa fa-times"></i></a>
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