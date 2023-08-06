<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data User</h4>
                            <div class="card-header-action">
                                <a href="<?= base_url('admin/data_users') ?>" class="btn btn-dark"><i class="fas fa-angle-left"></i>&ensp;Back</a>
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
                        <form action="<?= base_url('admin/store') ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Nama lengkap</label>
                                        <input id="name" type="text" class="form-control" name="name" autofocus required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="telp">No. Handphone</label>
                                        <input id="telp" type="number" class="form-control" name="telp" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="instansi_name">Nama Instansi</label>
                                        <input id="instansi_name" type="text" class="form-control" name="instansi_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Password Confirmation</label>
                                        <input id="password2" type="password" class="form-control" name="repassword">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="npm">NIM/NPM</label>
                                        <input id="npm" type="text" class="form-control" name="npm" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <img id="image-preview2" src="https://pertaniansehat.com/v01/wp-content/uploads/2015/08/default-placeholder.png" style="margin-bottom: 10px; border: 1px solid #555; height: 100px; width: 100px; border-radius:10%" alt="image preview" />
                                            </div>
                                            <div class="col-9">
                                                <label for="ktm">Upload KTM</label>
                                                <input class="form-control mb-2" type="file" onchange="previewImage2(this.value);" name="ktm" id="ktm" accept="image/*" onChange="validate2(this.value)" />
                                                <span style="color: red" id="message_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Pilih Level</label>
                                        <select class="form-control" name="level">
                                            <option value="">Pilih Level Akun</option>
                                            <option value="0">Pimpinan</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Pilih Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Pilih Status Akun</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label>Pilih Foto Profile</label>
                                                <img id="image-preview" src="https://pertaniansehat.com/v01/wp-content/uploads/2015/08/default-placeholder.png" style="margin-bottom: 10px; border: 1px solid #555; height: 180px; width: 180px; border-radius:10%" alt="image preview" />
                                            </div>
                                            <div class="col-8">
                                                <input style="margin-top: 100px; margin-left:90px" class="form-control mb-2" type="file" onchange="previewImage(this.value);" name="image" id="image" accept="image/*" onChange="validate(this.value)" />
                                                <span style="color: red" id="message_error"></span>
                                            </div>
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
    // validasi extention image
    function validate(file) {
        var ext = file.split(".");
        ext = ext[ext.length - 1].toLowerCase();
        var arrayExtensions = ["jpg", "jpeg", "svg", "png", "bmp", "gif"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $('#message_error').html("<i>Only formats are allowed : </i>" + arrayExtensions.join(', '));
            $("#image").val("");
        }
    }

    // review image upload
    function previewImage(dataImage) {
        validate(dataImage);
        document.getElementById('image-preview').style.display = "block";
        var oFReader = new FileReader();
        if (document.getElementById('image').files[0] !== undefined) {
            oFReader.readAsDataURL(document.getElementById('image').files[0])
            oFReader.onload = function(oFREvent) {
                document.getElementById('image-preview').src = oFREvent.target.result;
            };
            $('#message_error').hide();
        } else {
            $('#message_error').show();
        }
    };

    function validate2(file) {
        var ext = file.split(".");
        ext = ext[ext.length - 1].toLowerCase();
        var arrayExtensions = ["jpg", "jpeg", "svg", "png", "bmp", "gif"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            $('#message_error').html("<i>Only formats are allowed : </i>" + arrayExtensions.join(', '));
            $("#ktm").val("");
        }
    }

    // review ktm upload
    function previewImage2(dataImage) {
        validate2(dataImage);
        document.getElementById('image-preview2').style.display = "block";
        var oFReader = new FileReader();
        if (document.getElementById('ktm').files[0] !== undefined) {
            oFReader.readAsDataURL(document.getElementById('ktm').files[0])
            oFReader.onload = function(oFREvent) {
                document.getElementById('image-preview2').src = oFREvent.target.result;
            };
            $('#message_error').hide();
        } else {
            $('#message_error').show();
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