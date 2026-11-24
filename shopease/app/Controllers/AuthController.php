<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function register(): string
    {
        return view('auth/register', [
            'title' => 'Daftar Akun Customer — ShopEase',
        ]);
    }

    public function store()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[100]',
            'email'            => 'required|valid_email|max_length[120]|is_unique[users.email]',
            'phone'            => 'permit_empty|max_length[30]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Alamat email ini sudah terdaftar. Silakan masuk atau gunakan email lain.',
            ],
            'password_confirm' => [
                'matches' => 'Konfirmasi kata sandi tidak cocok.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->insert([
            'name'      => trim((string) $this->request->getPost('name')),
            'email'     => strtolower(trim((string) $this->request->getPost('email'))),
            'phone'     => trim((string) $this->request->getPost('phone')) ?: null,
            'password'  => password_hash((string) $this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'      => 'customer',
            'is_active' => 1,
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil! Password Anda telah dienkripsi dengan bcrypt. Silakan masuk.');
    }

    public function login(): string
    {
        return view('auth/login', [
            'title' => 'Masuk ke Akun — ShopEase',
        ]);
    }

    public function authenticate()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email    = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        $auth   = service('auth');
        $result = $auth->attempt($email, $password, $remember);

        if (!$result['ok']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $result['message']);
        }

        // Kembali ke halaman tujuan jika tamu diarahkan dari route terproteksi
        $intended = session()->get('intended_url');
        session()->remove('intended_url');

        if (is_string($intended) && $intended !== '' && str_starts_with($intended, base_url())) {
            // Pastikan role boleh mengakses intended URL admin/operator
            $role = $result['user']['role'];
            if (str_contains($intended, '/admin') && $role !== 'admin') {
                return redirect()->to($auth->redirectUrlByRole($role))
                    ->with('success', 'Selamat datang kembali, ' . $result['user']['name'] . '!');
            }
            if (str_contains($intended, '/operator') && !in_array($role, ['admin', 'operator'], true)) {
                return redirect()->to($auth->redirectUrlByRole($role))
                    ->with('success', 'Selamat datang kembali, ' . $result['user']['name'] . '!');
            }
            return redirect()->to($intended)
                ->with('success', 'Berhasil masuk! Anda dikembalikan ke halaman tujuan.');
        }

        return redirect()->to($auth->redirectUrlByRole($result['user']['role']))
            ->with('success', 'Selamat datang kembali, ' . $result['user']['name'] . '!');
    }

    public function logout()
    {
        service('auth')->logout();

        return redirect()->to('/login')
            ->with('success', 'Anda telah keluar dengan aman. Session dan token login telah dihapus.');
    }
}

