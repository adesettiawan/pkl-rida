<title><?= $title ?></title>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rekap Data Surat Balasan Penelitian</h4>
                        </div>
                        <style type="text/css">
                            /* Pengaturan border-collapse jenis,ukuran serta warna huruf secara keseluruhan tabel */
                            table {
                                border-collapse: collapse;
                                font: normal normal 12px Verdana, Arial, Sans-Serif;
                                color: #333333;
                                overflow: hidden;
                            }

                            /* Mengatur warna latar, warna teks, ukruan font dan jenis bold (tebal) pada header tabel */
                            table th {
                                color: #000;
                                font-weight: bold;
                                font-size: 12px;
                                text-align: center;
                            }

                            /* Mengatur border dan jarak/ruang pada kolom */
                            table th,
                            table td {
                                vertical-align: top;
                                padding: 5px 10px;
                                text-align: center;

                            }
                        </style>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table border="1">
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
                                        <th>Tgl Unggah</th>
                                        <th>Tgl Update</th>
                                    </tr>

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
                                            <td><a href="<?= base_url('assets/file_replies/penelitian/' . $balasan['file_replies']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white">Link File</a></td>
                                            <td>
                                                <?php if ($balasan['status'] == 1) { ?>
                                                    <div class="badge badge-success badge-shadow">Diterima</div>
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
                                                <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($balasan['tgl_diupdate'])) ?></div>
                                            </td>

                                        </tr>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>