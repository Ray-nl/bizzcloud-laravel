<?php

namespace Raynl\Bizzcloud\Http\Controllers;

use Ripcord\Providers\Laravel\Ripcord;

class BizzcloudController extends Ripcord
{
    public function __construct()
    {
        $config = [
            'url' => config('bizzcloud.url'),
            'db' => config('bizzcloud.db'),
            'user' => config('bizzcloud.username'),
            'password' => config('bizzcloud.password'),
        ];

        parent::__construct($config);
    }

    public function index()
    {
        dd('index');
    }
}
