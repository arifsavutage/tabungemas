<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Saldo Emas</h3>
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
                    <table class="table" id="daterange">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Update</th>
                                <th>ID</th>
                                <th>Nama Anggota</th>
                                <th>Saldo Emas (gr)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $this->db->select('idted, nama_lengkap');
                            $anggota = $this->db->get('tb_agt_ted')->result_array();

                            $no = 1;
                            foreach ($anggota as $agt) :
                                $this->db->select('saldo, tgl');
                                $this->db->order_by('id', 'DESC');
                                $saldo = $this->db->get_where('tb_transaksi', array('idted' => $agt['idted'], 'jenis' => 'emas'))->result_array();

                                if (count($saldo) > 0) {
                                    $sld = $saldo[0]['saldo'];
                                    $tgls = date('d/m/Y', strtotime($saldo[0]['tgl']));
                                } else {
                                    $sld = '0';
                                    $tgls = date('d/m/Y');
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= $tgls; ?></td>
                                    <td><a href="<?= base_url() . '' . $agt['idted']; ?>"><?= ucwords($agt['idted']); ?></a></td>
                                    <td><?= ucwords(strtolower($agt['nama_lengkap'])); ?></td>
                                    <td><?= $sld; ?></td>
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