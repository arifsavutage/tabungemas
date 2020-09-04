<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3><?= $judul_laporan; ?></h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="row mb-4">
                    <div class="col-md-4 datesearchbox"></div>
                </div>

                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Member Aktif" />
                    <table class="table table-bordered display" id="export">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Anggota</th>
                                <th>Nominal</th>
                                <th>Tgl. Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $daftar) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= ucwords(strtolower($daftar['nama_lengkap'])); ?></td>
                                    <td><?= number_format($daftar['nominal'], 0, '.', ','); ?></td>
                                    <td><?= date('d/m/Y', strtotime($daftar['tgl_transaksi'])); ?></td>
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