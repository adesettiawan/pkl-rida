<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Surat Balasan KKN</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('user/data_balasan_kkn') ?>" class="btn btn-dark"><i class="fas fa-angle-left"></i>&ensp;Back</a>
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
                            <div class="row" id="multiForm">
                                <input id="type" type="hidden" name="type" value="KKN">
                                <div class="form-group col-12">
                                    <label for="user_id">Ketua Peserta</label>
                                    <select disabled name="user_id" id="user_id" class="form-control select2">
                                        <option value="">Pilih Ketua</option>
                                        <?php foreach ($users as $key => $user) { ?>
                                            <option value="<?= $user['id'] ?>" <?= $user['id'] == $balasan['user_id'] ? 'selected' : '' ?>><?= $user['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="no_surat">No. Surat</label>
                                    <input disabled id="no_surat" type="text" class="form-control" value="<?= $balasan['no_surat'] ?>" name="no_surat" required>
                                </div>
                                <div class="form-group col-8">
                                    <label for="nama_surat">Nama Surat</label>
                                    <input disabled id="nama_surat" type="text" class="form-control" value="<?= $balasan['nama_surat'] ?>" name="nama_surat" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <img id="image-preview2" src="https://www.poltekkes-solo.ac.id/cni-content/uploads/modules/posts/20220107023256.png" style="margin-bottom: 10px; border: 1px solid #555; height: 100px; width: 100px; border-radius:10%" alt="image preview" /><br>
                                        <span class="text-info">Nama file: <?= $balasan['file_replies'] ?></span>
                                    </div>
                                    <div class="col-9">
                                        <label for="file_replies">Upload File Surat </label>
                                        <input disabled class="form-control mb-2" type="file" name="file_replies" value="<?= $balasan['file_replies'] ?>" id="file_replies" accept="application/pdf" onChange="validate2(this.value)" />
                                        <span style="color: red" id="message_error"></span>
                                        <smal style="color: #5046b9">File surat berformat: pdf.</smal>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('assets/file_replies/kkn/' . $balasan['file_replies']) ?>" target="_blank" class="btn btn-primary mr-1">Unduh Surat Balasan</a>
                        </div>
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
            $("#file_replies").val("");
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