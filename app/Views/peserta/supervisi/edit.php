<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Pengajuan Supervisi</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('user/supervisi') ?>" class="btn btn-dark"><i class="fas fa-angle-left"></i>&ensp;Back</a>
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
                        <form action="<?= base_url('user/supervisi/update/' . $supervisi['id']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?= csrf_field() ?>
                                <div class="row" id="multiForm">
                                    <input id="type" type="hidden" name="type" value="PKL">
                                    <input id="user_id" type="hidden" name="user_id" value="<?= session()->get('id') ?>">
                                    <div class="form-group col-12">
                                        <label for="name_ketua">Ketua Peserta</label>
                                        <input id="name_ketua" type="text" class="form-control" name="name_ketua" value="<?= session()->get('name') ?>" style="pointer-events: none;" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="title">Judul Supervisi</label>
                                        <input id="title" value="<?= $supervisi['title'] ?>" type="text" class="form-control" name="title" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="tgl_supervisi">Tgl. Supervisi</label>
                                        <input id="tgl_supervisi" type="date" class="form-control" value="<?= $supervisi['tgl_supervisi'] ?>" name="tgl_supervisi" required>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="jam_supervisi">Waktu/Jam</label>
                                        <input id="jam_supervisi" value="<?= $supervisi['jam_supervisi'] ?>" type="time" class="form-control" name="jam_supervisi" required>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="type">Tipe Supervisi</label>
                                        <select class="form-control select2" name="type" id="type" required>
                                            <?php if ($supervisi['type'] == 'PKL') { ?>
                                                <option value="PKL">PKL</option>
                                                <option value="KKN">KKN</option>
                                                <option value="Penelitian">Penelitian</option>
                                            <?php } elseif ($supervisi['type'] == 'KKN') { ?>
                                                <option value="KKN">KKN</option>
                                                <option value="PKL">PKL</option>
                                                <option value="Penelitian">Penelitian</option>
                                            <?php } elseif ($supervisi['type'] == 'Penelitian') { ?>
                                                <option value="Penelitian">Penelitian</option>
                                                <option value="PKL">PKL</option>
                                                <option value="KKN">KKN</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->Section('script') ?>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>