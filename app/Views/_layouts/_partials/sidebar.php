<?php
$uri = current_url(true);
$url_menu = $uri->getSegment(2);
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <?php if (session()->get('level') == 1) { ?>
            <div class="sidebar-brand">
                <a href="<?= base_url('admin/dashboard') ?>">
                    <img alt="image" src="<?= base_url() ?>assets/img/logo1.png" class="header-logo" />
                    <span class="logo-name">PKL RIDA</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>
                <li class="dropdown <?= $url_menu == 'dashboard' || $url_menu == '' ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>

                <li class="menu-header">Konten</li>
                <li <?= $url_menu == "data_permohonan_pkl" || $url_menu == "data_permohonan_kkn" || $url_menu == "data_permohonan_penelitian" ? 'class="dropdown active"' : '' ?>>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="inbox"></i><span>Surat Permohonan</span></a>
                    <ul class="dropdown-menu">
                        <li <?= $url_menu == "data_permohonan_pkl" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('admin/data_permohonan_pkl') ?>">PKL</a>
                        </li>
                        <li <?= $url_menu == "data_permohonan_kkn" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('admin/data_permohonan_kkn') ?>">KKN</a>
                        </li>
                        <li <?= $url_menu == "data_permohonan_penelitian" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('admin/data_permohonan_penelitian') ?>">Penelitian</a>
                        </li>
                    </ul>
                </li>

                <li <?= $url_menu == "data_balasan_pkl" || $url_menu == "data_balasan_kkn" || $url_menu == "data_balasan_penelitian" ? 'class="dropdown active"' : '' ?>>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="send"></i><span>Surat Balasan</span></a>
                    <ul class="dropdown-menu">
                        <li <?= $url_menu == "data_balasan_pkl" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('admin/data_balasan_pkl') ?>">PKL</a></li>
                        <li <?= $url_menu == "data_balasan_kkn" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('admin/data_balasan_kkn') ?>">KKN</a></li>
                        <li <?= $url_menu == "data_balasan_penelitian" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('admin/data_balasan_penelitian') ?>">Penelitian</a></li>
                    </ul>
                </li>

                <li <?= $url_menu == "laporan_pkl" || $url_menu == "laporan_kkn" || $url_menu == "laporan_penelitian" ? 'class="dropdown active"' : '' ?>>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li <?= $url_menu == "laporan_pkl" ? 'class="active"' : '' ?>><a href="<?= base_url('admin/laporan_pkl') ?>">PKL</a></li>
                        <li <?= $url_menu == "laporan_kkn" ? 'class="active"' : '' ?>><a href="<?= base_url('admin/laporan_kkn') ?>">KKN</a></li>
                        <li <?= $url_menu == "laporan_penelitian" ? 'class="active"' : '' ?>><a href="<?= base_url('admin/laporan_penelitian') ?>">Penelitian</a></li>
                    </ul>
                </li>

                <li class="menu-header">Supervisi</li>
                <li class="dropdown <?= $url_menu == 'supervisi' || $url_menu == '' ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/supervisi') ?>" class="nav-link"><i data-feather="rss"></i><span>Supervisi</span></a>
                </li>

                <li class="menu-header">Users</li>
                <li class="dropdown">
                    <a href="<?= base_url('admin/data_users') ?>" class="nav-link"><i data-feather="users"></i><span>Users</span></a>
                </li>
            </ul>
        <?php } elseif (session()->get('level') == 2) { ?>
            <div class="sidebar-brand">
                <a href="<?= base_url('user/dashboard') ?>">
                    <img alt="image" src="<?= base_url() ?>assets/img/logo1.png" class="header-logo" />
                    <span class="logo-name">PKL RIDA</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>
                <li class="dropdown <?= $url_menu == 'dashboard' || $url_menu == '' ? 'active' : '' ?>">
                    <a href="<?= base_url('user/dashboard') ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>

                <li class="menu-header">Konten</li>
                <li <?= $url_menu == "data_permohonan_pkl" || $url_menu == "data_permohonan_kkn" || $url_menu == "data_permohonan_penelitian" ? 'class="dropdown active"' : '' ?>>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="inbox"></i><span>Surat Permohonan</span></a>
                    <ul class="dropdown-menu">
                        <li <?= $url_menu == "data_permohonan_pkl" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('user/data_permohonan_pkl') ?>">PKL</a>
                        </li>
                        <li <?= $url_menu == "data_permohonan_kkn" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('user/data_permohonan_kkn') ?>">KKN</a>
                        </li>
                        <li <?= $url_menu == "data_permohonan_penelitian" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('user/data_permohonan_penelitian') ?>">Penelitian</a>
                        </li>
                    </ul>
                </li>

                <li <?= $url_menu == "data_balasan_pkl" || $url_menu == "data_balasan_kkn" || $url_menu == "data_balasan_penelitian" ? 'class="dropdown active"' : '' ?>>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="send"></i><span>Surat Balasan</span></a>
                    <ul class="dropdown-menu">
                        <li <?= $url_menu == "data_balasan_pkl" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('user/data_balasan_pkl') ?>">PKL</a></li>
                        <li <?= $url_menu == "data_balasan_kkn" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('user/data_balasan_kkn') ?>">KKN</a></li>
                        <li <?= $url_menu == "data_balasan_penelitian" ? 'class="active"' : '' ?>><a class="nav-link" href="<?= base_url('user/data_balasan_penelitian') ?>">Penelitian</a></li>
                    </ul>
                </li>

                <li <?= $url_menu == "laporan_pkl" || $url_menu == "laporan_kkn" || $url_menu == "laporan_penelitian" ? 'class="dropdown active"' : '' ?>>
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li <?= $url_menu == "laporan_pkl" ? 'class="active"' : '' ?>><a href="<?= base_url('user/laporan_pkl') ?>">PKL</a></li>
                        <li <?= $url_menu == "laporan_kkn" ? 'class="active"' : '' ?>><a href="<?= base_url('user/laporan_kkn') ?>">KKN</a></li>
                        <li <?= $url_menu == "laporan_penelitian" ? 'class="active"' : '' ?>><a href="<?= base_url('user/laporan_penelitian') ?>">Penelitian</a></li>
                    </ul>
                </li>

                <li class="menu-header">Supervisi</li>
                <li class="dropdown <?= $url_menu == 'supervisi' || $url_menu == '' ? 'active' : '' ?>">
                    <a href="<?= base_url('user/supervisi') ?>" class="nav-link"><i data-feather="rss"></i><span>Supervisi</span></a>
                </li>
            </ul>
        <?php } ?>
    </aside>
</div>