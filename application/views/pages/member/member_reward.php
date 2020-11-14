<div class="row mt-4">
    <div class="col">
        <?php
        if ($this->session->flashdata('info')) {
            echo $this->session->flashdata('info');
        }
        ?>
    </div>
</div>
<div class="row mt-4">
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6 px-2">
        <div class="card-box noradius noborder bg-success">

            <?php
            $ttlpoin = 0;
            $i = 1;
            foreach ($bonuspoin as $rowpoin) :
                $level = $rowpoin['pos_level'] - $mylevel;

                if ($level > 1) {
                    $p = 1 * $rowpoin['jml_potensi'];
                } else {
                    $p = 2 * $rowpoin['jml_potensi'];
                }
                //echo number_format($p, 0, '.', ',');
                $ttlpoin += $p;

                $i++;
            endforeach;

            $getpoin = $sisapoin + $ttlpoin
            ?>

            <h4 class="text-white text-uppercase m-b-20 mb-4">POIN REWARD</h4>

            <h6 class="text-white text-uppercase">POIN TERKINI <span class="float-right"><?= $ttlpoin ?></span></h6>
            <h6 class="text-white text-uppercase">SISA POIN <span class="float-right"><?= $sisapoin ?></span></h6>
            <h1 class="m-b-20 text-white text-right counter mt-5"><?= number_format($ttlpoin, 0, '.', ',') ?> Poin</h1>
            <p class="text-white">
                <span class="mr-2">Update Per Tanggal:</span>
                <span class="mr-2"><?= date('d/m/Y') ?> <i class="fa fa-calendar" style="font-size: 1rem !important;"></i></span>
                <span><i class="fa fa-info" style="font-size: 1rem !important;"></i> Jumlah Poin Terkini</span>
            </p>

            <?php
            if ($ttlpoin > 0) :
            ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#poinModal">
                    Daftar Hadiah
                </button>

                <!-- Modal -->
                <div class="modal fade" id="poinModal" tabindex="-1" aria-labelledby="poinModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="poinModalLabel">Daftar Hadiah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-unstyled">
                                    <?php
                                    foreach ($hadiahpoin as $gift) :
                                    ?>
                                        <li class="media mb-3">
                                            <img src="<?= base_url('assets/images/reward/') . $gift['gambar'] ?>" class="img-fluid img-thumbnail mr-4" alt="gambar <?= $gift['judul'] ?>" width="64" height="64">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-1"><?= $gift['judul'] ?> | <?= $gift['target_poin'] ?> Poin</h5>
                                                <?= $gift['keterangan'] ?>
                                                <br />
                                                <?php
                                                if ($ttlpoin >= $gift['target_poin']) {
                                                    echo '<a href="' . base_url('index.php/member/reward/tukar_poin/') . $ttlpoin . '/' . $gift['id'] . '" class="btn btn-sm btn-outline-info mt-2">Tukar Poin</a>';
                                                } else {
                                                    echo '<a haref="" class="btn btn-sm btn-secondary disabled mt-2" tabindex="-1" role="button" aria-disabled="true">Tukar Poin</a>';
                                                }
                                                ?>

                                            </div>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <div class="alert alert-warning" role="alert">
                                    <strong>Peringatan !</strong>, Sisa poin yang di tukar tidak terakumulasi, silahkan pilih hadiah terbaik Anda.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php
            endif;
            ?>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6 px-2" style="min-height: 800px;">

        <div class="card-box noradius noborder bg-info">

            <?php
            $ttlref = 0;
            $i = 1;
            foreach ($bonusreferal as $rowref) :
                $level = $rowref['pos_level'] - $mylevel;

                //get nominal bonus ref
                $nominal = $this->db->get_where('tb_bonus', array('id' => $level))->row()->referal;

                $p = $nominal * $rowref['jml_potensi'];
                //echo number_format($p, 0, '.', ',');
                $ttlref += $p;

                $i++;
            endforeach;
            ?>

            <h4 class="text-white text-uppercase m-b-20 mb-4">REFERAL REWARD</h4>

            <h6 class="text-white text-uppercase">&nbsp; <span class="float-right">&nbsp;</span></h6>
            <h6 class="text-white text-uppercase">&nbsp; <span class="float-right">&nbsp;</span></h6>

            <h1 class="m-b-20 text-white text-right counter mt-5">Rp. <?= number_format($ttlref, 0, '.', ',') ?></h1>
            <p class="text-white">
                <span class="mr-2">Update Per Tanggal:</span>
                <span class="mr-2"><?= date('d/m/Y') ?> <i class="fa fa-calendar" style="font-size: 1rem !important;"></i></span>
                <span><i class="fa fa-info" style="font-size: 1rem !important;"></i> Jumlah Bonus Terkini</span>
            </p>
            <?php
            if ($ttlref > 0) :
            ?>
                <a href="<?= base_url('index.php/member/reward/widraw/') . $ttlref; ?>" class="btn btn-sm btn-light">Tambahkan Ke Wallet</a>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>