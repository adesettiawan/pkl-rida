<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('/') ?>">
                <img alt="image" src="<?= base_url() ?>assets/img/logo1.png" class="header-logo" />
                <span class="logo-name">PKL RIDA</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="<?= base_url('/') ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Konten</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="inbox"></i><span>Surat Permohonan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('admin/data_permohonan_pkl') ?>">PKL</a></li>
                    <li><a class="nav-link" href="forms-advanced-form.html">KKN</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Penelitian</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="send"></i><span>Surat Balasan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="basic-form.html">PKL</a></li>
                    <li><a class="nav-link" href="forms-advanced-form.html">KKN</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Penelitian</a></li>
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