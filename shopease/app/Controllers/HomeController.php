<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    private function sampleProducts(): array
    {
        return [
            ['id' => 1, 'name' => 'Wireless Headphone Pro', 'cat' => 'Elektronik', 'price' => 299000, 'stock' => 20, 'accent' => '#6d28d9'],
            ['id' => 2, 'name' => 'Sneakers Urban Casual', 'cat' => 'Fashion', 'price' => 350000, 'stock' => 15, 'accent' => '#2563eb'],
            ['id' => 3, 'name' => 'Smart Watch Series S', 'cat' => 'Aksesoris', 'price' => 450000, 'stock' => 10, 'accent' => '#059669'],
            ['id' => 4, 'name' => 'Mechanical Keyboard 75%', 'cat' => 'Elektronik', 'price' => 549000, 'stock' => 12, 'accent' => '#d97706'],
        ];
    }

    public function index(): string
    {
        return view('storefront/home', [
            'title'    => 'ShopEase — Belanja Online Mudah & Aman',
            'products' => $this->sampleProducts(),
        ]);
    }

    public function cart(): string
    {
        return view('storefront/cart', [
            'title' => 'Keranjang Belanja — ShopEase',
            'items' => [
                ['name' => 'Wireless Headphone Pro', 'price' => 299000, 'qty' => 1],
                ['name' => 'Sneakers Urban Casual', 'price' => 350000, 'qty' => 2],
            ],
        ]);
    }

    public function orders(): string
    {
        return view('storefront/orders', [
            'title'  => 'Riwayat Pesanan — ShopEase',
            'orders' => [
                ['no' => 'SE-20261124-001', 'date' => '24 Nov 2026', 'total' => 999000, 'status' => 'processing', 'payment' => 'verified'],
                ['no' => 'SE-20261121-014', 'date' => '21 Nov 2026', 'total' => 450000, 'status' => 'completed', 'payment' => 'verified'],
            ],
        ]);
    }
}

