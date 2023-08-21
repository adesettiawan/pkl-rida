<title><?= $title ?></title>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rekap Data Surat Permohonan Penelitian</h4>
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
                                        <th>Asal Surat</th>
                                        <th>Ketua Peserta</th>
                                        <th>Anggota Peserta</th>
                                        <th>Nama Instansi</th>
                                        <th>File Surat</th>
                                        <th>Tgl Surat Diterima</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php $i = 1 ?>
                                    <?php foreach ($data_permohonan as $permohonan) : ?>
                                        <tr>
                                            <td>
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $permohonan['no_surat'] ?></td>
                                            <td class="align-middle">
                                                <?= $permohonan['nama_surat'] ?>
                                            </td>

                                            <td><?= $permohonan['asal_surat'] ?></td>
                                            <td><?= $permohonan['nama_ketua'] ?></td>
                                            <?php if ($permohonan['nama_peserta'] != '') { ?><td><?php foreach (unserialize($permohonan['nama_peserta']) as $nama_perserta) { ?>
                                                        <?= $nama_perserta . ',' ?>
                                                    <?php  } ?></td>
                                            <?php } else { ?>
                                                <td>-</td>
                                            <?php } ?>
                                            <td><?= $permohonan['nama_instansi'] ?></td>
                                            <td><a href="<?= base_url('assets/file_surat/penelitian/' . $permohonan['file_surat']) ?>" target="_blank" class="btn btn-danger px-2 btn-sm text-white">Link Surat</td>
                                            <td>
                                                <?php if ($permohonan['tgl_diterima'] != '0000-00-00') { ?>
                                                    <div class="badge badge-info badge-shadow"><?= date('d-m-Y', strtotime($permohonan['tgl_diterima'])) ?></div>
                                                <?php } else { ?>
                                                    <div class="badge badge-secondary badge-shadow">Proses</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($permohonan['status'] == 1) { ?>
                                                    <div class="badge badge-primary badge-shadow">Diterima</div>
                                                <?php } elseif ($permohonan['status'] == 3) { ?>
                                                    <div class="badge badge-success badge-shadow">Disetujui</div>
                                                <?php } elseif ($permohonan['status'] == 2) { ?>
                                                    <div class="badge badge-warning badge-shadow">Pending</div>
                                                <?php } else { ?>
                                                    <div class="badge badge-danger badge-shadow">Ditolak</div>
                                                <?php } ?>
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