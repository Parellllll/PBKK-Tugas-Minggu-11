<?php

namespace App\Libraries;

use App\Models\AuthTokenModel;
use App\Models\UserModel;

/**
 * Service Autentikasi Terpusat ShopEase
 * Diakses melalui service('auth')
 */
class Auth
{
    public const REMEMBER_COOKIE = 'shopease_remember';
    public const REMEMBER_DAYS   = 30;
    public const MAX_ATTEMPTS    = 5;
    public const DECAY_SECONDS   = 60;

    private UserModel $users;
    private AuthTokenModel $tokens;

    public function __construct()
    {
        $this->users  = new UserModel();
        $this->tokens = new AuthTokenModel();
    }

    public function check(): bool
    {
        return (bool) session()->get('isLoggedIn');
    }

    public function user(): ?array
    {
        if (!$this->check()) {
            return null;
        }

        $id = (int) session()->get('id_user');
        return $this->users->find($id);
    }

    public function id(): ?int
    {
        return $this->check() ? (int) session()->get('id_user') : null;
    }

    public function role(): ?string
    {
        return $this->check() ? (string) session()->get('role') : null;
    }

    /**
     * Memverifikasi kredensial dengan perlindungan anti brute force (Throttler CI4).
     *
     * @return array{ok: bool, message?: string, user?: array, throttled?: bool}
     */
    public function attempt(string $email, string $password, bool $remember = false): array
    {
        $normalizedEmail = strtolower(trim($email));
        $ipAddress       = service('request')->getIPAddress();
        $throttleKey     = 'login_' . md5($ipAddress . '|' . $normalizedEmail);
        $throttler       = service('throttler');

        if ($throttler->check($throttleKey, self::MAX_ATTEMPTS, self::DECAY_SECONDS) === false) {
            $wait = max(1, (int) $throttler->getTokenTime());
            return [
                'ok'        => false,
                'throttled' => true,
                'message'   => "Terlalu banyak percobaan login gagal. Coba lagi dalam {$wait} detik.",
            ];
        }

        $user = $this->users->findByEmail($normalizedEmail);
        if (!$user || !password_verify($password, $user['password'])) {
            return [
                'ok'      => false,
                'message' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
            ];
        }

        if ((int) $user['is_active'] !== 1) {
            return [
                'ok'      => false,
                'message' => 'Akun Anda sedang dinonaktifkan oleh administrator.',
            ];
        }

        $this->login($user, $remember);

        return ['ok' => true, 'user' => $user];
    }

    public function login(array $user, bool $remember = false): void
    {
        session()->regenerate(true);
        session()->set([
            'isLoggedIn' => true,
            'id_user'    => (int) $user['id_user'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'role'       => $user['role'],
        ]);

        if ($remember) {
            $this->issueRememberToken((int) $user['id_user']);
        }
    }

    public function logout(): void
    {
        $userId = $this->id();
        $cookie = $_COOKIE[self::REMEMBER_COOKIE] ?? null;

        if (is_string($cookie) && str_contains($cookie, ':')) {
            [$selector] = explode(':', $cookie, 2);
            $this->tokens->where('selector', $selector)->delete();
        }
        if ($userId !== null) {
            $this->tokens->where('user_id', $userId)->delete();
        }

        $this->clearRememberCookie();

        session()->remove(['isLoggedIn', 'id_user', 'name', 'email', 'role', 'intended_url']);
        session()->regenerate(true);
    }

    public function issueRememberToken(int $userId): void
    {
        $selector        = bin2hex(random_bytes(12));
        $validator       = bin2hex(random_bytes(32));
        $hashedValidator = hash('sha256', $validator);
        $expiresTs       = time() + (self::REMEMBER_DAYS * 86400);

        $this->tokens->insert([
            'user_id'          => $userId,
            'selector'         => $selector,
            'hashed_validator' => $hashedValidator,
            'expires_at'       => date('Y-m-d H:i:s', $expiresTs),
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        setcookie(self::REMEMBER_COOKIE, $selector . ':' . $validator, [
            'expires'  => $expiresTs,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    public function checkRememberMe(): bool
    {
        if ($this->check()) {
            return true;
        }

        $rawCookie = $_COOKIE[self::REMEMBER_COOKIE] ?? null;
        if (!is_string($rawCookie) || !str_contains($rawCookie, ':')) {
            return false;
        }

        [$selector, $validator] = explode(':', $rawCookie, 2);
        if ($selector === '' || $validator === '') {
            $this->clearRememberCookie();
            return false;
        }

        $record = $this->tokens->where('selector', $selector)->first();
        if (!$record || strtotime($record['expires_at']) < time()) {
            if ($record) {
                $this->tokens->delete($record['id']);
            }
            $this->clearRememberCookie();
            return false;
        }

        $expected = $record['hashed_validator'];
        $actual   = hash('sha256', $validator);

        if (!hash_equals($expected, $actual)) {
            $this->tokens->delete($record['id']);
            $this->clearRememberCookie();
            return false;
        }

        $user = $this->users->find((int) $record['user_id']);
        if (!$user || (int) $user['is_active'] !== 1) {
            $this->tokens->delete($record['id']);
            $this->clearRememberCookie();
            return false;
        }

        // Rotasi token: hapus token lama dan terbitkan token baru
        $this->tokens->delete($record['id']);
        $this->login($user, true);

        return true;
    }

    public function revokeUserTokens(int $userId): void
    {
        $this->tokens->where('user_id', $userId)->delete();
        $this->clearRememberCookie();
    }

    public function redirectUrlByRole(?string $role = null): string
    {
        $r = $role ?? $this->role();
        return match ($r) {
            'admin'    => base_url('admin'),
            'operator' => base_url('operator'),
            default    => base_url('/'),
        };
    }

    private function clearRememberCookie(): void
    {
        setcookie(self::REMEMBER_COOKIE, '', [
            'expires'  => time() - 3600,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        unset($_COOKIE[self::REMEMBER_COOKIE]);
    }
}

