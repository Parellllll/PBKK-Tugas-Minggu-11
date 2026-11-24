<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $queue = [
            ['order' => 'SE-20261124-001', 'customer' => 'Farrel Prastita Ramadhan', 'items' => 3, 'status' => 'Siap Dikemas', 'courier' => 'JNE Express'],
            ['order' => 'SE-20261124-002', 'customer' => 'Nadia Putri Lestari', 'items' => 1, 'status' => 'Menunggu Kurir', 'courier' => 'SiCepat'],
            ['order' => 'SE-20261123-009', 'customer' => 'Raka Pratama', 'items' => 2, 'status' => 'Dalam Pengiriman', 'courier' => 'J&T Express'],
        ];

        return view('operator/dashboard', [
            'title'     => 'Dashboard Operator — ShopEase',
            'activeNav' => 'operator',
            'queue'     => $queue,
        ]);
    }
}

