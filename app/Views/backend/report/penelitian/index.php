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
                            <h4>Data Laporan Penelitian</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('admin/laporan_penelitian/exportPDF') ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white mr-2"><i class="fas fa-download"></i> &nbsp; Rekap Data</a>
                                <?php if ($userLogin == 1) : ?>
                                    <a href="<?= base_url('admin/laporan_penelitian/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
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
                                            <th>Ketua Peserta</th>
                                            <th>Nama Instansi</th>
                                            <th>Nama Laporan</th>
                                            <th>File Laporan</th>
                                            <th>Status</th>
                                            <th>Tgl Unggah</th>
                                            <th>Tgl Update</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($laporan as $rpt) : ?>
                                            <tr>
                                                <td>
                                                    <?= $i++ ?>
                                                </td>

                                                <td><?= $rpt['nama_ketua'] ?></td>
                                                <td><?= $rpt['nama_instansi'] ?></td>
                                                <td><?= $rpt['filename'] ?></td>
                                                <td><a href="<?= base_url('assets/file_reports/penelitian/' . $rpt['file_reports']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white"><i class="fas fa-download"></i></a></td>
                                                <td>
                                                    <?php if ($rpt['status'] == 1) { ?>
                                                        <div class="badge badge-primary badge-shadow">Diterima</div>
                                                    <?php } elseif ($rpt['status'] == 3) { ?>
                                                        <div class="badge badge-success badge-shadow">Disetujui</div>
                                                    <?php } elseif ($rpt['status'] == 2) { ?>
                                                        <div class="badge badge-warning badge-shadow">Pending</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Ditolak</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($rpt['tgl_diunggah'])) ?></div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($rpt['tgl_diupdate'])) ?></div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Aksi</a>
                                                        <div class="dropdown-menu">
                                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#staticBackdrop<?= $rpt['id'] ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-key"></i>
                                                                Verifikasi</a>
                                                            <?php if ($userLogin == 1) : ?>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="<?= base_url('admin/laporan_penelitian/edit/' . $rpt['id']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>

                                                                <div class="dropdown-divider"></div>
                                                                <a href="<?= base_url('admin/laporan_penelitian/delete/' . $rpt['id']) ?>" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
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
    <?php foreach ($laporan as $rpt) : ?>
        <div class="modal fade" id="staticBackdrop<?= $rpt['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Status Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/laporan_penelitian/verifikasiStatus/' . $rpt['id']) ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih Status</label>
                                <select class="form-control" name="status">
                                    <?php if ($rpt['status'] == 1) { ?>
                                        <?php if ($userLogin == 1) : ?>
                                            <option value="1">Diterima</option>
                                        <?php endif; ?>
                                        <?php if ($userLogin == 0) : ?>
                                            <option value="3">Disetujui</option>
                                        <?php endif; ?>
                                        <option value="2">Pending</option>
                                        <option value="0">Ditolak</option>
                                    <?php } elseif ($rpt['status'] == 3) { ?>
                                        <?php if ($userLogin == 0) : ?>
                                            <option value="3">Disetujui</option>
                                        <?php endif; ?>
                                        <?php if ($userLogin == 1) : ?>
                                            <option value="1">Diterima</option>
                                        <?php endif; ?>
                                        <option value="2">Pending</option>
                                        <option value="0">Ditolak</option>
                                    <?php } elseif ($rpt['status'] == 2) { ?>
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