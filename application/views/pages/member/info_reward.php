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
                            $sim = 5;
                            foreach ($reward as $referal) :
                            ?>
                                <tr>
                                    <td><?= $lvl; ?></td>
                                    <td><?= number_format($referal['referal'], 0, '.', ','); ?></td>
                                    <td><?= $sim; ?></td>
                                    <td><?php
                                        $hasil =  $sim * $referal['referal'];
                                        echo number_format($hasil, 0, '.', ','); ?></td>
                                </tr>
                            <?php
                                $lvl++;
                                $sim *= 5;
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
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6 px-2">
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
                            $sim_qualified = 10;
                            $sim_mem_baru = 106;

                            foreach ($reward as $royalty) :
                                if ($lvl <= 3) :
                            ?>
                                    <tr>
                                        <td><?= $peringkat[$i]; ?></td>
                                        <td><?= $royalty['royalti_target'] ?></td>
                                        <td><?= number_format($royalty['royalti'], 0, '.', ',') ?></td>
                                        <td><?= $sim_qualified; ?></td>
                                        <td><?= $sim_mem_baru; ?></td>
                                        <td>
                                            <?php
                                            $hasil = ($sim_mem_baru * $royalty['royalti']) / $sim_qualified;
                                            echo number_format($hasil, 0, '.', ',');
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                endif;

                                $lvl++;
                                $sim_qualified -= (3 + $i);
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
</div>