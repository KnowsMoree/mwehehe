<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('vw_login', $data);
    }

    public function process()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $this->userModel->where([
            'username' => $username,
        ])->first();

        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                session()->set([
                    'username' => $dataUser->username,
                    'name' => $dataUser->name,
                    'foto' => $dataUser->foto,
                    'logged_in' => TRUE
                ]);
                session()->setFlashdata('logged', 'Selamat anda berhasil masuk');
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('error', 'Username/Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'anda adalah user lama, silakan resgistrasi kembali');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
