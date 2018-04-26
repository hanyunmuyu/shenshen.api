<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/26 0026
 * Time: 上午 9:08
 */

namespace App\Repositories\v1;


use App\User;

class UserRepository
{
    public function getUserByUserId($uid)
    {
        return User::where('id', $uid)->first();
    }
}