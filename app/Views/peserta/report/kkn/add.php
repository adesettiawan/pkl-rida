<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Laporan KKN</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('user/laporan_kkn') ?>" class="btn btn-dark"><i class="fas fa-angle-left"></i>&ensp;Back</a>
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
                        <form action="<?= base_url('user/laporan_kkn/store') ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?= csrf_field() ?>
                                <div class="row" id="multiForm">
                                    <input id="type" type="hidden" name="type" value="KKN">
                                    <div class="form-group col-12">
                                        <label for="user_id">Ketua Peserta</label>
                                        <input id="user_id" type="hidden" name="user_id" value="<?= session()->get('id') ?>">
                                        <input id="name_ketua" type="text" class="form-control" name="name_ketua" value="<?= session()->get('name') ?>" style="pointer-events: none;" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="filename">Nama Laporan</label>
                                    <input id="filename" type="text" class="form-control" name="filename" required>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <img id="image-preview2" src="https://www.poltekkes-solo.ac.id/cni-content/uploads/modules/posts/20220107023256.png" style="margin-bottom: 10px; border: 1px solid #555; height: 100px; width: 100px; border-radius:10%" alt="image preview" />
                                        </div>
                                        <div class="col-9">
                                            <label for="file_reports">Upload File Laporan </label>
                                            <input class="form-control mb-2" type="file" name="file_reports" id="file_reports" accept="application/pdf" onChange="validate2(this.value)" />
                                            <span style="color: red" id="message_error"></span>
                                            <smal style="color: #5046b9">File Laporan berformat: pdf.</smal>
                                        </div>
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

<script type="text/javascript">
    function validate2(file) {
        var ext = file.split(".");
        ext = ext[ext.length - 1].toLowerCase();
        var arrayExtensions = ["pdf"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $('#message_error').html("<i>Only formats are allowed : </i>" + arrayExtensions.join(', '));
            $("#file_reports").val("");
        }
    }
</script>


<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>