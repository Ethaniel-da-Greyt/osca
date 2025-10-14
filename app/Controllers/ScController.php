<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ScController extends BaseController
{
    public function test1()
    {
        return view('test');
    }
}
