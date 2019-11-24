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
                                                                    <img src="<?= base_url(); ?>assets/images/avatars/cesar-rincon.jpg" class="img-fluid img-thumbnail rounded-circle" alt="member profile">
                                                                    <br />
                                                                    <br />
                                                                    <h4 class="card-title" style="font-family: 'Pacifico', cursive;color:dimgray;"><?= $detail['nama_lengkap']; ?></h4>
                                                                    <br />
                                                                    <div class="text-center">
                                                                        <h6><span class="badge badge-info">Basic Member</span></h6>
                                                                    </div>
                                                                    <hr>
                                                                    <div style="font-size: 18px;color:darkgrey;">
                                                                        Saldo <span class="badge badge-primary">3500 K</span> | Emas <span class="badge badge-warning">4,66 gr</span>
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
                                        <a role="button" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addToJar<?= $no; ?>" title="Tambah ke jaringan">
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
                                                                        <label for="email">E-mail</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="<?= $detail['email_tmp']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nohp">No. Handphone</label>
                                                                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $detail['nohp_tmp'] ?>">
                                                                        <input type="hidden" name="password" value="<?= $detail['password_tmp']; ?>" />
                                                                        <input type="hidden" name="idtmp" value="<?= $detail['idtmp']; ?>" />
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