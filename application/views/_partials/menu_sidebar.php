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
                        <li><a href="<?= base_url(); ?>index.php/dashboard/profile/<?= $this->session->userdata('id'); ?>">Profile</a></li>
                        <li><a href="">Upload Foto</a></li>
                        <li><a href="">Berkas</a></li>
                        <li><a href="">Ubah Password</a></li>
                        <li><a href="">Histori Keanggotaan</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-retweet"></i> <span> Transaksi </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Beli Emas</a></li>
                        <li><a href="">Jual Emas</a></li>
                        <li><a href="">Tarik Saldo</a></li>
                        <li><a href="">Tarik barang</a></li>
                        <li><a href="">Transfer Emas</a></li>
                        <li><a href="">Histori Transaksi</a></li>
                    </ul>
                </li>

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