<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuthTokenModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $userModel  = new UserModel();
        $tokenModel = new AuthTokenModel();

        $counts       = $userModel->countByRole();
        $totalUsers   = array_sum($counts);
        $chartData    = $userModel->registrationsLast7Days();
        $recentUsers  = $userModel->orderBy('created_at', 'DESC')->findAll(6);
        $activeTokens = $tokenModel->where('expires_at >=', date('Y-m-d H:i:s'))->countAllResults();

        return view('admin/dashboard', [
            'title'        => 'Dashboard Admin — ShopEase',
            'activeNav'    => 'dashboard',
            'counts'       => $counts,
            'totalUsers'   => $totalUsers,
            'activeTokens' => $activeTokens,
            'chartData'    => $chartData,
            'recentUsers'  => $recentUsers,
        ]);
    }
}

