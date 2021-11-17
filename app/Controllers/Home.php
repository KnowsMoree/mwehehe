<?php

namespace App\Controllers;

use App\Models\PinjamBarangModel;

class Home extends BaseController
{

    protected $PinjamBarangModel;

    public function __construct()
    {
        $this->PinjamBarangModel = new PinjamBarangModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'pinjamBarang' => $this->PinjamBarangModel->getPinjamBarang()
        ];

        return view('vw_home', $data);
    }
}
