<?php
$uri = current_url(true);
$url_menu = $uri->getSegment(2);
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
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

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="gmaps-advanced-route.html">PKL</a></li>
                    <li><a href="gmaps-draggable-marker.html">KKN</a></li>
                    <li><a href="gmaps-geocoding.html">Penelitian</a></li>
                </ul>
            </li>

            <li class="menu-header">Users</li>
            <li class="dropdown">
                <a href="<?= base_url('admin/data_users') ?>" class="nav-link"><i data-feather="users"></i><span>Users</span></a>
            </li>
        </ul>
    </aside>
</div>