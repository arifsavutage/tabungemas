<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Laporan Profit Titipan Emas</h3>
            </div>
            <div class="card-body">
                <div class="card mb-3">
                    <div class="card-body">
                        <form name="cekwidraw" method="post" action="">
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <label class="sr-only" for="tgl1">Tgl Awal</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control" name="tgl1" id="tgl1" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label class="form-check-label">
                                        s/d
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="sr-only" for="tgl2">Tgl Akhir</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control" name="tgl2" id="tgl2" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-warning mb-2">Cek</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_POST)) :
                ?>
                    <div class="table-responsive">
                        <table class="table" id="export">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID</th>
                                    <th>Nama Anggota</th>
                                    <th>Tgl. Ikut</th>
                                    <th>Tgl. Berakhir</th>
                                    <th>Tenor</th>
                                    <th>Jml. Gr</th>
                                    <!--<th>Harga</th>-->
                                    <th>Profit %</th>
                                    <th>Profit Gr</th>
                                    <!--<th>Profit Rp</th>-->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($reports as $report) {

                                    $profitgr   = ($report['jmlprofit'] / 100) * $report['gram'];
                                    //$profitgr   = round(($report['jmlprofit'] / 100) * $report['gram'], 2);
                                    $profitcuan = $profitgr * $report['harga_ikut'];
                                    echo "
                                <tr>
                                    <td>$i</td>
                                    <td>$report[idted]</td>
                                    <td>$report[nama_lengkap]</td>
                                    <td>$report[tgl_ikut]</td>
                                    <td>$report[tgl_berakhir]</td>
                                    <td>$report[tenor]</td>
                                    <td>$report[gram]</td>
                                    <!--<td>" . number_format($report['harga_ikut'], 0, '.', ',') . "</td>-->
                                    <td>" . number_format($report['jmlprofit'], 3, '.', ',') . "</td>
                                    <td>$profitgr gr</td>
                                    <!--<td>" . number_format($profitcuan, 0, '.', ',') . "</td>-->
                                    <td>$report[status]</td>
                                </tr>
                                ";

                                    $i++;
                                }
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

<style>
    .parsley-error {
        border-color: #ff5d48 !important;
    }

    .parsley-errors-list.filled {
        display: block;
    }

    .parsley-errors-list {
        display: none;
        margin: 0;
        padding: 0;
    }

    .parsley-errors-list>li {
        font-size: 12px;
        list-style: none;
        color: #ff5d48;
        margin-top: 5px;
    }

    .form-section {
        padding-left: 15px;
        border-left: 2px solid #FF851B;
        display: none;
    }

    .form-section.current {
        display: inherit;
    }
</style>