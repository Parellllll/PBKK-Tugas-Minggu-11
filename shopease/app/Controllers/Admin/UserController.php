<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $q         = trim((string) $this->request->getGet('q'));
        $role      = trim((string) $this->request->getGet('role'));

        if ($q !== '') {
            $userModel->groupStart()
                ->like('name', $q)
                ->orLike('email', $q)
                ->groupEnd();
        }
        if (in_array($role, ['admin', 'operator', 'customer'], true)) {
            $userModel->where('role', $role);
        }

        $users = $userModel->orderBy('id_user', 'DESC')->findAll();

        return view('admin/users', [
            'title'     => 'Kelola User & Role — Admin ShopEase',
            'activeNav' => 'users',
            'users'     => $users,
            'q'         => $q,
            'role'      => $role,
            'selfId'    => service('auth')->id(),
        ]);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[admin,operator,customer]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->insert([
            'name'      => trim((string) $this->request->getPost('name')),
            'email'     => strtolower(trim((string) $this->request->getPost('email'))),
            'password'  => password_hash((string) $this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'      => (string) $this->request->getPost('role'),
            'phone'     => trim((string) $this->request->getPost('phone')) ?: null,
            'is_active' => 1,
        ]);

        return redirect()->to('/admin/users')
            ->with('success', 'Akun pengguna baru berhasil ditambahkan.');
    }

    public function updateRole(int $id)
    {
        $selfId = service('auth')->id();
        if ($id === $selfId) {
            return redirect()->to('/admin/users')
                ->with('error', 'Admin tidak diperbolehkan mengubah role akunnya sendiri.');
        }

        $newRole = (string) $this->request->getPost('role');
        if (!in_array($newRole, ['admin', 'operator', 'customer'], true)) {
            return redirect()->to('/admin/users')->with('error', 'Role tidak valid.');
        }

        $userModel = new UserModel();
        $userModel->update($id, ['role' => $newRole]);

        return redirect()->to('/admin/users')
            ->with('success', "Role pengguna #{$id} berhasil diubah menjadi {$newRole}.");
    }

    public function toggleStatus(int $id)
    {
        if ($id === service('auth')->id()) {
            return redirect()->to('/admin/users')
                ->with('error', 'Admin tidak dapat menonaktifkan akunnya sendiri.');
        }

        $userModel = new UserModel();
        $target    = $userModel->find($id);
        if (!$target) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan.');
        }

        $next = (int) $target['is_active'] === 1 ? 0 : 1;
        $userModel->update($id, ['is_active' => $next]);

        return redirect()->to('/admin/users')
            ->with('success', 'Status akun ' . $target['name'] . ' berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        if ($id === service('auth')->id()) {
            return redirect()->to('/admin/users')
                ->with('error', 'Admin tidak diperbolehkan menghapus akunnya sendiri.');
        }

        $userModel = new UserModel();
        $target    = $userModel->find($id);
        if (!$target) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan.');
        }

        $userModel->delete($id);

        return redirect()->to('/admin/users')
            ->with('success', 'Akun ' . $target['name'] . ' berhasil dihapus.');
    }
}

