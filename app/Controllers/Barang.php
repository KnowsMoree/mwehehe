<?php

// XII RPL B wahyu hidayat

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{

    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Daftar barang',
            'barang' => $this->barangModel->getBarang()
        ];

        return view('barang/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Barang',
            'barang' => $this->barangModel->getBarang($slug)
        ];

        // jika di table tidak ada barang

        if (empty($data['barang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Barang' . $slug . ' tidak ditemukan.');
        }

        return view('barang/detail', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Form Tambah Barang',
            'validation' => \Config\Services::validation()
        ];

        return view('barang/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required|is_unique[barang.nama_barang]',
                'errors' => [
                    'required' => 'Nama barang harus di isi.',
                    'is_unique' => 'nama barang sudah ada.'
                ]
            ],
            'spesifikasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi.'
                ]
            ],
            'jumlah_barang' => [
                'rules' => 'alpha_numeric',
                'errors' => [
                    'alpha_numeric' => 'jumlah barang harus angka'
                ]
            ],
        ])) {
            return redirect()->to('/barang/create')->withInput();
        }

        // $fileFoto = $this->request->getFile('foto');

        // if ($fileFoto->getError() == 4) {
        //     $namaFoto = 'default.jpg';
        // } else {
        //     $namaFoto = $fileFoto->getRandomName();

        //     $fileFoto->move('img', $namaFoto);
        // }


        $slug = url_title($this->request->getVar('nama_barang'), '-', true);

        $this->barangModel->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'slug' => $slug,
            'spesifikasi' => $this->request->getVar('spesifikasi'),
            'kondisi' => $this->request->getVar('kondisi'),
            'jumlah_barang' => $this->request->getVar('jumlah_barang')
        ]);

        session()->setFlashdata('pesan', 'Barang berhasil ditambahkan.');

        return redirect()->to('/barang');
    }

    public function delete($id_barang)
    {
        // $barang = $this->barangModel->find($id_barang);

        // if ($barang['foto'] != 'default.jpg') {
        //     unlink('img/' . $barang['foto']);
        // }

        $this->barangModel->delete($id_barang);
        session()->setFlashdata('pesan', 'Barang berhasil dihapus.');
        return redirect()->to('/barang');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Barang',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barangModel->getBarang($slug)
        ];

        return view('barang/edit', $data);
    }

    public function update($id_barang)
    {
        // cek nama
        $barangLama = $this->barangModel->getBarang($this->request->getVar('slug'));

        if ($barangLama['nama_barang'] == $this->request->getVar('nama_barang')) {
            $rules_nama = 'required';
        } else {
            $rules_nama = 'required|is_unique[barang.nama_barang]';
        }

        if (!$this->validate([
            'nama_barang' => [
                'rules' => $rules_nama,
                'errors' => [
                    'required' => 'Nama barang harus di isi.',
                    'is_unique' => 'Nama barang sudah dibuat.'
                ]
            ],
            'spesifikasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi.'
                ]
            ],
            'jumlah_barang' => [
                'rules' => 'alpha_numeric',
                'errors' => [
                    'alpha_numeric' => 'jumlah barang harus angka'
                ]
            ],
        ])) {

            return redirect()->to('/barang/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('nama_barang'), '-', true);

        $this->barangModel->save([
            'id_barang' => $id_barang,
            'nama_barang' => $this->request->getVar('nama_barang'),
            'slug' => $slug,
            'spesifikasi' => $this->request->getVar('spesifikasi'),
            'kondisi' => $this->request->getVar('kondisi'),
            'jumlah_barang' => $this->request->getVar('jumlah_barang')
        ]);

        session()->setFlashdata('pesan', 'Barang berhasil diubah.');

        return redirect()->to('/barang');
    }
}
