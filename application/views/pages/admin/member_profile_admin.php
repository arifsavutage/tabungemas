<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <div class="text-center">
                    <img src="<?= base_url() . "assets/images/avatars/" . $detail['foto_profil']; ?>" width="200px" class="img-fluid img-thumbnail rounded-circle" alt="member profile">
                    <br />
                    <br />
                    <h4 class="card-title" style="font-family: 'Pacifico', cursive;color:dimgray;"><?= $detail['nama_lengkap']; ?>
                        <a href="" title="edit profil anggota" style="color:darkgrey;"></a>
                        <a href="" title="edit foto anggota" style="color:darkgrey;"></a>
                    </h4>
                    <br />
                    <div class="text-center">
                        <?php
                        $this->db->select('tb_user_role.role_name as memship, tb_user_role.id');
                        $this->db->join('tb_agt_ted', 'tb_agt_ted.role_id = tb_user_role.id', 'right');
                        $mem_ship = $this->db->get_where('tb_user_role', ['id' => $detail['role_id']])->row_array();

                        if ($mem_ship['id'] == 3) {
                            //echo '<span class="badge badge-danger">' . ucwords($mem_ship_tmp['memship']) . '</span>';
                            //echo $detail['role_id'];
                            $keanggotaan    = ucwords($mem_ship['memship']);
                            $class          = "badge-info";
                            $upgrade        = '<a href="' . base_url('index.php/member/upgrade/') . $this->session->userdata('id') . '" class="btn btn-danger btn-block btn-lg mt-4">Upgrade to premium</a>';
                        } else if ($mem_ship['id'] == 4) {
                            //echo '<span class="badge badge-success">' . ucwords($mem_ship_tmp['memship']) . '</span>';
                            //echo $detail['role_id'];
                            $keanggotaan    = ucwords($mem_ship['memship']);
                            $class          = "badge-danger";
                            $upgrade        = "";
                        }


                        ?>
                        <h6><span class="badge <?= $class; ?>"><?= $keanggotaan; ?></span></h6>
                        <a role="button" href="<?= base_url(); ?>index.php/member/edit_profil_anggota/<?= $detail['idted']; ?>" class="btn btn-primary"><span class="btn-label"><i class="fas fa-user-edit"></i></span>Edit Profil</a>
                        <a role="button" href="<?= base_url(); ?>index.php/member/edit_photo_anggota/<?= $detail['idted']; ?>" class="btn btn-warning"><span class="btn-label"><i class="far fa-file-image"></i></span>Edit Foto</a>
                    </div>
                    <hr>
                    <div style="font-size: 18px;color:darkgrey;">
                        <?php
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
                    <li class="list-group-item disabled"><i class="fa fa-id-card-o"></i> <?= $detail['noktp']; ?></li>
                    <li class="list-group-item disabled"><i class="far fa-envelope"></i> <?= $detail['email']; ?></li>
                    <li class="list-group-item disabled"><i class="fas fa-mobile-alt"></i> <?= $detail['nohp']; ?></li>
                    <li class="list-group-item disabled">
                        <i class="fas fa-map-marker"></i> <?= $detail['alamat']; ?>
                    </li>
                    <li class="list-group-item disabled"><i class="fas fa-university"></i> <?= $detail['norek'] . " | " . $detail['bank'] . " | an. " . $detail['an']; ?></li>
                    <li class="list-group-item disabled">
                        <i class="fas fa-hand-holding-heart"></i> <?= $detail['ktpwaris'] . " | " . ucwords($detail['nmwaris']) . " | " . ucwords($detail['hubwaris']) . " | " . $detail['hpwaris']; ?>
                    </li>
                </ul>
                <?= $upgrade; ?>
            </div>
        </div>
    </div>
</div>