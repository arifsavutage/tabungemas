<div class="row mb-2">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <a href="" class="btn btn-lg btn-primary mb-2">
            <span class="btn-label"><i class="fa fa-arrow-left"></i></span>Kembali
        </a>
        <div class="card border-primary">
            <div class="card-header">
                <h3>Data Lengkap</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td><?= $detail['idted'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><?= $detail['nama_lengkap'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card border-secondary">
            <div class="card-header">
                <h3>Data Referal</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ref. ID</th>
                                <th>Nama Anggota</th>
                                <th>Tgl. Gabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($referals as $row) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $i; ?></td>
                                    <td><?= $row['idted']; ?></td>
                                    <td><?= strtoupper(strtolower($row['nama_lengkap'])); ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_gabung'])); ?></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="card border-secondary">
            <div class="card-header">
                <h3>Bonus Reward</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-2">
                    Tabel hanya menyajikan poin yang belum di klaim
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Jumlah Anggota</th>
                                <th>Kedalaman Level</th>
                                <th>Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ceksisapoin = $this->db->get_where('tb_transbon_poin', ['idted' => $detail['idted']])->num_rows();
                            if ($ceksisapoin > 0) {
                                //ambil sisa poin terakhir
                                $poinakhir = $this->db->get_where('tb_transbon_poin', ['idted' => $detail['idted']])->row()->poin_stock;
                            } else {
                                $poinakhir = 0;
                            }

                            $ttlpoin = 0;
                            $i = 1;
                            foreach ($bonuspoin as $rowpoin) :
                                $level = $rowpoin['pos_level'] - $mylevel;
                            ?>
                                <tr>
                                    <td scope="row"><?= $rowpoin['jml_potensi']; ?></td>
                                    <td><?= $level ?></td>
                                    <td>
                                        <?php
                                        if ($level > 1) {
                                            $p = 1 * $rowpoin['jml_potensi'];
                                        } else {
                                            $p = 2 * $rowpoin['jml_potensi'];
                                        }
                                        echo number_format($p, 0, '.', ',');
                                        $ttlpoin += $p;
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;

                            $poin_update = $ttlpoin + $poinakhir;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Sisa Poin</th>
                                <th class="text-right"><?= number_format($poinakhir, 0, '.', ',') ?></th>
                            </tr>
                            <tr>
                                <th colspan="2">Poin Terkini</th>
                                <th class="text-right"><?= number_format($ttlpoin, 0, '.', ',') ?></th>
                            </tr>
                            <tr>
                                <th colspan="2">Total Poin</th>
                                <th class="text-right"><?= number_format($poin_update, 0, '.', ',') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="card border-secondary">
            <div class="card-header">
                <h3>Bonus Referal</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-2">
                    Tabel hanya menyajikan bonus referal yang belum di klaim
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Jumlah Anggota</th>
                                <th>Kedalaman Level</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ttlref = 0;
                            $i = 1;
                            foreach ($bonusreferal as $rowref) :
                                $level = $rowref['pos_level'] - $mylevel;
                            ?>
                                <tr>
                                    <td scope="row"><?= $rowref['jml_potensi']; ?></td>
                                    <td><?= $level ?></td>
                                    <td>
                                        <?php
                                        //get nominal bonus ref
                                        $nominal = $this->db->get_where('tb_bonus', array('id' => $level))->row()->referal;

                                        $p = $nominal * $rowref['jml_potensi'];
                                        echo number_format($p, 0, '.', ',');
                                        $ttlref += $p;
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Bonus</th>
                                <th class="text-right"><?= number_format($ttlref, 0, '.', ',') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>