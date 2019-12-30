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
                        foreach ($jual_id as $rowid) :
                        ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">Hi,</h4>
                                        <p>Kami informasikan bahwa <strong><?= ucwords($rowid['nama_lengkap']); ?></strong> mengajukan penjualan emas seberat <strong><?= $rowid['nominal_gram'] ?> gr</strong> dengan harga <strong>Rp. <?= number_format($rowid['nominal_uang'], 0, ',', '.'); ?> /gr</strong> kepada Anda.</p>
                                        <p>Silahkan lakukan pembayaran jika Anda menghendaki transaksi ini.</p>
                                        <hr>
                                        <p class="mb-0">Catatan :<br />Pihak <strong>Tabung Emas Digital (TED)</strong> tidak bertanggungjawab atas transaksi yang dilakukan di luar sistem kami.</p>

                                        <!--<br />
                                        <a name="" id="" class="btn btn-warning" href="#" role="button">Bayar</a>
                                        <a name="" id="" class="btn btn-danger" href="#" role="button">Batalkan Transaksi</a>-->

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Pilih Cara Bayar</h4>
                                            <form name="beliemas" method="post" action="">

                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="metode" id="metode1" value="wallet" checked>
                                                            <label class="form-check-label" for="metode1">Dari Wallet</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="metode" id="metode2" value="transfer">
                                                            <label class="form-check-label" for="metode">Transfer Bank</label>
                                                        </div>
                                                        <?= form_error('metode', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="saldowallet">Saldo Wallet</label>
                                                        <input type="text" class="form-control" name="saldowallet" id="saldowallet" value="<?= $saldo_rp['saldo']; ?>">
                                                        <?= form_error('saldowallet', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="bank">Daftar Bank</label>
                                                        <select name="bank" id="bank" class="form-control">
                                                            <option value="">: Pilih</option>
                                                            <?php
                                                            foreach ($banks as $transfer) :
                                                            ?>
                                                                <option value="<?= $transfer['id']; ?>"><?= $transfer['nm_bank']; ?></option>
                                                            <?php
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                        <?= form_error('bank', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Bayar</button>
                                                <br />
                                                <a name="" id="" class="btn btn-warning btn-lg btn-block" href="#" role="button">Batalkan Transasksi</a>

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

        <div class="row">
            <div class="col text-center">
                <a href="<?= base_url(); ?>index.php/transaksi/beli_emas/<?= $this->session->userdata('id'); ?>">
                    <img src="<?= base_url(); ?>assets/images/menu-beli.png" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="">
                    <p>Beli Emas</p>
                </a>
            </div>
            <div class="col text-center">
                <a href="<?= base_url(); ?>index.php/transaksi/jual_emas/<?= $this->session->userdata('id'); ?>">
                    <img src="<?= base_url(); ?>assets/images/menu-jual.png" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="">
                    <p>Jual Emas</p>
                </a>
            </div>
            <div class="col text-center">
                <a href="">
                    <img src="<?= base_url(); ?>assets/images/menu-tarik-saldo.png" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="">
                    <p>Tarik Saldo</p>
                </a>
            </div>
            <div class="col text-center">
                <a href="">
                    <img src="<?= base_url(); ?>assets/images/menu-tarik-barang.png" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="">
                    <p>Tarik Barang</p>
                </a>
            </div>
        </div>

    </div>
</div>