<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Surat Permohonan</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('user/data_permohonan_pkl') ?>" class="btn btn-dark"><i class="fas fa-angle-left"></i>&ensp;Back</a>
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
                        <form action="<?= base_url('user/data_permohonan_pkl/update/' . $permohonan['id']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?= csrf_field() ?>
                                <div class="row" id="multiForm">
                                    <input id="type" type="hidden" name="type" value="PKL">
                                    <input id="user_id" type="hidden" name="user_id" value="<?= session()->get('id') ?>">
                                    <div class="form-group col-11">
                                        <label for="name_ketua">Ketua Peserta</label>
                                        <input style="width: 95%;" id="name_ketua" type="text" class="form-control" name="name_ketua" value="<?= session()->get('name') ?>" style="pointer-events: none;" disabled>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" id="addRemoveIp" class="btn btn-primary btn-lg" style="margin-top: 28px; margin-left: -32px;"><i class="fas fa-plus"></i></button>
                                    </div>

                                    <?php
                                    $i = 0;
                                    if ($permohonan['nama_peserta'] != '') {
                                        foreach (unserialize($permohonan['nama_peserta']) as $nama_peserta) {
                                            $id_feat = 'feat' . $i;

                                    ?>
                                            <?php $i++ ?>
                                            <div class="remove-group" id="<?= $id_feat ?>" style="position:relative; width:95%;">
                                                <div class="form-group col-11">
                                                    <label for="nama_peserta">Nama Anggota Peserta </label>
                                                    <input type="text" class="form-control" name="nama_peserta[]" id="nama_peserta" value="<?= $nama_peserta; ?>">
                                                </div>
                                                <div class="col-1" style="position: absolute; top: 26px;right: -2px;">
                                                    <button onclick="deletePeserta('<?= $id_feat ?>')" type="button" class="btn btn-danger btn-lg text-white"><i class="fas fa-minus-circle"></i></button>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="nama_instansi">Nama Instansi</label>
                                        <input id="nama_instansi" value="<?= $permohonan['nama_instansi'] ?>" type="text" class="form-control" name="nama_instansi" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="no_surat">No. Surat</label>
                                        <input id="no_surat" value="<?= $permohonan['no_surat'] ?>" type="text" class="form-control" name="no_surat" required>
                                    </div>
                                    <div class="form-group col-8">
                                        <label for="nama_surat">Nama Surat</label>
                                        <input id="nama_surat" value="<?= $permohonan['nama_surat'] ?>" type="text" class="form-control" name="nama_surat" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="asal_surat">Asal Surat</label>
                                        <input id="asal_surat" value="<?= $permohonan['asal_surat'] ?>" type="text" class="form-control" name="asal_surat" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <img id="image-preview2" src="https://www.poltekkes-solo.ac.id/cni-content/uploads/modules/posts/20220107023256.png" style="margin-bottom: 10px; border: 1px solid #555; height: 100px; width: 100px; border-radius:10%" alt="image preview" /><br>
                                            <span class="text-info">Nama file: <?= $permohonan['file_surat'] ?></span>
                                        </div>
                                        <div class="col-9">
                                            <label for="file_surat">Upload File Surat </label>
                                            <input class="form-control mb-2" type="file" name="file_surat" value="<?= $permohonan['file_surat'] ?>" id="file_surat" accept="application/pdf" onChange="validate2(this.value)" />
                                            <span style="color: red" id="message_error"></span>
                                            <smal style="color: #5046b9">File surat berformat: pdf.</smal>
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
            $("#file_surat").val("");
        }
    }
</script>

<script type="text/javascript">
    // Dynamic Input Image
    var i = 0;
    $("#addRemoveIp").click(function() {
        ++i;
        let html = '';
        html += '<div class="remove-group" style="position:relative; width:95%;">';
        html += '<div class="form-group col-11">';
        html += '<label for="nama_peserta">Nama Anggota Peserta </label>';
        html += '<input id="nama_peserta" type="text" class="form-control" name="nama_peserta[]">';
        html += '</div>';
        html += '<div class="col-1" style="position: absolute; top: 26px;right: -2px;">';
        html += '<button type="button" class="remove-item btn btn-danger btn-lg"><i class="fas fa-minus-circle"></i></button>';
        html += '</div>';
        html += '</div>';
        $("#multiForm").append(html);
    });
    $(document).on('click', '.remove-item', function() {
        $(this).parents('.remove-group').remove();
    });

    function deletePeserta(id) {
        var count = $('#multiForm').find('.input-fitur');
        if (count.length != 1) {
            $('#' + id).remove();
        }
    };
</script>



<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>