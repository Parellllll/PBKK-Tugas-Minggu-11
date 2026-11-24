<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index(): string
    {
        $user = service('auth')->user();

        return view('profile/index', [
            'title' => 'Profil Saya — ShopEase',
            'user'  => $user,
        ]);
    }

    public function update()
    {
        $rules = [
            'name'    => 'required|min_length[3]|max_length[100]',
            'phone'   => 'permit_empty|max_length[30]',
            'address' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userId    = service('auth')->id();
        $userModel = new UserModel();
        $newName   = trim((string) $this->request->getPost('name'));

        $userModel->update($userId, [
            'name'    => $newName,
            'phone'   => trim((string) $this->request->getPost('phone')) ?: null,
            'address' => trim((string) $this->request->getPost('address')) ?: null,
        ]);

        session()->set('name', $newName);

        return redirect()->to('/profil')
            ->with('success', 'Data profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $rules = [
            'current_password' => 'required',
            'new_password'     => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }

        $auth = service('auth');
        $user = $auth->user();

        if (!$user || !password_verify((string) $this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()
                ->with('error', 'Kata sandi saat ini tidak sesuai.');
        }

        $userModel = new UserModel();
        $userModel->update($user['id_user'], [
            'password' => password_hash((string) $this->request->getPost('new_password'), PASSWORD_BCRYPT),
        ]);

        // Hapus seluruh token Remember Me setelah penggantian password
        $auth->revokeUserTokens((int) $user['id_user']);
        session()->regenerate(true);

        return redirect()->to('/profil')
            ->with('success', 'Kata sandi berhasil diperbarui dan semua sesi Remember Me telah dicabut.');
    }
}

