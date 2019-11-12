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
                    $newbeli    = implode("", $xnewbeli) - $selisih['selisih_hrg_emas'];
                    $newjual    = implode("", $xnewjual) - $selisih['selisih_hrg_emas'];
                    $newupdate  = date('d M Y', strtotime($new[0]['UPDATE_AT']));

                    $xoldbeli   = explode(",", $old[0]['HRG_BELI']);
                    $xoldjual   = explode(",", $old[0]['HRG_JUAL']);
                    $oldbeli    = implode("", $xoldbeli) - $selisih['selisih_hrg_emas'];
                    $oldjual    = implode("", $xoldjual) - $selisih['selisih_hrg_emas'];
                    $oldupdate  = date('d M Y', strtotime($old[0]['UPDATE_AT']));

                    //beli
                    if ($newbeli < $oldbeli) {
                        $iconbeli   = '<i class="fa fa-arrow-down float-right text-white"></i>';
                        $ketbeli    = "Turun";
                        $persenbeli = ($oldbeli - $newbeli) / $newbeli;
                    } else {
                        $iconbeli   = '<i class="fa fa-arrow-up float-right text-white"></i>';
                        $ketbeli    = "Naik";
                        $persenbeli = ($newbeli - $oldbeli) / $oldbeli;
                    }

                    //jual
                    if ($newjual < $oldjual) {
                        $iconjual   = '<i class="fa fa-arrow-down float-right text-white"></i>';
                        $ketjual    = "Turun";
                        $persenjual = ($oldjual - $newjual) / $newjual;
                    } else {
                        $iconjual   = '<i class="fa fa-arrow-up float-right text-white"></i>';
                        $ketjual    = "Naik";
                        $persenjual = ($newjual - $oldjual) / $oldjual;
                    }
                    ?>
                    <div class="col-xs-4 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-box noradius noborder bg-default">
                            <?= $iconbeli; ?>
                            <h6 class="text-white text-uppercase m-b-20">Harga Beli</h6>
                            <h1 class="m-b-20 text-white counter"><?= number_format($newbeli, 0, ',', '.'); ?> /gr</h1>
                            <span class="text-white"><?= $ketbeli; ?> <?= round($persenbeli, 3); ?>% update at <?= $newupdate; ?></span>
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-6 col-lg-6 col-xl-6">
                        <div class="card-box noradius noborder bg-success">
                            <?= $iconjual ?>
                            <h6 class="text-white text-uppercase m-b-20">Harga Jual</h6>
                            <h1 class="m-b-20 text-white counter"><?= number_format($newjual, 0, ',', '.'); ?> /gr</h1>
                            <span class="text-white"><?= $ketjual; ?> <?= round($persenjual, 3); ?>% update at <?= $newupdate; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4" style="margin-top:-20px;">
            <div class="col-xs-12 col-md-12 text-center">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-warning btn-lg">
                        <input type="radio" name="options" id="option1" autocomplete="off"> Emas Saya <br />
                        <?php
                        if (empty($saldo_emas['saldo'])) {
                            echo "0";
                        } else {
                            echo number_format($saldo_emas['saldo'], 3, ',', '.');
                        }
                        ?> gr
                    </label>
                    <label class="btn btn-secondary btn-lg">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Saldo Saya <br />
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