<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'is_active',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', strtolower(trim($email)))->first();
    }

    public function countByRole(): array
    {
        $rows = $this->select('role, COUNT(*) AS total')
            ->groupBy('role')
            ->findAll();

        $result = ['admin' => 0, 'operator' => 0, 'customer' => 0];
        foreach ($rows as $row) {
            $result[$row['role']] = (int) $row['total'];
        }
        return $result;
    }

    public function registrationsLast7Days(): array
    {
        $days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-{$i} days"));
            $days[$date] = 0;
        }

        $startDate = array_key_first($days) . ' 00:00:00';
        $rows = $this->select('created_at')
            ->where('created_at >=', $startDate)
            ->findAll();

        foreach ($rows as $row) {
            $d = substr((string) $row['created_at'], 0, 10);
            if (isset($days[$d])) {
                $days[$d]++;
            }
        }

        return [
            'labels' => array_map(static fn (string $d): string => date('d M', strtotime($d)), array_keys($days)),
            'counts' => array_values($days),
        ];
    }
}

