<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Transaksi Deposit</h3>
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
                                <th>Tgl. Deposit</th>
                                <th>Nama Lengkap</th>
                                <th>Nom. Uang</th>
                                <th>Status Byr.</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($datas as $detail) :

                                if ($detail['status'] == 'tunggu') {
                                    $label = "<span class='badge badge-warning'>belum</span>";
                                } else {
                                    $label = "<span class='badge badge-success'>sudah</span>";
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('d-m-Y', strtotime($detail['tgl_deposit'])); ?></td>
                                    <td><?= ucwords($detail['nama_lengkap']); ?></td>
                                    <td><?= "Rp. " . number_format($detail['nom_deposit'], 0, ',', '.'); ?></td>
                                    <td><?= $label; ?></td>
                                    <td>
                                        <?php
                                        if ($detail['status'] == 'aproved') {
                                            $status = 'aria-disabled="true"';
                                            $disabled = "disabled";
                                        } else {
                                            $status = '';
                                            $disabled = "";
                                        }
                                        ?>

                                        <!-- Button trigger modal -->
                                        <a role="button" href="#" class="btn btn-primary btn-sm <?= $disabled; ?>" data-toggle="modal" data-target="#addToPay<?= $no; ?>" title="Konfirm pembayaran" <?= $status; ?>>
                                            <i class="fa fa-check"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addToPay<?= $no; ?>" tabindex="-1" role="dialog" aria-labelledby="addToPayLabel<?= $no; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form name="konfirmdeposit" method="post" action="">
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
                                                                        <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?= $detail['tgl_deposit']; ?>" readonly="true">
                                                                        <input type="hidden" name="idx" value="<?= $detail['idx']; ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="idted">ID Anggota</label>
                                                                        <input type="text" class="form-control" name="idted" id="idted" value="<?= $detail['idted']; ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama Lengkap</label>
                                                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $detail['nama_lengkap']; ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="uang">Nominal Deposit</label>
                                                                        <input type="uang" class="form-control" id="uang" name="uang" value="<?= $detail['nom_deposit']; ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="bank">Tujuan Bank Trf.</label>
                                                                        <input type="text" class="form-control" id="bank" name="bank" value="<?= $detail['nm_bank'] ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="norek">Rek. Tujuan</label>
                                                                        <input type="text" class="form-control" id="norek" name="norek" value="<?= $detail['norek'] ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="an">An</label>
                                                                        <input type="text" class="form-control" id="an" name="an" value="<?= $detail['an'] ?>" readonly="true">
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

                                        <a href="<?= base_url() . "index.php/transaksi/batal_deposit/$detail[idx]"; ?>" class="btn btn-danger btn-sm" tabindex="-1" role="button" onclick="return valdel()" <?= $status; ?>><i class="fa fa-times"></i></a>
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