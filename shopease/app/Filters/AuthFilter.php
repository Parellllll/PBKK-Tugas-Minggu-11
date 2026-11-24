<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('auth');

        if (!$auth->check() && !$auth->checkRememberMe()) {
            $intended = current_url();
            $query    = $request->getUri()->getQuery();
            if ($query !== '') {
                $intended .= '?' . $query;
            }
            session()->set('intended_url', $intended);

            return redirect()->to('/login')
                ->with('warning', 'Silakan masuk terlebih dahulu untuk mengakses halaman tersebut.');
        }

        if (!empty($arguments) && !in_array($auth->role(), $arguments, true)) {
            return redirect()->to($auth->redirectUrlByRole())
                ->with('error', 'Akses ditolak! Peran akun Anda (' . $auth->role() . ') tidak memiliki izin membuka halaman tersebut.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}

