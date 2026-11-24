<?php

namespace Config;

use App\Libraries\Auth;
use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function auth(bool $getShared = true): Auth
    {
        if ($getShared) {
            return static::getSharedInstance('auth');
        }

        return new Auth();
    }
}
