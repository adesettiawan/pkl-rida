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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>No Surat</th>
                                            <th>Nama Surat</th>
                                            <th>Asal Surat</th>
                                            <th>Ketua Peserta</th>
                                            <th>Anggota Peserta</th>
                                            <th>Nama Instansi</th>
                                            <th>File Surat</th>
                                            <th>Tgl Surat Diterima</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($data_permohonan as $permohonan) : ?>
                                            <tr>
                                                <td>
                                                    <?= $i++ ?>
                                                </td>
                                                <td><?= $permohonan['no_surat'] ?></td>
                                                <td class="align-middle">
                                                    <?= $permohonan['nama_surat'] ?>
                                                </td>

                                                <td><?= $permohonan['asal_surat'] ?></td>
                                                <td><?= $permohonan['user_id'] ?></td>
                                                <td><?= $permohonan['nama_peserta'] ?></td>
                                                <td><?= $permohonan['nama_instansi'] ?></td>
                                                <td><?= $permohonan['file_surat'] ?></td>
                                                <td>
                                                    <?php if ($permohonan['tgl_diterima'] != '') { ?>
                                                        <div class="badge badge-info badge-shadow"><?= $permohonan['tgl_diterima'] ?></div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-secondary badge-shadow">Proses</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($permohonan['status'] == 1) { ?>
                                                        <div class="badge badge-success badge-shadow">Diverifikasi</div>
                                                    <?php } elseif ($permohonan['status'] == 2) { ?>
                                                        <div class="badge badge-warning badge-shadow">Belum diverifikasi</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Tidak diverifikasi</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Aksi</a>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item has-icon text-warning"><i class="fas fa-key"></i>
                                                                Verifikasi</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>

                                                            <div class="dropdown-divider"></div>
                                                            <a href="" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                                                Delete</a>
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