<!-- Left Sidebar -->
<div class="left main-sidebar">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">

            <ul>

                <li class="submenu">
                    <a href="<?= base_url(); ?>"><i class="fa fa-fw fa-home"></i><span> Dashboard </span> </a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-user"></i> <span> Akun Saya </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url(); ?>index.php/member/profile/<?= $this->session->userdata('id'); ?>">Profile</a></li>
                        <li><a href="<?= base_url(); ?>index.php/member/photo_profile/<?= $this->session->userdata('id'); ?>">Upload Foto</a></li>

                        <li class="submenu">
                            <a href="#"><span>Berkas</span> <span class="menu-arrow"></span> </a>
                            <ul style="">
                                <li><a href="<?= base_url(); ?>index.php/member/berkas_ktp/<?= $this->session->userdata('id'); ?>"><span>Upload KTP</span></a></li>
                                <li><a href="<?= base_url(); ?>index.php/member/berkas_npwp/<?= $this->session->userdata('id'); ?>"><span>Upload NPWP</span></a></li>
                            </ul>
                        </li>

                        <li><a href="<?= base_url(); ?>index.php/member/update_pass/<?= $this->session->userdata('id'); ?>">Ubah Password</a></li>
                        <li><a href="<?= base_url(); ?>index.php/member/pohon_jaringan/<?= $this->session->userdata('id'); ?>">Anggota Referal</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-retweet"></i> <span> Transaksi </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url(); ?>index.php/transaksi/beli_emas/<?= $this->session->userdata('id'); ?>">Beli Emas</a></li>
                        <li><a href="<?= base_url(); ?>index.php/transaksi/jual_emas/<?= $this->session->userdata('id'); ?>">Jual Emas</a></li>

                        <li><a href="<?= base_url(); ?>index.php/transaksi/tarik_fisik_emas/<?= $this->session->userdata('id'); ?>">Tarik Fisik</a></li>
                        <li><a href="<?= base_url(); ?>index.php/transaksi/transfer/<?= $this->session->userdata('id'); ?>">Transfer Emas</a></li>
                        <li><a href="<?= base_url(); ?>index.php/transaksi/widraw/<?= $this->session->userdata('id'); ?>">Tarik Saldo Wallet</a></li>

                        <li><a href="<?= base_url(); ?>index.php/transaksi/history/<?= $this->session->userdata('id'); ?>">Histori Transaksi</a></li>

                    </ul>
                </li>

                <?php
                if ($this->session->userdata('role') == 'super') :
                    ?>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-users"></i> <span> Super Admin </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">

                            <li class="submenu">
                                <a href="#" class="subdrop"><span>Keanggotaan</span> <span class="menu-arrow"></span> </a>
                                <ul style="display: block;">
                                    <li><a href="<?= base_url() . 'index.php/member/member_baru'; ?>">Anggota Baru</a></li>
                                    <li><a href="<?= base_url() . 'index.php/member/member_list'; ?>"><span>Anggota Aktif</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#" class="subdrop"><span>Transaksi</span> <span class="menu-arrow"></span> </a>
                                <ul style="display: block;">
                                    <li><a href="<?= base_url() . 'index.php/transaksi/daftar_beli_emas'; ?>">Daftar Beli Emas</a></li>
                                    <li><a href="<?= base_url() . 'index.php/transaksi/daftar_jual_emas'; ?>"><span>Daftar Jual Emas</span></a></li>
                                    <li><a href="<?= base_url() . 'index.php/transaksi/daftar_tarik_fisik'; ?>"><span>Daftar Tarik Fisik</span></a></li>
                                    <li><a href="#"><span>Laporan Transaksi</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#" class="subdrop"><span>Cabang</span> <span class="menu-arrow"></span> </a>
                                <ul style="display: block;">
                                    <li><a href="#"><span>Daftar Cabang</span></a></li>
                                    <li><a href="#"><span>Laporan Cabang</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php
                endif;
                ?>

                <!--
                <li class="submenu">
                    <a href="<?= base_url(); ?>"><i class="fa fa-fw fa-home"></i><span> Cabang </span> </a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-folder"></i> <span> Penempatan </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Divisi</a></li>
                        <li><a href="">Posisi</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="<?= base_url(''); ?>"><i class="fas fa-users"></i><span> Karyawan </span> </a>
                </li>

                <li class="submenu">
                    <a href="<?= base_url('index.php/registrasi/'); ?>"><i class="fas fa-user-plus"></i><span> Rekrutmen </span> </a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-cogs"></i> <span> Perlengkapan </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Data Agama</a></li>
                        <li><a href="">Data Bidang Usaha</a></li>
                        <li><a href="">Data Kuisioner</a></li>
                        <li><a href="">Data Pekerjaan</a></li>
                        <li><a href="">Data Pendidikan</a></li>
                        <li><a href="">Data Warganegara</a></li>
                    </ul>
                </li>
-->

            </ul>

            <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

    </div>

</div>
<!-- End Sidebar -->