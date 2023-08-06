<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelRequest;

class Dashboard extends BaseController
{
    protected $auth, $permohonan;

    public function __construct()
    {
        $this->auth = new ModelAuth();
        $this->permohonan = new ModelRequest();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        // data by instansi
        $dtPKL = $this->permohonan->get_chart_pkl_byInstitusi();
        $dtKKN = $this->permohonan->get_chart_kkn_byInstitusi();
        $dtPenelitian = $this->permohonan->get_chart_penelitian_byInstitusi();

        $dataByInstitusiPKL = [];
        foreach ($dtPKL as $key => $value) {
            $dataByInstitusiPKL['label'][] = $value['nama_instansi'];
            if (!empty($value['nama_peserta'])) {
                $dataByInstitusiPKL['data'][] = (int) $value['jumlah'] + count(unserialize($value['nama_peserta']));
            } else {
                $dataByInstitusiPKL['data'][] = (int) $value['jumlah'];
            }
        }

        $dataByInstitusiKKN = [];
        foreach ($dtKKN as $key => $value) {
            $dataByInstitusiKKN['label'][] = $value['nama_instansi'];
            if (!empty($value['nama_peserta'])) {
                $dataByInstitusiKKN['data'][] = (int) $value['jumlah'] + count(unserialize($value['nama_peserta']));
            } else {
                $dataByInstitusiKKN['data'][] = (int) $value['jumlah'];
            }
        }

        $dataByInstitusiPenelitian = [];
        foreach ($dtPenelitian as $key => $value) {
            $dataByInstitusiPenelitian['label'][] = $value['nama_instansi'];
            if (!empty($value['nama_peserta'])) {
                $dataByInstitusiPenelitian['data'][] = (int) $value['jumlah'] + count(unserialize($value['nama_peserta']));
            } else {
                $dataByInstitusiPenelitian['data'][] = (int) $value['jumlah'];
            }
        }

        $data['dataByInstitusiPKL'] = json_encode($dataByInstitusiPKL);
        $data['dataByInstitusiKKN'] = json_encode($dataByInstitusiKKN);
        $data['dataByInstitusiPenelitian'] = json_encode($dataByInstitusiPenelitian);

        // data by year
        $dtPKLYear = $this->permohonan->get_chart_pkl_byYear();
        $dtKKNYear = $this->permohonan->get_chart_kkn_byYear();
        $dtPenelitianYear = $this->permohonan->get_chart_penelitian_byYear();

        $dataByYearPKL = [];
        foreach ($dtPKLYear as $key => $value) {
            $dataByYearPKL['label'][] = $value['tahun'];
            if (!empty($value['nama_peserta'])) {
                $dataByYearPKL['data'][] = (int) $value['jumlah'] + count(unserialize($value['nama_peserta']));
            } else {
                $dataByYearPKL['data'][] = (int) $value['jumlah'];
            }
        }

        $dataByYearKKN = [];
        foreach ($dtKKNYear as $key => $value) {
            $dataByYearKKN['label'][] = $value['tahun'];
            if (!empty($value['nama_peserta'])) {
                $dataByYearKKN['data'][] = (int) $value['jumlah'] + count(unserialize($value['nama_peserta']));
            } else {
                $dataByYearKKN['data'][] = (int) $value['jumlah'];
            }
        }

        $dataByYearPenelitian = [];
        foreach ($dtPenelitianYear as $key => $value) {
            $dataByYearPenelitian['label'][] = $value['tahun'];
            if (!empty($value['nama_peserta'])) {
                $dataByYearPenelitian['data'][] = (int) $value['jumlah'] + count(unserialize($value['nama_peserta']));
            } else {
                $dataByYearPenelitian['data'][] = (int) $value['jumlah'];
            }
        }

        $data['dataByYearPKL'] = json_encode($dataByYearPKL);
        $data['dataByYearKKN'] = json_encode($dataByYearKKN);
        $data['dataByYearPenelitian'] = json_encode($dataByYearPenelitian);

        $data = [
            'title' => 'PKL Bidang RIDA',
            'user' => $this->auth->get_user_byLogin(),
            'byInstitusiPKL' => $data['dataByInstitusiPKL'],
            'byInstitusiKKN' => $data['dataByInstitusiKKN'],
            'byInstitusiPenelitian' => $data['dataByInstitusiPenelitian'],
            'byYearPKL' => $data['dataByYearPKL'],
            'byYearKKN' => $data['dataByYearKKN'],
            'byYearPenelitian' => $data['dataByYearPenelitian'],

        ];

        return view('backend/dashboard/index', $data);
    }
}
