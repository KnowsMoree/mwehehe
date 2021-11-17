<?php

namespace App\Controllers;

use App\Models\PinjamBarangModel;

class PinjamBarang extends BaseController
{

    protected $PinjamBarangModel;

    public function __construct()
    {
        $this->PinjamBarangModel = new PinjamBarangModel();
    }

    public function detail($id_pinjam)
    {

        $data = [
            'title' => 'Detail pinjam',
            'pinjamBarang' => $this->PinjamBarangModel->getPinjamBarang($id_pinjam)
        ];

        // jika di table tidak ada barang

        if (empty($data['pinjamBarang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID Barang ' . $id_pinjam . ' tidak ditemukan.');
        }

        return view('detail', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Form peminjaman',
            'validation' => \Config\Services::validation()
        ];

        return view('create', $data);
    }

    // ? sampai di sini

    public function save()
    {
        if (!$this->validate([
            'peminjam' => [
                'rules' => 'required|is_unique[pinjam_barang.peminjam]',
                'errors' => [
                    'required' => '{field} must be create.',
                    'is_unique' => '{field} is already created.'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,5120]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'pict size is too large. Max: 5mb',
                    'is_image' => 'your file is not a pict',
                    'mime_in' => 'your file is not a pict'
                ]
            ],
            'nama_barang' => []
        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/barang/create')->withInput()->with('validation', $validation);
            return redirect()->to('/pinjam/create')->withInput();
        }

        // $fileFoto = $this->request->getFile('foto');

        // if ($fileFoto->getError() == 4) {
        //     $namaFoto = 'default.jpg';
        // } else {
        //     $namaFoto = $fileFoto->getRandomName();

        //     $fileFoto->move('img', $namaFoto);
        // }


        // $slug = url_title($this->request->getVar('nama'), '-', true);

        $this->PinjamBarangModel->save([
            'nama' => $this->request->getVar('nama'),
            // 'slug' => $slug,
            'tipe' => $this->request->getVar('tipe'),
            'pembuat' => $this->request->getVar('pembuat'),
        ]);

        session()->setFlashdata('pesan', 'Barang berhasil ditambahkan.');

        return redirect()->to('/barang');
    }

    public function delete($id_pinjam)
    {
        $this->PinjamBarangModel->delete($id_pinjam);
        session()->setFlashdata('pesan', 'Data Pinjam berhasil dihapus.');
        return redirect()->to('/home');
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

    public function update($id)
    {
        // cek nama
        $barangLama = $this->barangModel->getBarang($this->request->getVar('slug'));

        if ($barangLama['nama'] == $this->request->getVar('nama')) {
            $rules_nama = 'required';
        } else {
            $rules_nama = 'required|is_unique[barang.nama]';
        }

        if (!$this->validate([
            'nama' => [
                'rules' => $rules_nama,
                'errors' => [
                    'required' => '{field} must be create.',
                    'is_unique' => '{field} is already created.'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,5120]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'pict size is too large. Max: 5mb',
                    'is_image' => 'your file is not a pict',
                    'mime_in' => 'your file is not a pict'
                ]
            ]
        ])) {

            return redirect()->to('/barang/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);

        $this->barangModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'tipe' => $this->request->getVar('tipe'),
            'pembuat' => $this->request->getVar('pembuat'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Barang berhasil diubah.');

        return redirect()->to('/barang');
    }
}
