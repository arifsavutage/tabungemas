<div class="row">
    <div class="col-md-12 col-xl-12">

        <!-- Labels -->
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-default">
                    <i class="fa fa-file-text-o float-right text-white"></i>
                    <h6 class="text-white text-uppercase m-b-20">Total Transaksi</h6>
                    <h1 class="m-b-20 text-white counter"><?= $transaksi; ?></h1>
                    <span class="text-white"><?= $toptransaksi; ?> Transaksi Baru</span>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-warning">
                    <i class="fa fa-bar-chart float-right text-white"></i>
                    <h6 class="text-white text-uppercase m-b-20">Visitors</h6>
                    <h1 class="m-b-20 text-white counter">250</h1>
                    <span class="text-white">Bounce rate: 25%</span>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-info">
                    <i class="fa fa-user-o float-right text-white"></i>
                    <h6 class="text-white text-uppercase m-b-20">Total Anggota</h6>
                    <h1 class="m-b-20 text-white counter"><?= $users; ?></h1>
                    <span class="text-white"><?= $newusers; ?> Anggota Baru</span>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-danger">
                    <i class="fa fa-bell-o float-right text-white"></i>
                    <h6 class="text-white text-uppercase m-b-20">Alerts</h6>
                    <h1 class="m-b-20 text-white counter">58</h1>
                    <span class="text-white">5 New Alerts</span>
                </div>
            </div>
        </div>
        <!-- Labels -->


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Info Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('info')) {
                            echo $this->session->flashdata('info');
                        }
                        ?>
                        <?php
                        foreach ($jual_id as $rowid) :
                            $totalbyr = $rowid['nominal_gram'] * $rowid['nominal_uang'];
                        ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">Hi,</h4>
                                        <p>Kami informasikan bahwa <strong><?= ucwords($rowid['nama_lengkap']); ?></strong> mengajukan penjualan emas seberat <strong><?= $rowid['nominal_gram'] ?> gr</strong> dengan harga <strong>Rp. <?= number_format($rowid['nominal_uang'], 0, ',', '.'); ?> /gr</strong> kepada Anda.</p>
                                        <p>Silahkan lakukan pembayaran jika Anda menghendaki transaksi ini.</p>
                                        <hr>
                                        <p class="mb-0">Catatan :<br />Pihak <strong>Tabung Emas Digital (TED)</strong> tidak bertanggungjawab atas transaksi yang dilakukan di luar sistem kami.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Payment</h4>
                                            <form name="jualkeid" method="post" action="<?= base_url() . "index.php/transaksi/payment"; ?>">
                                                <input type="hidden" name="idx" value="<?= $rowid['idx']; ?>" />
                                                <input type="hidden" name="gram" value="<?= $rowid['nominal_gram'] ?>" />
                                                <input type="hidden" name="keterangan" value="<?= "bayar emas dari ID " . $rowid['idted'] . " " . $rowid['nominal_gram'] . "gr, @ Rp. " . number_format($rowid['nominal_uang'], 0, ',', '.'); ?> " />
                                                <input type="hidden" name="idted" id="idted" value="<?= $this->session->userdata('id'); ?> " />
                                                <input type="hidden" name="idpenjual" value="<?= $rowid['idted'] ?>" />

                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="walletku">Saldo Wallet</label>
                                                        <input type="text" class="form-control" name="walletku" id="walletku" value="<?= $saldo_rp['saldo']; ?>" readonly="true">
                                                        <?= form_error('walletku', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="gr">Jml Gram</label>
                                                        <input type="text" class="form-control" name="gr" id="gr" value="<?= number_format($rowid['nominal_gram'], 3, '.', ','); ?>" readonly="true" />
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="hrgsatuan">Hrg / gr</label>
                                                        <input type="text" class="form-control" name="hrgsatuan" id="hrgsatuan" value="<?= $rowid['nominal_uang']; ?>" readonly="true" />
                                                        <?= form_error('hrgsatuan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="totalbayar">Total Bayar</label>
                                                        <input type="text" class="form-control" name="totalbayar" id="totalbayar" value="<?= $totalbyr; ?>" readonly="true" />
                                                        <?= form_error('totalbayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <small class="form-text text-muted">
                                                            Lakukan penambahan deposit jika saldo wallet Anda tidak mencukupi.
                                                        </small>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Bayar</button>
                                                <br />
                                                <a href="<?= base_url() . "index.php/transaksi/paymentcancel/" . $rowid['idx']; ?>" class="btn btn-warning btn-lg btn-block" role="button">Batalkan Transasksi</a>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>

                        <?php
                        $jml    = count($jualan);
                        //echo $jml;

                        if ($jml > 0) :
                        ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID.</th>
                                            <th>Nama Anggota</th>
                                            <th>Jml Gram</th>
                                            <th>Harga / gr</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $n = 1;
                                        foreach ($jualan as $rowss) :
                                        ?>
                                            <tr>
                                                <td><?= $n; ?></td>
                                                <td><?= $rowss['tujuan_jual']; ?></td>
                                                <td><?= $rowss['nama_lengkap']; ?></td>
                                                <td><?= $rowss['nominal_gram']; ?></td>
                                                <td><?= number_format($rowss['nominal_uang'], 0, ',', '.'); ?></td>
                                                <td><?= $rowss['status']; ?></td>
                                            </tr>
                                        <?php
                                            $n++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>

            </div>
        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Harga Emas Terkini</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="examples">
                                <thead>
                                    <tr>
                                        <th>UPDATE TANGGAL</th>
                                        <th>HARGA BELI</th>
                                        <th>HARGA JUAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $selisih_beli   = $selisih['selisih_beli'];
                                    $selisih_jual   = $selisih['selisih_jual'];

                                    foreach ($emas as $updates) :
                                    ?>
                                        <tr>
                                            <td><?= date('Y-m-d', strtotime($updates['UPDATE_AT'])); ?></td>
                                            <td>
                                                <?php
                                                $xhbeli = explode(",", $updates['HRG_BELI']);
                                                $ihbeli = implode("", $xhbeli);

                                                $hrg_beli = $ihbeli - $selisih_beli;

                                                echo number_format($hrg_beli, 0, ',', '.');

                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $xhjual = explode(",", $updates['HRG_JUAL']);
                                                $ihjual = implode("", $xhjual);

                                                $hrg_jual = $ihjual + $selisih_jual;

                                                echo number_format($hrg_jual, 0, ',', '.');

                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>