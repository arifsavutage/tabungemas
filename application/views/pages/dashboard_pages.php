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