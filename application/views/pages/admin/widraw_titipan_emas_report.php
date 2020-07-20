<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Transfer Profit Titipan Emas</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>

                <br />
                <br />
                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Titipan Emas">
                    <table class="table" id="export">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Nama Anggota</th>
                                <th>Periode</th>
                                <th>Tgl. Trf</th>
                                <th>Bank</th>
                                <th>No. rek</th>
                                <th>An</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) :
                                if ($row['is_transfer'] == 0) {
                                    $status = "<span class='badge badge-danger'>pending</span>";
                                } else {
                                    $status = "<span class='badge badge-success'>paid</span>";
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><a href="<?= base_url() . 'index.php/member/profil_anggota/' . $row['idted']; ?>"><?= $row['idted']; ?></a></td>
                                    <td><?= ucwords($row['nama_lengkap']); ?></td>
                                    <td><?= $row['periode']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['tgl_trf'])); ?></td>
                                    <td><?= strtoupper($row['bank']); ?></td>
                                    <td><?= $row['norek']; ?></td>
                                    <td><?= ucwords($row['an']); ?></td>
                                    <td><?= number_format($row['nominal'], 0, ',', '.'); ?></td>
                                    <td><?= $status; ?></td>
                                    <td></td>
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