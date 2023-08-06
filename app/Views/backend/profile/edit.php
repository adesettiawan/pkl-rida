<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit profile</h4>
                            </div>
                        </div>

                        <?php

                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger" role="alert">
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
                            <!-- form edit -->
                            <form action="<?= base_url('update-profile/' . $profile['id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Email</label>
                                            <input id="id" name="id" type="hidden" value="<?= $profile['id'] ?>" class="form-control">
                                            <input id="email" name="email" type="email" disabled value="<?= $profile['email'] ?>" class="form-control" placeholder="fill email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Nama Lengkap</label>
                                                    <input id="name" name="name" value="<?= $profile['name'] ?>" type="text" class="form-control" placeholder="fill name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>NIM</label>
                                                    <input id="nim" name="npm" value="<?= $profile['npm'] ?>" type="text" class="form-control" placeholder="fill nim">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>No. Handphone</label>
                                                    <input id="telp" name="telp" value="<?= $profile['telp'] ?>" type="text" class="form-control" placeholder="fill telp">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Periode PKL</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <input id="periodeawal" name="periodeawal" value="<?= $profile['periodeawal'] != '0000-00-00' ? $profile['periodeawal'] : '' ?>" type="date" class="form-control" placeholder="fill periode awal">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <input id="periodeakhir" name="periodeakhir" value="<?= $profile['periodeakhir'] != '0000-00-00' ? $profile['periodeakhir'] : '' ?>" type="date" class="form-control" placeholder="fill periode akhir">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-0 mt-3">
                                        <?php if ($profile['image'] != '') { ?>
                                            <img id="image-preview" src="<?= base_url() ?>assets/img/<?= $profile['image'] ?>" style="margin-bottom: 10px; border: 1px solid #555; height: 180px; width: 180px; border-radius:10%" alt="image preview" />
                                        <?php } else { ?>
                                            <img id="image-preview" src="https://pertaniansehat.com/v01/wp-content/uploads/2015/08/default-placeholder.png" style="margin-bottom: 10px; border: 1px solid #555; height: 180px; width: 180px; border-radius:10%" alt="image preview" />
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-10 pr-0 mt-5">
                                        <div class="form-group form-group-default">
                                            <label style="margin-left: 30px">Upload Image</label>
                                            <input style="width: 94%; margin-left: 30px;" id="image" name="image" onchange="previewImage(this.value);" accept="image/*" onChange="validate(this.value)" type="file" value="<?= $profile['image'] ?>" class="form-control" placeholder="fill image">
                                            <span style="color: red" id="message_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd mt-3">
                                    <a href="<?= base_url('change-password-profile/' . $profile['id']) ?>" class="btn btn-danger">
                                        Change password
                                    </a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection('') ?>

<?= $this->Section('script') ?>

<script>
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

    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection('') ?>