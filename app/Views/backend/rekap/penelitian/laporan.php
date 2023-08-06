<title><?= $title ?></title>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rekap Data Laporan Penelitian</h4>
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
                                        <th>Ketua Peserta</th>
                                        <th>Nama Instansi</th>
                                        <th>Nama Laporan</th>
                                        <th>File Laporan</th>
                                        <th>Status</th>
                                        <th>Tgl Unggah</th>
                                        <th>Tgl Update</th>
                                    </tr>

                                    <?php $i = 1 ?>
                                    <?php foreach ($data_laporan as $rpt) : ?>
                                        <tr>
                                            <td>
                                                <?= $i++ ?>
                                            </td>

                                            <td><?= $rpt['nama_ketua'] ?></td>
                                            <td><?= $rpt['nama_instansi'] ?></td>
                                            <td><?= $rpt['filename'] ?></td>
                                            <td><a href="<?= base_url('assets/file_reports/penelitian/' . $rpt['file_reports']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white">Link File</a></td>
                                            <td>
                                                <?php if ($rpt['status'] == 1) { ?>
                                                    <div class="badge badge-success badge-shadow">Diterima</div>
                                                <?php } elseif ($rpt['status'] == 2) { ?>
                                                    <div class="badge badge-warning badge-shadow">Pending</div>
                                                <?php } else { ?>
                                                    <div class="badge badge-danger badge-shadow">Ditolak</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($rpt['tgl_diunggah'])) ?></div>
                                            </td>
                                            <td>
                                                <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($rpt['tgl_diupdate'])) ?></div>
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