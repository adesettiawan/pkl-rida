<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
            <li>
                <!-- <form class="form-inline mr-auto">
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form> -->
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <?php
                $db      = \Config\Database::connect();
                $users = $db->table('users')->where('id', session()->get('id'))->get()->getRowArray();

                if (session()->get('image') != '') { ?>
                    <img alt="image" src="<?= base_url() ?>assets/img/<?= $users['image'] ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block">
                    <?php  } else { ?>
                        <img alt="image" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block">
                        <?php } ?>

                        </span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hi, <?= session()->get('name') ?></div>
                <a href="<?= base_url('profile/' . session()->get('id')) ?>" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
            </div>
        </li>
    </ul>
</nav>