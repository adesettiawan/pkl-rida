<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-left">
                                <?php if ($user['image'] != '') { ?>
                                    <img alt="image" src="<?= base_url() ?>assets/img/<?= $user['image'] ?>" class="rounded-circle author-box-picture">
                                <?php  } else { ?>
                                    <img alt="image" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle author-box-picture">
                                <?php } ?>

                                <div class="clearfix"></div>
                            </div>
                            <div class="author-box-details">
                                <div class="author-box-name" style="font-size: 20px;">
                                    <a href="javascript:void(0)"><?= "Hi, " . $user['name'] ?> </a>
                                    <?php if ($user['status'] == 1) { ?>
                                        <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Aktif</div>
                                    <?php } else { ?>
                                        <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Tidak aktif</div>
                                    <?php } ?>
                                </div>
                                <div class="author-box-job mt-1" style="font-size: 14px;"></div>
                                <div class="author-box-description">
                                    <p>NPM : <?= $user['npm'] ?> | <?= $user['instansi_name'] ?> <br>
                                        <span style="font-size: 14px;">Email : <?= $user['email'] ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berdasarkan institusi -->
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-header">
                            <h4>1. Berdasarkan Institusi</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>PKL</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card" style="margin-bottom: 15px;opacity: 0">
                        <div class="card-header">
                            <h4>&nbsp;</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>KKN</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Penelitian</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3" height="180"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!-- Berdasarkan Prodi -->
            <!-- <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-header">
                            <h4>2. Berdasarkan Prodi</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>PKL</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart4" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card" style="margin-bottom: 15px;opacity: 0">
                        <div class="card-header">
                            <h4>&nbsp;</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>KKN</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart5" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card" style="margin-bottom: 15px;opacity: 0">
                        <div class="card-header">
                            <h4>&nbsp;</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Penelitian</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart6" height="180"></canvas>
                        </div>
                    </div>
                </div> -->
            <!-- end -->

            <!-- Berdasarkan Banyak / Jumlah yang melakukan: -->
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card" style="margin-bottom: 15px; width: 504px;">
                        <div class="card-header">
                            <h4>2. Berdasarkan Jumlah dalam Tahun</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>PKL</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart7" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card" style="margin-bottom: 15px;opacity: 0">
                        <div class="card-header">
                            <h4>&nbsp;</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>KKN</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart8" height="180"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card" style="margin-bottom: 15px;opacity: 0">
                        <div class="card-header">
                            <h4>&nbsp;</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Penelitian</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart9" height="180"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->Section('script') ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    // Berdasarkan institusi
    const byInstitusiPKL = <?php echo $byInstitusiPKL ?>;
    const byInstitusiKKN = <?php echo $byInstitusiKKN ?>;
    const byInstitusiPenelitian = <?php echo $byInstitusiPenelitian ?>;

    const ctx = document.getElementById('myChart');
    const ctx2 = document.getElementById('myChart2');
    const ctx3 = document.getElementById('myChart3');

    // setup 
    const databyInstitusiPKL = {
        labels: byInstitusiPKL.label,
        datasets: [{
            label: 'Jumlah PKL',
            data: byInstitusiPKL.data,
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            backgroundColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderWidth: 1,
        }]
    };


    // config 
    const config = {
        type: 'bar',
        data: databyInstitusiPKL,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },

            },
        },
    };

    // render init block
    const myChart = new Chart(
        ctx,
        config
    );

    // setup 
    const databyInstitusiKKN = {
        labels: byInstitusiKKN.label,
        datasets: [{
            label: 'Jumlah KKN',
            data: byInstitusiKKN.data,
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            backgroundColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderWidth: 1,
        }]
    };


    // config 
    const configK = {
        type: 'bar',
        data: databyInstitusiKKN,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },

            },
        },
    };

    // render init block
    const myChart2 = new Chart(
        ctx2,
        configK
    );

    // setup 
    const databyInstitusiPenelitian = {
        labels: byInstitusiPenelitian.label,
        datasets: [{
            label: 'Jumlah Penelitian',
            data: byInstitusiPenelitian.data,
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            backgroundColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderWidth: 1,
        }]
    };


    // config 
    const configPn = {
        type: 'bar',
        data: databyInstitusiPenelitian,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },

            },
        },
    };

    // render init block
    const myChart3 = new Chart(
        ctx3,
        configPn
    );
    // end

    // // Berdasarkan prodi
    // const ctx4 = document.getElementById('myChart4');
    // const ctx5 = document.getElementById('myChart5');
    // const ctx6 = document.getElementById('myChart6');

    // new Chart(ctx4, {
    //     type: 'bar',
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // new Chart(ctx5, {
    //     type: 'bar',
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // new Chart(ctx6, {
    //     type: 'bar',
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
    // // end

    // Berdasarkan jumlah
    const byYearPKL = <?php echo $byYearPKL ?>;
    const byYearKKN = <?php echo $byYearKKN ?>;
    const byYearPenelitian = <?php echo $byYearPenelitian ?>;

    const ctx7 = document.getElementById('myChart7');
    const ctx8 = document.getElementById('myChart8');
    const ctx9 = document.getElementById('myChart9');

    // setup 
    const databyYearPKL = {
        labels: byYearPKL.label,
        datasets: [{
            label: 'Jumlah PKL',
            data: byYearPKL.data,
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            backgroundColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderWidth: 1,
        }]
    };


    // config 
    const configPk = {
        type: 'bar',
        data: databyYearPKL,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },

            },
        },
    };

    // render init block
    const myChart7 = new Chart(
        ctx7,
        configPk
    );

    // setup 
    const databyYearKKN = {
        labels: byYearKKN.label,
        datasets: [{
            label: 'Jumlah KKN',
            data: byYearKKN.data,
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            backgroundColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderWidth: 1,
        }]
    };


    // config 
    const configkkn = {
        type: 'bar',
        data: databyYearKKN,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },

            },
        },
    };

    // render init block
    const myChart8 = new Chart(
        ctx8,
        configkkn
    );

    // setup 
    const databyYearPenelitian = {
        labels: byYearPenelitian.label,
        datasets: [{
            label: 'Jumlah Penelitian',
            data: byYearPenelitian.data,
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            backgroundColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderColor: [
                'rgba(27, 104, 255, 1)',
            ],
            borderWidth: 1,
        }]
    };


    // config 
    const configPl = {
        type: 'bar',
        data: databyYearPenelitian,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },

            },
        },
    };

    // render init block
    const myChart9 = new Chart(
        ctx9,
        configPl
    );
    // end
</script>
<?= $this->endSection() ?>