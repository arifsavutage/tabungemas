<div class="row">
    <div class="col-xs-12 col-md-12 col-xl-12">

        <div class="card">
            <div class="card-header">
                <h4>Update Harga Emas</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $new    = [];
                    $old    = [];

                    $x = 1;
                    foreach ($harga_emas as $update_emas) :
                        if ($x == 1) {
                            array_push($new, $update_emas);
                        } else {
                            array_push($old, $update_emas);
                        }
                        $x++;
                    endforeach;

                    $xnewbeli   = explode(",", $new[0]['HRG_BELI']);
                    $xnewjual   = explode(",", $new[0]['HRG_JUAL']);
                    $newbeli    = implode("", $xnewbeli) - $selisih['selisih_beli'];
                    $newjual    = implode("", $xnewjual) + $selisih['selisih_jual'];
                    $newupdate  = date('d M Y', strtotime($new[0]['UPDATE_AT']));

                    $xoldbeli   = explode(",", $old[0]['HRG_BELI']);
                    $xoldjual   = explode(",", $old[0]['HRG_JUAL']);
                    $oldbeli    = implode("", $xoldbeli) - $selisih['selisih_beli'];
                    $oldjual    = implode("", $xoldjual) + $selisih['selisih_jual'];
                    $oldupdate  = date('d M Y', strtotime($old[0]['UPDATE_AT']));

                    //beli
                    if ($newbeli < $oldbeli) {
                        $iconbeli   = '<i class="fa fa-arrow-down float-right text-white"></i>';
                        $ketbeli    = "Turun";
                        $persenbeli = (($newbeli - $oldbeli) / $oldbeli) * 100;
                    } else {
                        $iconbeli   = '<i class="fa fa-arrow-up float-right text-white"></i>';
                        $ketbeli    = "Naik";
                        $persenbeli = (($newbeli - $oldbeli) / $oldbeli) * 100;
                    }

                    //jual
                    if ($newjual < $oldjual) {
                        $iconjual   = '<i class="fa fa-arrow-down float-right text-white"></i>';
                        $ketjual    = "Turun";
                        $persenjual = (($newjual - $oldjual) / $oldjual) * 100;
                    } else {
                        $iconjual   = '<i class="fa fa-arrow-up float-right text-white"></i>';
                        $ketjual    = "Naik";
                        $persenjual = (($newjual - $oldjual) / $oldjual) * 100;
                    }
                    ?>
                    <div class="col-xs-4 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-box noradius noborder bg-default">
                            <?= $iconbeli; ?>
                            <h6 class="text-white text-uppercase m-b-20">Harga Beli</h6>
                            <h1 class="m-b-20 text-white counter"><?= number_format($newbeli, 0, ',', '.'); ?> /gr</h1>
                            <span class="text-white"><?= $ketbeli; ?> <?= round($persenbeli, 2); ?>%, update at <?= $newupdate; ?></span>
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-box noradius noborder bg-success">
                            <?= $iconjual ?>
                            <h6 class="text-white text-uppercase m-b-20">Harga Jual</h6>
                            <h1 class="m-b-20 text-white counter"><?= number_format($newjual, 0, ',', '.'); ?> /gr</h1>
                            <span class="text-white"><?= $ketjual; ?> <?= round($persenjual, 2); ?>%, update at <?= $newupdate; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4" style="margin-top:-20px;">
            <div class="col-xs-12 col-md-12 text-center">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-warning btn-lg">
                        <input type="radio" name="options" id="option1" autocomplete="off"><i class="fas fa-coins"></i> Emas Saya <br />
                        <?php
                        if (empty($saldo_emas['saldo'])) {
                            $emas = 0;
                        } else {
                            $emas = $saldo_emas['saldo'];
                        }
                        echo number_format($emas, 3, ',', '.');
                        ?> gr
                    </label>
                    <label class="btn btn-success btn-lg">
                        <input type="radio" name="options" id="option1" autocomplete="off"><i class="far fa-chart-bar"></i> Estimasi <br />
                        <?php
                        $nilai_invest = $emas * $newjual;
                        echo "Rp. " . number_format($nilai_invest, 0, ',', '.');
                        ?>
                    </label>
                    <label class="btn btn-secondary btn-lg">
                        <input type="radio" name="options" id="option2" autocomplete="off"><i class="fas fa-wallet"></i> Wallet <br />
                        <?php
                        if (empty($saldo_rp['saldo'])) {
                            echo "Rp. 0";
                        } else {
                            echo "Rp. " . number_format($saldo_rp['saldo'], 0, ',', '.');
                        }
                        ?>
                    </label>
                </div>
            </div>
        </div>

        <div class="row mb-4">
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
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>