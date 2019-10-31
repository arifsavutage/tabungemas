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
                    <img src="<?= base_url() . "assets/images/avatars/" . $detail['foto_profil']; ?>" class="img-fluid img-thumbnail rounded-circle" alt="member profile">
                    <br />
                    <br />
                    <h4 class="card-title" style="font-family: 'Pacifico', cursive;color:dimgray;"><?= $detail['nama_lengkap']; ?>
                        <a href="<?= base_url(); ?>index.php/member/edit_profile/<?= $this->session->userdata('id'); ?>" style="color:darkgrey;"><i class="fas fa-user-edit float-right"></i></a>
                    </h4>
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
                    <li class="list-group-item disabled"><i class="far fa-envelope"></i> <?= $detail['email']; ?></li>
                    <li class="list-group-item disabled"><i class="fas fa-mobile-alt"></i> <?= $detail['nohp']; ?></li>
                    <li class="list-group-item disabled">
                        <i class="fas fa-map-marker"></i> <?= $detail['alamat']; ?>
                    </li>
                </ul>
                <a href="" class="btn btn-danger btn-block btn-lg mt-4">Upgrade to premium</a>
            </div>
        </div>
    </div>
</div>