<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Detail Daftar Transfer Profit Titipan Emas</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }

                $per    = str_replace("_", " ", $this->uri->segment(3));
                ?>
                <a href="<?= base_url('index.php/transaksi/titipan_emas_widraw_report'); ?>" class="btn btn-primary">Kembali</a>
                <br />
                <br />

                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Profit Titipan Emas Periode <?= $per ?>">
                    <table class="table" id="exportl">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Nama Anggota</th>
                                <th>Tgl. Proses</th>
                                <th>Total Profit</th>
                                <th>Ket.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;

                            foreach ($data as $row) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><a href="<?= base_url() . 'index.php/member/profil_anggota/' . $row['idted']; ?>"><?= $row['idted']; ?></a></td>
                                    <td><?= ucwords($row['nama_lengkap']); ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl'])); ?></td>

                                    <td><?= $row['masuk'] . ' gr'; ?></td>

                                    <td><?= $row['uraian']; ?></td>
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