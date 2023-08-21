<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Surat Balasan PKL</h4>
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
                                            <th>Ketua Peserta</th>
                                            <th>Nama Instansi</th>
                                            <th>File Surat</th>
                                            <th>Status</th>
                                            <th>Tgl. Diunggah</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($data_balasan as $balasan) : ?>
                                            <tr>
                                                <td>
                                                    <?= $i++ ?>
                                                </td>
                                                <td><?= $balasan['no_surat'] ?></td>
                                                <td class="align-middle">
                                                    <?= $balasan['nama_surat'] ?>
                                                </td>

                                                <td><?= $balasan['nama_ketua'] ?></td>

                                                <td><?= $balasan['nama_instansi'] ?></td>
                                                <?php if ($balasan['status'] == 3) { ?>
                                                    <td><a href="<?= base_url('assets/file_replies/pkl/' . $balasan['file_replies']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white"><i class="fas fa-download"></i></a></td>
                                                <?php } else { ?>
                                                    <td>-</td>
                                                <?php } ?>
                                                <td>
                                                    <?php if ($balasan['status'] == 1) { ?>
                                                        <div class="badge badge-secondary badge-shadow">Ditinjau</div>
                                                    <?php } elseif ($balasan['status'] == 3) { ?>
                                                        <div class="badge badge-success badge-shadow">Disetujui</div>
                                                    <?php } elseif ($balasan['status'] == 2) { ?>
                                                        <div class="badge badge-warning badge-shadow">Pending</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Ditolak</div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($balasan['tgl_diunggah'])) ?></div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Aksi</a>
                                                        <div class="dropdown-menu">
                                                            <a href="<?= base_url('user/data_balasan_pkl/show/' . $balasan['id']) ?>" class="dropdown-item has-icon"><i class="far fa-eye"></i> Detail</a>
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