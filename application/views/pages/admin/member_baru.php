<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Member Baru</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="table-responsive">
                    <table class="table" id="examples">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Daftar</th>
                                <th>Nama Lengkap</th>
                                <th>KTP</th>
                                <th>Paket</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>ID Referal</th>
                                <th>Nom. Trf</th>
                                <th>Status Trf.</th>
                                <th><i class="fas fa-sitemap"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $detail) :

                                if ($detail['konfirm_status'] == 0) {
                                    $label = "<span class='badge badge-warning'>belum</span>";
                                } else {
                                    $label = "<span class='badge badge-success'>sudah</span>";
                                }
                            ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= date('Y-m-d', strtotime($detail['tgl_daftar'])); ?></td>
                                    <td><?= ucwords($detail['nm_tmp']); ?></td>
                                    <td><?= $detail['ktp_tmp']; ?></td>
                                    <td><?= '<span class="badge badge-secondary">' . ucwords($detail['nama_paket']) . '</span>' ?></td>
                                    <td><?= $detail['nohp_tmp']; ?></td>
                                    <td><?= $detail['email_tmp']; ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a role="button" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<?= $no; ?>" title="View Profil">
                                            <?= $detail['idreferal']; ?>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $no; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?= $no; ?>">Profil referal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="text-center">
                                                                    <img src="<?= base_url(); ?>assets/images/avatars/<?= $detail['foto_profil']; ?>" width="200px" class="img-fluid img-thumbnail" alt="member profile">
                                                                    <br />
                                                                    <br />
                                                                    <h4 class="card-title" style="font-family: 'Pacifico', cursive;color:dimgray;"><?= $detail['nama_lengkap']; ?></h4>
                                                                    <br />
                                                                    <div class="text-center">
                                                                        <?php
                                                                        $this->db->join('tb_agt_ted', 'tb_agt_ted.role_id = tb_user_role.id', 'left');
                                                                        $mem_ship = $this->db->get_where('tb_user_role', ['id' => $detail['roleref']])->row_array();
                                                                        ?>
                                                                        <h6><span class="badge badge-info"><?= ucwords($mem_ship['role_name']) ?></span></h6>
                                                                    </div>
                                                                    <hr>
                                                                    <div style="font-size: 18px;color:darkgrey;">
                                                                        <?php
                                                                        $saldo_rp   = $this->model_transaksi->getLastTranById($detail['idted'], 'uang');
                                                                        $saldo_emas = $this->model_transaksi->getLastTranById($detail['idted'], 'emas');

                                                                        //uang
                                                                        if (empty($saldo_rp['saldo'])) {
                                                                            $uang = 0;
                                                                        } else {
                                                                            $uang   = $saldo_rp['saldo'] / 1000;
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        //emas
                                                                        if (empty($saldo_emas['saldo'])) {
                                                                            $emas = 0;
                                                                        } else {
                                                                            $emas = number_format($saldo_emas['saldo'], 3, ',', '.');
                                                                        }
                                                                        ?>
                                                                        Saldo <span class="badge badge-primary"><?= number_format($uang, 2, ',', '.'); ?> K</span> | Emas <span class="badge badge-warning"><?= $emas; ?> gr</span>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-group mt-4">
                                                                    <li class="list-group-item disabled">
                                                                        Referal Link : <br />
                                                                        <?= base_url() . "index.php/referal/id/" . $detail['idted']; ?>
                                                                    </li>
                                                                </ul>
                                                                <ul class="list-group mt-4">
                                                                    <li class="list-group-item disabled"><?= $detail['email']; ?></li>
                                                                    <li class="list-group-item disabled"><?= $detail['nohp']; ?></li>
                                                                    <li class="list-group-item disabled">
                                                                        <p><?= $detail['alamat']; ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= "Rp. " . number_format($detail['nominal'], 0, ',', '.'); ?></td>
                                    <td><?= $label; ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a role="button" href="#" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#addToJar<?= $no; ?>" title="Tambah ke jaringan">
                                            <i class="fas fa-user-check"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addToJar<?= $no; ?>" tabindex="-1" role="dialog" aria-labelledby="addToJarLabel<?= $no; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form name="tambahjaringan" method="post" action="<?= base_url() . "index.php/register/add_to_jaringan/"; ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addToJarLabel<?= $no; ?>">Tambah Ke Jaringan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="refid">ID Referal</label>
                                                                        <input type="text" class="form-control" name="refid" id="refid" value="<?= $detail['idreferal']; ?>" readonly="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama Lengkap</label>
                                                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $detail['nm_tmp']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="noktp">No. KTP</label>
                                                                        <input type="text" class="form-control" name="noktp" id="noktp" value="<?= $detail['ktp_tmp']; ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">E-mail</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="<?= $detail['email_tmp']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nohp">No. Handphone</label>
                                                                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $detail['nohp_tmp'] ?>">
                                                                        <input type="hidden" name="password" value="<?= $detail['password_tmp']; ?>" />
                                                                        <input type="hidden" name="idtmp" value="<?= $detail['idtmp']; ?>" />
                                                                        <input type="hidden" name="role" value="<?= $detail['role_id']; ?>" />
                                                                        <input type="hidden" name="jenis" value="<?= $detail['jenis']; ?>" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Tambah Sekarang</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <a href="<?= base_url() . "index.php/member/delRegistration/$detail[idtmp]"; ?>" class="btn btn-danger btn-sm" role="button" onclick="return valdel()"><i class="fas fa-user-times"></i></a>
                                        <script>
                                            function valdel() {
                                                var conf = confirm("Apakah yakin data akan dihapus?");

                                                if (conf == true) {
                                                    return true;
                                                } else {
                                                    return false;
                                                }
                                            }
                                        </script>
                                    </td>
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