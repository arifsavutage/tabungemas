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
                                        <a name="" id="" class="btn btn-danger" href="#" role="button">Batalkan Transaksi</a>
                        -->
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