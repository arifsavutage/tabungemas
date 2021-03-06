<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Transaksi Penjualan Emas</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="row">
                    <div class="row mb-4">
                        <div class="col-md-12 datesearchbox"></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="daterange">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Jual</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Nom. Uang</th>
                                <th>Nom. Gram</th>
                                <th>Ket.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($datas as $detail) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('d/m/Y', strtotime($detail['tgl'])); ?></td>
                                    <td><?= ucwords(strtolower($detail['nama_lengkap'])); ?></td>
                                    <td><?= $detail['nohp']; ?></td>
                                    <td><?= "Rp. " . number_format($detail['nominal_uang'], 0, '.', ','); ?></td>
                                    <td><?= $detail['nominal_gram'] . " gr"; ?></td>
                                    <td><?= $detail['ket']; ?></td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>