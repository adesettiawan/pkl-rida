<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pengajuan Supervisi</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('user/supervisi/add') ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&ensp;Tambah Data</a>
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
                                            <th>Judul</th>
                                            <th>Ketua Peserta</th>
                                            <th>Nama Instansi</th>
                                            <th>Tgl. Supervisi</th>
                                            <th>Jam Supervisi</th>
                                            <th>Tgl. Pengajuan</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($supervisi as $spv) : ?>
                                            <tr>
                                                <td>
                                                    <?= $i++ ?>
                                                </td>
                                                <td><?= $spv['title'] ?></td>
                                                <td class="align-middle">
                                                    <?= $spv['nama_ketua'] ?>
                                                </td>

                                                <td><?= $spv['nama_instansi'] ?></td>
                                                <td>
                                                    <?php if ($spv['tgl_supervisi'] != '0000-00-00') { ?>
                                                        <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($spv['tgl_supervisi'])) ?></div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-secondary badge-shadow">Proses</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($spv['jam_supervisi'] != '') { ?>
                                                        <div class="badge badge-success badge-shadow"><?= date('H:i', strtotime($spv['jam_supervisi'])) ?></div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-secondary badge-shadow">Proses</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($spv['tgl_diunggah'] != '') { ?>
                                                        <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($spv['tgl_diunggah'])) ?></div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-secondary badge-shadow">Proses</div>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $spv['type'] ?>
                                                </td>
                                                <td>
                                                    <?php if ($spv['status'] == 1) { ?>
                                                        <div class="badge badge-success badge-shadow">Approve</div>
                                                    <?php } elseif ($spv['status'] == 2) { ?>
                                                        <div class="badge badge-warning badge-shadow">Pending</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Rejected</div>
                                                    <?php } ?>
                                                </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Aksi</a>
                                                        <div class="dropdown-menu">
                                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#staticBackdrop<?= $spv['id'] ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-key"></i>
                                                                Konfirmasi By Email</a>
                                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#staticBackdrop2<?= $spv['id'] ?>" class="dropdown-item has-icon text-success"><i class="fab fa-whatsapp"></i>
                                                                Konfirmasi By WhatsApp</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="<?= base_url('user/supervisi/edit/' . $spv['id']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>

                                                            <div class="dropdown-divider"></div>
                                                            <a href="<?= base_url('user/supervisi/delete/' . $spv['id']) ?>" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
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

    <!-- Modal konfirmasi email-->
    <?php foreach ($supervisi as $spv) : ?>
        <div class="modal fade" id="staticBackdrop<?= $spv['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pengajuan Supervisi By Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('user/supervisi/verifikasiToAdmin/' . $spv['id']) ?>" method="POST">
                        <div class="modal-body">
                            <p>Apakah anda yakin ingin mengirimkan permohonan verifikasi ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- end -->

    <!-- Modal whatsapp-->
    <?php foreach ($supervisi as $spv) : ?>
        <div class="modal fade" id="staticBackdrop2<?= $spv['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pengajuan Supervisi By WhatsApp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- <form action="<?= base_url('user/supervisi/verifikasiToAdminByWA/' . $spv['id']) ?>" method="POST"> -->
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin mengirimkan permohonan verifikasi ? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <?php
                        $telp = $user_admin['telp'];
                        $telp = $telp && substr($telp, 0, 2) == '08' ? '62' . substr($telp, 1) : $telp; ?>
                        <a href="https://wa.me/<?= $telp ?>?text=Perkenalkan Saya%20<?= $spv['nama_ketua'] ?>%20Ingin menginformasikan%20telah%20mengajukan%20tanggal%20supervisi%20<?= $spv['type'] ?>.%20Terimakasih!" target="_blank" class="btn btn-primary">Ya</a>
                    </div>
                    <!-- </form> -->
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