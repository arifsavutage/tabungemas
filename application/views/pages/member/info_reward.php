<div class="row mt-4">
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6 px-2">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">Reward Refferal</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Nominal Reward</th>
                                <th>Simulasi Closing</th>
                                <th>Simulasi Potensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lvl = 1;
                            $sim = 10;
                            foreach ($reward as $referal) :
                            ?>
                                <tr>
                                    <td><?= $lvl; ?></td>
                                    <td><?= number_format($referal['referal'], 0, '.', ','); ?></td>
                                    <td><?= number_format($sim, 0, '.', ','); ?></td>
                                    <td><?php
                                        $hasil =  $sim * $referal['referal'];
                                        echo number_format($hasil, 0, '.', ','); ?></td>
                                </tr>
                            <?php
                                $lvl++;
                                $sim *= 10;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <h6>Note :</h6>
                <p><strong>Level 1</strong> adalah jaringan dibawah Anda, yang langsung mendaftar menggunakan link refferal.</p>
                <p><strong>Level 2 - dst, </strong> adalah hasil pengembangan dari orang yang Anda ajak.</p>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6 px-2 mt-2">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">Reward Royalti</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tingkat</th>
                                <th>Target</th>
                                <th>Nominal Reward</th>
                                <th>Simulasi &Sigma; Qualified</th>
                                <th>&Sigma; Pendaftar Baru / Bln</th>
                                <th>Simulasi Potensi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $peringkat = ['Sales', 'Supervisor', 'Manager'];
                            $i = 0;
                            $lvl = 1;
                            $sim_qualified = [50, 25, 5];
                            $sim_mem_baru = 650;

                            foreach ($reward as $royalty) :
                                if ($lvl <= 3) :
                            ?>
                                    <tr>
                                        <td><?= $peringkat[$i]; ?></td>
                                        <td><?= $royalty['royalti_target'] ?></td>
                                        <td><?= number_format($royalty['royalti'], 0, '.', ',') ?></td>
                                        <td><?= $sim_qualified[$i]; ?></td>
                                        <td><?= $sim_mem_baru; ?></td>
                                        <td>
                                            <?php
                                            $hasil = ($sim_mem_baru * $royalty['royalti']) / $sim_qualified[$i];
                                            echo number_format($hasil, 0, '.', ',');
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                endif;

                                $lvl++;
                                $sim_mem_baru *= 1;
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <p>* Kenaikan target reward royalti tiap tingkat dimulai dari nol.</p>
                <p>* Target reward royalti tidak ada batas waktu.</p>
                <img class="img-fluid mt-2" src="<?= base_url(); ?>assets/images/rumus-royalti.jpg" />
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6 px-2 mt-2">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">Reward Poin</h4>
                <p>
                    Reward poin adalah reward yang didapatkan ketika Anda atau anggota dibawah Anda mengajak / mendaftarkan anggota baru dari link refferalnya.
                    Jumlah poin yang di dapat adalah dengan ketentuan sebagai berikut :
                </p>
                <ol>
                    <li>Anda berhak mendapatkan <strong>2 Poin</strong> ketika pendaftaran anggota baru secara langsung dari link refferal Anda</li>
                    <li>Anda berhak mendapatkan <strong>1 Poin</strong> ketika pendaftaran anggota baru mendaftar dari link refferal anggota<sup>*</sup> dibawah Anda</li>
                    <li>Poin yang terkumpul dapat Anda tukar dengan hadiah menarik di akhir periode tiap tahunnya <sup>**</sup></li>
                </ol>

                <small><sup>*</sup> Anggota yang di makasud adalah anggota dari jaringan pribadi Anda</small><br>
                <small><sup>**</sup> Poin yang ditukar akan di undi di akhir tahun</small>

                <div class="alert alert-secondary mt-4" role="alert">
                    <h class="display-4">Kumpulkan poinya sekarang jugaa...</h3>
                </div>
            </div>
        </div>
    </div>
</div>