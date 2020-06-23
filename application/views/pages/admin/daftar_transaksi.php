<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Transaksi Deposit</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="table-responsive">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Transaksi</th>
                                <th>Jenis</th>
                                <th>Anggota</th>
                                <th>Uraian</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($datas as $detail) :
                                $anggota = $this->model_tedagt->getAccountById($detail['idted']);
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('d/m/Y', strtotime($detail['tgl'])); ?></td>
                                    <td>Transaksi <?= ucwords($detail['jenis']); ?></td>
                                    <td><a href="<?= base_url() . 'index.php/member/profil_anggota/' . $detail['idted']; ?>"><?= ucwords($anggota['nama_lengkap']); ?></a></td>
                                    <td><?= $detail['uraian']; ?></td>
                                    <td><?= $detail['masuk']; ?></td>
                                    <td><?= $detail['keluar']; ?></td>
                                    <td><?= $detail['saldo']; ?></td>
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