<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = time();
        $day = 86400;

        $users = [
            [
                'name'       => 'Farrel Admin ShopEase',
                'email'      => 'admin@shopease.local',
                'password'   => password_hash('Admin123!', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'phone'      => '0812-5025-1219',
                'address'    => 'Kantor Pusat ShopEase, Sukolilo, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 6 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 6 * $day),
            ],
            [
                'name'       => 'Budi Santoso (Operator)',
                'email'      => 'operator@shopease.local',
                'password'   => password_hash('Operator123!', PASSWORD_BCRYPT),
                'role'       => 'operator',
                'phone'      => '0813-4422-8899',
                'address'    => 'Gudang Pemenuhan ShopEase, Rungkut, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 5 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 5 * $day),
            ],
            [
                'name'       => 'Farrel Prastita Ramadhan',
                'email'      => 'customer@shopease.local',
                'password'   => password_hash('Customer123!', PASSWORD_BCRYPT),
                'role'       => 'customer',
                'phone'      => '0812-3456-1219',
                'address'    => 'Jl. Teknik Informatika No. 19, Keputih, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 4 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 4 * $day),
            ],
            [
                'name'       => 'Nadia Putri Lestari',
                'email'      => 'nadia@shopease.local',
                'password'   => password_hash('Customer123!', PASSWORD_BCRYPT),
                'role'       => 'customer',
                'phone'      => '0857-8890-1122',
                'address'    => 'Jl. Dharmawangsa No. 42, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 3 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 3 * $day),
            ],
            [
                'name'       => 'Raka Pratama',
                'email'      => 'raka@shopease.local',
                'password'   => password_hash('Customer123!', PASSWORD_BCRYPT),
                'role'       => 'customer',
                'phone'      => '0819-7733-2011',
                'address'    => 'Jl. Mulyosari Tengah No. 8, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 2 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 2 * $day),
            ],
            [
                'name'       => 'Sinta Maharani',
                'email'      => 'sinta@shopease.local',
                'password'   => password_hash('Customer123!', PASSWORD_BCRYPT),
                'role'       => 'customer',
                'phone'      => '0821-6004-9981',
                'address'    => 'Jl. Manyar Kertoarjo No. 15, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 1 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 1 * $day),
            ],
            [
                'name'       => 'Dimas Wijaya',
                'email'      => 'dimas@shopease.local',
                'password'   => password_hash('Customer123!', PASSWORD_BCRYPT),
                'role'       => 'operator',
                'phone'      => '0856-9102-3344',
                'address'    => 'Gudang Timur ShopEase, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now - 1 * $day),
                'updated_at' => date('Y-m-d H:i:s', $now - 1 * $day),
            ],
            [
                'name'       => 'Alya Kusuma',
                'email'      => 'alya@shopease.local',
                'password'   => password_hash('Customer123!', PASSWORD_BCRYPT),
                'role'       => 'customer',
                'phone'      => '0813-2244-5566',
                'address'    => 'Jl. Gubeng Kertajaya No. 23, Surabaya',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s', $now),
                'updated_at' => date('Y-m-d H:i:s', $now),
            ],
        ];

        $builder = $this->db->table('users');
        foreach ($users as $u) {
            $exists = $builder->where('email', $u['email'])->countAllResults();
            if ($exists === 0) {
                $builder->insert($u);
            }
        }
    }
}

