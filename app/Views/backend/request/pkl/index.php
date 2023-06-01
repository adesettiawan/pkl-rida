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
                                <a href="<?= base_url('admin/data_permohonan_pkl/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
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
                                                <td><?= $permohonan['nama_ketua'] ?></td>
                                                <td><?php foreach (unserialize($permohonan['nama_peserta']) as $nama_perserta) { ?>
                                                        <?= $nama_perserta . ',' ?>
                                                    <?php  } ?></td>
                                                <td><?= $permohonan['nama_instansi'] ?></td>
                                                <td><a href="<?= base_url('assets/file_surat/' . $permohonan['file_surat']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white"><i class="fas fa-download"></i></a></td>
                                                <td>
                                                    <?php if ($permohonan['tgl_diterima'] != '0000-00-00') { ?>
                                                        <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($permohonan['tgl_diterima'])) ?></div>
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
                                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#staticBackdrop<?= $permohonan['id'] ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-key"></i>
                                                                Verifikasi</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="<?= base_url('admin/data_permohonan_pkl/edit/' . $permohonan['id']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>

                                                            <div class="dropdown-divider"></div>
                                                            <a href="<?= base_url('admin/data_permohonan_pkl/delete/' . $permohonan['id']) ?>" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
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

    <!-- Modal -->
    <?php foreach ($data_permohonan as $permohonan) : ?>
        <div class="modal fade" id="staticBackdrop<?= $permohonan['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Status Surat Permohonan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/data_permohonan_pkl/verifikasiStatus/' . $permohonan['id']) ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih Status</label>
                                <select class="form-control" name="status">
                                    <?php if ($permohonan['status'] == 1) { ?>
                                        <option value="1">Diverifikasi</option>
                                        <option value="2">Belum Diverifikasi</option>
                                        <option value="0">Tidak Diverifikasi</option>
                                    <?php } elseif ($permohonan['status'] == 2) { ?>
                                        <option value="2">Belum Diverifikasi</option>
                                        <option value="1">Diverifikasi</option>
                                        <option value="0">Tidak Diverifikasi</option>
                                    <?php } else { ?>
                                        <option value="0">Tidak Diverifikasi</option>
                                        <option value="1">Diverifikasi</option>
                                        <option value="2">Belum Diverifikasi</option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Diterima</label>
                                <input id="tgl_diterima" type="date" class="form-control" name="tgl_diterima" value="<?= $permohonan['tgl_diterima'] != '0000-00-00' ? $permohonan['tgl_diterima'] : '' ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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