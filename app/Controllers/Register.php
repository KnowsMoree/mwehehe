<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Register extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'registrasi',
            'validation' => \Config\Services::validation()
        ];
        return view('vw_register', $data);
    }

    public function process()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => '{field} sudah digunakan sebelumnya'
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[4]|max_length[100]|is_unique[users.name]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                    'is_unique' => '{field} sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password sebelumnya',
                ]
            ],
            'foto' => [
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'file yang anda upload bukan bentuk gambar',
                    'mime_in' => 'file yang anda upload bukan bentuk gambar'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            $namaFoto = $fileFoto->getRandomName();

            $fileFoto->move('img', $namaFoto);
        }

        // $barang = $this->barangModel->find($id_barang);

        // if ($barang['foto'] != 'default.jpg') {
        //     unlink('img/' . $barang['foto']);
        // }

        // $name = url_title($this->request->getVar('name'), '-', true);

        $this->userModel->insert([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'name'     => $this->request->getVar('name'),
            'foto'     => $namaFoto
        ]);

        session()->setFlashdata('regis', 'selamat akun anda telah dibuat, silahkan login');
        return redirect()->to('/login');
    }
}
