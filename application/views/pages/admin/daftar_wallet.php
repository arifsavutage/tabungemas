<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3><?= $judul_laporan ?></h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="table-responsive">
                    <input type="hidden" name="judul-berkas" id="judul-berkas" value="Daftar Member Aktif" />
                    <table class="table table-bordered display" id="export">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Saldo Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $detail) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= $detail['idted']; ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('idted', $detail['idted']);
                                        $nama_lengkap = $this->db->get('tb_agt_ted')->row()->nama_lengkap;
                                        echo strtoupper(strtolower($nama_lengkap));
                                        ?>
                                    </td>
                                    <td><?= number_format($detail['newsaldo'], 0, ',', '.'); ?></td>

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