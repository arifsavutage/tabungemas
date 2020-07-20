<!-- Left Sidebar -->
<div class="left main-sidebar">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">

            <ul>

                <li class="submenu">
                    <a href="<?= base_url(); ?>"><i class="fa fa-fw fa-home"></i><span> Dashboard </span> </a>
                </li>
                <?php
                $role = $this->session->userdata('role');

                $query_menu = $this->db->query("SELECT tb_user_menu_access.`id`, `role_id`, `menu_id`, tb_user_role.role_name, tb_user_menu.title, tb_user_menu.url, tb_user_menu.icon, tb_user_menu.parent_menu, tb_user_menu.is_active
                    FROM `tb_user_menu_access`
                    LEFT JOIN tb_user_role ON tb_user_role.id = tb_user_menu_access.role_id
                    LEFT JOIN tb_user_menu ON tb_user_menu.id = tb_user_menu_access.menu_id
                    WHERE tb_user_role.role_name = '$role' AND tb_user_menu.is_active = 1");

                foreach ($query_menu->result_array() as $menus) {
                    $iconparent = str_replace("_", " ", $menus['icon']);
                    echo '<li class="submenu">';
                    if ($menus['url'] == '#') {
                        echo '<a href="' . $menus['url'] . '"><i class="' . $iconparent . '"></i><span> ' . $menus['title'] . ' </span> <span class="menu-arrow"></span></a>';
                        echo '<ul class="list-unstyled">';
                        /**Sub Menu 1 */
                        $submenu1 = $this->db->query("SELECT `id`, `title`, `url`, `icon`, `parent_menu`, `is_active` FROM `tb_user_menu` WHERE `parent_menu`= $menus[menu_id] AND is_active = 1");
                        foreach ($submenu1->result_array() as $child1) {
                            if ($child1['url'] == '#') {
                                echo '<li class="submenu">';
                                echo '<a href="#"><span>' . $child1['title'] . '</span> <span class="menu-arrow"></span> </a>';
                                echo '<ul class="list-unstyled">';
                                /**Sub Menu 2 */
                                $submenu2 = $this->db->query("SELECT `id`, `title`, `url`, `icon`, `parent_menu`, `is_active` FROM `tb_user_menu` WHERE `parent_menu`= $child1[id] AND is_active = 1");
                                foreach ($submenu2->result_array() as $child2) {
                                    echo '<li><a href="' . base_url("index.php/$child2[url]") . '">' . $child2['title'] . '</a></li>';
                                }
                                echo '</ul>';
                                echo '</li>';
                            } else {
                                echo '<li><a href="' . base_url("index.php/$child1[url]") . '">' . $child1['title'] . '</a></li>';
                            }
                        }
                        echo '</ul>';
                    } else {
                        echo '<a href="' . $menus['url'] . '"><i class="' . $iconparent . '"></i><span> ' . $menus['title'] . ' </span> <span class="menu-arrow"></span></a>';
                    }

                    echo '</li>';
                }
                ?>

                <?php
                if ($this->session->userdata('role') == 'aa') :
                ?>

                    <li class="submenu">
                        <a href="#"><i class="fas fa-users"></i><span>Keanggotaan</span> <span class="menu-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url() . 'index.php/member/member_baru'; ?>">Anggota Baru</a></li>
                            <li><a href="<?= base_url() . 'index.php/member/member_list'; ?>"><span>Anggota Aktif</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-line-chart"></i><span>Transaksi</span> <span class="menu-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url() . 'index.php/transaksi/daftar_beli_emas'; ?>">Daftar Beli Emas</a></li>
                            <li><a href="<?= base_url() . 'index.php/transaksi/daftar_jual_emas'; ?>"><span>Daftar Jual Emas</span></a></li>
                            <li><a href="<?= base_url() . 'index.php/transaksi/daftar_tarik_fisik'; ?>"><span>Daftar Tarik Fisik</span></a></li>
                            <li><a href="<?= base_url() . 'index.php/transaksi/daftar_titipan_emas'; ?>"><span>Daftar Titipan Emas</span></a></li>
                            <li><a href="<?= base_url() . 'index.php/transaksi/daftar_deposit'; ?>"><span>Daftar Deposit</span></a></li>
                            <li><a href="<?= base_url() . 'index.php/transaksi/daftar_widraw'; ?>"><span>Daftar Widraw</span></a></li>
                            <li><a href="<?= base_url() . 'index.php/transaksi/alltransaction'; ?>"><span>Laporan Transaksi</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-user"></i><span>Pengguna</span> <span class="menu-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href=""><span>Daftar Role</span></a></li>
                            <li><a href=""><span>Dafar Pegawai</span></a></li>
                            <li><a href=""><span>Menu Management</span></a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-gears"></i><span>Pengaturan</span> <span class="menu-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url() . 'index.php/pengaturan/rekening'; ?>"><span>Rekening TED</span></a></li>
                        </ul>
                    </li>

                <?php
                endif;
                ?>
            </ul>

            <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

    </div>

</div>
<!-- End Sidebar -->