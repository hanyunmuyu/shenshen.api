<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public function success($data, $msg='success', $code = 2000)
    {
        return ['msg' => $msg, 'code' => $code,'data' => $data];
    }

    public function error($msg, $code = 4000)
    {
        return ['msg' => $msg, 'code' => $code];
    }
}
