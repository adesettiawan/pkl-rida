<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data User</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('admin/add_users') ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
                            </div>
                        </div>
                        <?php

                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger text-white" role="alert">
                                <ul class="text-white">
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <?php if (session()->getFlashdata('messages')) {
                            echo '<div class="alert alert-danger bg-danger text-white" role="alert">';
                            echo session()->getFlashdata('messages');
                            echo '</div>';
                        } ?>

                        <?php if (session()->getFlashdata('message')) {
                            echo '<div class="alert alert-success bg-success text-white" role="alert">';
                            echo session()->getFlashdata('message');
                            echo '</div>';
                        } ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Image</th>
                                            <th>NIM/NPM</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telp</th>
                                            <th>Instansi</th>
                                            <th>Level</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($data_user as $user) : ?>
                                            <tr>
                                                <td>
                                                    <?= $i++ ?>
                                                </td>
                                                <td>
                                                    <?php if ($user['image'] != '') { ?>
                                                        <img alt="image" src="<?= base_url() ?>assets/img/<?= $user['image'] ?>" width="35">
                                                    <?php } else { ?>
                                                        <img alt="image" src="<?= base_url() ?>assets/img/profile.png" width=" 35">
                                                    <?php } ?>
                                                </td>
                                                <td><?= $user['npm'] ?></td>
                                                <td class="align-middle">
                                                    <?= $user['name'] ?>
                                                </td>

                                                <td><?= $user['email'] ?></td>
                                                <td><?= $user['telp'] ?></td>
                                                <td><?= $user['instansi_name'] ?></td>
                                                <td>
                                                    <?php if ($user['level'] == 1) { ?>
                                                        <div class="badge badge-primary badge-shadow">Admin</div>
                                                    <?php } else if ($user['level'] == 0) { ?>
                                                        <div class="badge badge-primary badge-shadow">Pimpinan</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-warning badge-shadow">User</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($user['status'] == 1) { ?>
                                                        <div class="badge badge-success badge-shadow">Aktif</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Tidak aktif</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Aksi</a>
                                                        <div class="dropdown-menu">
                                                            <a href="<?= base_url('admin/change-password/' . $user['id']) ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-key"></i>
                                                                Password</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="<?= base_url('admin/edit/' . $user['id']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                            <?php if ($user['level'] != '1') { ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="<?= base_url('admin/delete/' . $user['id']) ?>" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                                                    Delete</a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>