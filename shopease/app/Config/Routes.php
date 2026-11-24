<?php

use CodeIgniter\Router\RouteCollection;

/**
 * Konfigurasi Routes ShopEase — Tugas Minggu 11 (Authentication System CI 4)
 * Mahasiswa: Farrel Prastita Ramadhan (5025241219)
 *
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

// Storefront publik
$routes->get('/', 'HomeController::index', ['as' => 'home']);

// 5 Route Autentikasi inti sesuai Hands-On Lab
$routes->group('', ['filter' => 'guest'], static function ($routes) {
    $routes->get('register', 'AuthController::register', ['as' => 'auth.register']);
    $routes->post('register', 'AuthController::store', ['as' => 'auth.store']);
    $routes->get('login', 'AuthController::login', ['as' => 'auth.login']);
    $routes->post('login', 'AuthController::authenticate', ['as' => 'auth.authenticate']);
});
$routes->post('logout', 'AuthController::logout', ['filter' => 'auth', 'as' => 'auth.logout']);
$routes->get('logout', 'AuthController::logout', ['filter' => 'auth']);

// Route terproteksi Customer / semua user login
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('profil', 'ProfileController::index', ['as' => 'profile.index']);
    $routes->post('profil/update', 'ProfileController::update', ['as' => 'profile.update']);
    $routes->post('profil/password', 'ProfileController::updatePassword', ['as' => 'profile.password']);
    $routes->get('keranjang', 'HomeController::cart', ['as' => 'customer.cart']);
    $routes->get('pesanan', 'HomeController::orders', ['as' => 'customer.orders']);
});

// Panel Administrator (khusus role admin)
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->get('users', 'Admin\UserController::index', ['as' => 'admin.users']);
    $routes->post('users/store', 'Admin\UserController::store', ['as' => 'admin.users.store']);
    $routes->post('users/(:num)/role', 'Admin\UserController::updateRole/$1', ['as' => 'admin.users.role']);
    $routes->post('users/(:num)/toggle', 'Admin\UserController::toggleStatus/$1', ['as' => 'admin.users.toggle']);
    $routes->post('users/(:num)/delete', 'Admin\UserController::delete/$1', ['as' => 'admin.users.delete']);
});

// Panel Operator (role operator dan admin)
$routes->group('operator', ['filter' => 'auth:operator,admin'], static function ($routes) {
    $routes->get('/', 'Operator\DashboardController::index', ['as' => 'operator.dashboard']);
    $routes->get('dashboard', 'Operator\DashboardController::index');
});
