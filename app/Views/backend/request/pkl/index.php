<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>
<?php
$userLogin = session()->get('level');
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Surat Permohonan PKL</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('admin/data_permohonan_pkl/exportPDF') ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white mr-2"><i class="fas fa-download"></i> &nbsp; Rekap Data</a>
                                <?php if ($userLogin == 1) : ?>
                                    <a href="<?= base_url('admin/data_permohonan_pkl/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
                                <?php endif; ?>
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
                                                <?php if ($permohonan['nama_peserta'] != '') { ?><td><?php foreach (unserialize($permohonan['nama_peserta']) as $nama_perserta) { ?>
                                                            <?= $nama_perserta . ',' ?>
                                                        <?php  } ?></td>
                                                <?php } else { ?>
                                                    <td>-</td>
                                                <?php } ?>
                                                <td><?= $permohonan['nama_instansi'] ?></td>
                                                <td><a href="<?= base_url('assets/file_surat/pkl/' . $permohonan['file_surat']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white"><i class="fas fa-download"></i></a></td>
                                                <td>
                                                    <?php if ($permohonan['tgl_diterima'] != '0000-00-00') { ?>
                                                        <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($permohonan['tgl_diterima'])) ?></div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-secondary badge-shadow">Proses</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($permohonan['status'] == 1) { ?>
                                                        <div class="badge badge-primary badge-shadow">Diterima</div>
                                                    <?php } elseif ($permohonan['status'] == 3) { ?>
                                                        <div class="badge badge-success badge-shadow">Disetujui</div>
                                                    <?php } elseif ($permohonan['status'] == 2) { ?>
                                                        <div class="badge badge-warning badge-shadow">Pending</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Ditolak</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Aksi</a>
                                                        <div class="dropdown-menu">
                                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#staticBackdrop<?= $permohonan['id'] ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-key"></i>
                                                                Verifikasi</a>
                                                            <?php if ($userLogin == 1) : ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="<?= base_url('admin/data_permohonan_pkl/edit/' . $permohonan['id']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>

                                                                <div class="dropdown-divider"></div>
                                                                <a href="<?= base_url('admin/data_permohonan_pkl/delete/' . $permohonan['id']) ?>" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                                                    Delete</a>
                                                            <?php endif; ?>
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
                                        <?php if ($userLogin == 1) : ?>
                                            <option value="1">Diterima</option>
                                        <?php endif; ?>
                                        <?php if ($userLogin == 0) : ?>
                                            <option value="3">Disetujui</option>
                                        <?php endif; ?>
                                        <option value="2">Pending</option>
                                        <option value="0">Ditolak</option>
                                    <?php } elseif ($permohonan['status'] == 3) { ?>
                                        <?php if ($userLogin == 0) : ?>
                                            <option value="3">Disetujui</option>
                                        <?php endif; ?>
                                        <?php if ($userLogin == 1) : ?>
                                            <option value="1">Diterima</option>
                                        <?php endif; ?>
                                        <option value="2">Pending</option>
                                        <option value="0">Ditolak</option>
                                    <?php } elseif ($permohonan['status'] == 2) { ?>
                                        <option value="2">Pending</option>
                                        <?php if ($userLogin == 0) : ?>
                                            <option value="3">Disetujui</option>
                                        <?php endif; ?>
                                        <?php if ($userLogin == 1) : ?>
                                            <option value="1">Diterima</option>
                                        <?php endif; ?>
                                        <option value="0">Ditolak</option>
                                    <?php } else { ?>
                                        <option value="0">Ditolak</option>
                                        <?php if ($userLogin == 0) : ?>
                                            <option value="3">Disetujui</option>
                                        <?php endif; ?>
                                        <?php if ($userLogin == 1) : ?>
                                            <option value="1">Diterima</option>
                                        <?php endif; ?>
                                        <option value="2">Pending</option>
                                    <?php } ?>

                                </select>
                            </div>
                            <?php if ($userLogin == 1) :
                                $type = "date";
                                $style = "display: block;";
                            ?>
                            <?php else :
                                $type = "hidden";
                                $style = "display: none;";
                            ?>

                            <?php endif ?>
                            <div class="form-group" style="<?= $style ?>">
                                <label>Tanggal Diterima</label>
                                <input id="tgl_diterima" type="<?= $type ?>" class="form-control" name="tgl_diterima" value="<?= $permohonan['tgl_diterima'] != '0000-00-00' ? $permohonan['tgl_diterima'] : '' ?>">
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